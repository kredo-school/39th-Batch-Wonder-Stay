<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Reservation;
use App\Models\HotelDetail;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ReservationController extends Controller
{
    /**
     * Reservation form
     */
    public function construct()
    {
        // ログイン必須
        $this->middleware('auth');
    }

    public function create(Hotel $hotel)
    {
        // 部屋タイプ取得（hotel_details）
        $roomTypes = HotelDetail::where('hotel_id', $hotel->id)->get();

        // 支払い方法
        $paymentMethods = PaymentMethod::all();

        return view('reservations.create', compact(
            'hotel',
            'roomTypes',
            'paymentMethods'
        ));
    }

    /**
     * Store reservation
     */
    public function store(Request $request, Hotel $hotel)
    {
        $validated = $request->validate([
            // guest
            'guest_first_name' => 'required|string|max:255',
            'guest_last_name'  => 'required|string|max:255',
            'guest_age'        => 'required|integer|min:18',
            'guest_email'      => 'required|email',
            'guest_address'    => 'nullable|string|max:255',
            'guest_phone'      => 'nullable|string|max:30',

            // accommodation
            'guests_count'     => 'required|integer|min:1',
            'rooms_count'      => 'required|integer|min:1',
            'hotel_detail_id'  => 'required|exists:hotel_details,id',
            'payment_method_id'=> 'required|exists:payment_methods,id',

            'check_in_date'    => 'required|date|after_or_equal:today',
            'check_out_date'   => 'required|date|after:check_in_date',
            'check_in_time'    => 'nullable',
            'special_request'  => 'nullable|string|max:255',
        ]);

        $room = HotelDetail::find($validated['hotel_detail_id']);

        if ($overlappingReservations >= $room->stock) {
            return back()->withErrors([
                'room' => 'This room is not available for the selected dates.'
            ])->withInput();
        }

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

        $overlappingReservations = Reservation::where('hotel_detail_id', $validated['hotel_detail_id'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('check_in_date', [
                    $validated['check_in_date'], 
                    $validated['check_out_date']
                    ])
                    ->orWhereBetween('check_out_date', [
                        $validated['check_in_date'], 
                        $validated['check_out_date']
                    ])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('check_in_date', '<=', $validated['check_in_date'])
                          ->where('check_out_date', '>=', $validated['check_out_date']);
                    });
            })
            ->count();

        if ($overlappingReservations >= $room->stock) {
            throw ValidationException::withMessages([
                'hotel_detail_id' => ['This room is not available for the selected dates.']
            ]);
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'hotel_id' => $hotel->id,
            ...$validated,
        ]);

        return redirect()
            ->route('home')
            ->with('success', 'Reservation completed.');
    }
}
