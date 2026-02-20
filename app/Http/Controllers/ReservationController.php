<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\HotelDetail;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class ReservationController extends Controller
{
    /**
     * Reservation form
     */
    public function __construct()
    {
        // ログイン必須
        $this->middleware('auth');
    }

    public function create(Hotel $hotel)
    {
        // 部屋タイプ取得（hotel_details）
        $roomTypes = HotelDetail::where('hotel_id', $hotel->id)->get();

        // 支払い方法
        $paymentMethods = PaymentMethod::where('is_enabled', true)->get();

        return view('reservations.create', compact(
            'hotel',
            'roomTypes',
            'paymentMethods'
        ));
    }

    public function confirm(Request $request, Hotel $hotel)
    {
        $validated = $this->validateReservation($request);
        $room = HotelDetail::where('id', $validated['hotel_detail_id'])
            ->where('hotel_id', $hotel->id)
            ->firstOrFail();

        $this->ensureAvailability($room, $validated);
        $paymentMethod = PaymentMethod::findOrFail($validated['payment_method_id']);
        $nights = Carbon::parse($validated['check_in_date'])->diffInDays(Carbon::parse($validated['check_out_date']));
        $totalPrice = $room->price * $nights;
        $request->session()->put('reservation_confirm', $validated);
        $maskedCard = null;

        if($request->filled('card_number')){
            $maskedCard =  '**** **** **** ' . substr($request->card_number, -4);
        }

        return view('reservations.confirm', compact(
            'hotel',
            'room',
            'paymentMethod',
            'validated',
            'nights',
            'totalPrice',
            'maskedCard'
        ));
    }


    /**
     * Store reservation
     */
    public function store(Request $request, Hotel $hotel)
    {
        $validated = $request->session()->get('reservation_confirm');

        if (!$validated || $validated['hotel_detail_id'] != $request->hotel_detail_id) {
            return redirect()
                ->route('reservations.create', $hotel)
                ->with('error', 'Session expired. Please try again.');
        }

        $room = HotelDetail::where('id', $validated['hotel_detail_id'])
            ->where('hotel_id', $hotel->id)
            ->firstOrFail();

        $this->ensureAvailability($room, $validated);

        Reservation::create([
            'user_id' => auth()->id(),
            'hotel_id' => $hotel->id,
            ...$validated,
        ]);

        $request->session()->forget('reservation_confirm');
        return redirect()
            ->route('reservations.notification');
    }

    private function validateReservation(Request $request): array
    {
        $rules = [
            // guest
            'guest_first_name' => 'required|string|max:255',
            'guest_last_name'  => 'required|string|max:255',
            'guest_age'        => 'required|integer|min:18',
            'guest_email'      => 'required|email',
            'guest_address'    => 'nullable|string|max:255',
            'guest_phone'      => 'nullable|string|max:30',

            // accommodation
            'guests_count'     => 'required|integer|min:1',
            'hotel_detail_id'  => 'required|exists:hotel_details,id',
            'payment_method_id'=> 'required|exists:payment_methods,id',

            'check_in_date'    => 'required|date|after_or_equal:today',
            'check_out_date'   => 'required|date|after:check_in_date',
            'check_in_time'    => 'nullable',
            'special_request'  => 'nullable|string|max:255',
        ];

        $paymentMethod = PaymentMethod::find($request->payment_method_id);
        if ($paymentMethod && in_array($paymentMethod->code, ['visa', 'jcb', 'amex', 'mastercard'])) {
            $rules['card_number'] = 'required|string|min:12|max:19';
            $rules['card_name'] = 'required|string|max:255';
            $rules['card_expiry'] = 'required|string|max:7';
        }
        return $request->validate($rules);
    }

    private function ensureAvailability(HotelDetail $room, array $validated): void
    {
        $overlapCount = Reservation::where('hotel_detail_id', $room->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where('check_in_date', '<', $validated['check_out_date'])
            ->where('check_out_date', '>', $validated['check_in_date'])
            ->count();

        if ($overlapCount >= $room->stock) {
            throw ValidationException::withMessages([
                'hotel_detail_id' => ['This room is not available for the selected dates.']
            ]);
        }
    }

        public function cancel(Reservation $reservation)
        {
            //Only guest's reservation can be cancelled
            if ($reservation->user_id !== auth()->id()) {
                abort(403);
            }

            // If already cancelled, do nothing
            if ($reservation->status === 'cancelled') {
                return back();
            }

            $reservation->update(['status' => 'cancelled']);

            return back()->with('success', 'Reservation cancelled.');
        }
}
