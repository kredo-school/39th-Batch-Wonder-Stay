<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\HotelPhoto;
use App\Models\HotelDetail;
use App\Models\Reservation;
use App\Models\Region;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(int $id)
    {
        if ($id) {
            $hotel = Hotel::with(['photos', 'mainPhoto'])->findOrFail($id);
            return view('layouts.hotels.index', compact('hotel'));
        }

        $regions = Region::orderBy('name')->get();
        $hotels  = Hotel::with('mainPhoto')
            ->select('id', 'name', 'region_id')
            ->orderBy('name')
            ->get();

        return view('hotels.list', compact('regions', 'hotels'));
    }

    public function search(Request $request)
    {
        // 入力取得
        $keyword   = $request->input('destination');
        $checkin   = $request->input('checkin');
        $checkout  = $request->input('checkout');
        $people    = (int) $request->input('people', 1);

        // =========================
        // ① 地域チェック
        // =========================
        $hotels = Hotel::where(function ($q) use ($keyword) {

            $q->whereHas('region', function ($q2) use ($keyword) {
                $q2->where('name', 'like', "%{$keyword}%");
            })
            ->orWhereHas('country', function ($q2) use ($keyword) {
                $q2->where('name', 'like', "%{$keyword}%");
            })
            ->orWhereHas('city', function ($q2) use ($keyword) {
                $q2->where('name', 'like', "%{$keyword}%");
            });
        })->get();

        if ($hotels->isEmpty()) {
            return back()->withErrors([
                'destination' => '当アプリではその地域のホテルを取り扱っておりません'
            ]);
        }

        // =========================
        // ② 日付チェック
        // =========================
        if (!$checkin || !$checkout || $checkin >= $checkout) {
            return back()->withErrors([
                'date' => '日付が不正です'
            ]);
        }

        // =========================
        // ③ 空き部屋検索
        // =========================
        $availableRooms = HotelDetail::whereIn('hotel_id', $hotels->pluck('id'))
            ->where('capacity', '>=', $people)
            ->whereDoesntHave('reservations', function ($q) use ($checkin, $checkout) {
                $q->where(function ($query) use ($checkin, $checkout) {
                    $query->whereBetween('check_in_date', [$checkin, $checkout])
                        ->orWhereBetween('check_out_date', [$checkin, $checkout])
                        ->orWhere(function ($q2) use ($checkin, $checkout) {
                            $q2->where('check_in_date', '<=', $checkin)
                                ->where('check_out_date', '>=', $checkout);
                        });
                });
            })
            ->with('hotel')
            ->get();

        if ($availableRooms->isEmpty()) {
            return back()->withErrors([
                'date' => 'その日付はすでに他のお客様が予約しています'
            ]);
        }

        // =========================
        // ④ ホテル単位にまとめる
        // =========================
        $resultHotels = $availableRooms->pluck('hotel')->unique('id');

        return view('layouts.hotels.search_results', [
            'hotels' => $resultHotels,
            'checkin' => $checkin,
            'checkout' => $checkout,
            'people' => $people,
        ]);
    }

    public function show(int $id)
    {
        $hotel = Hotel::with(['photos', 'mainPhoto'])->findOrFail($id);
        return view('layouts.hotels.show', compact('hotel'));
    }
}
