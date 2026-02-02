<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\HotelDetail;
use Illuminate\Http\Request;

class AccommodationsController extends Controller
{
    public function index(Request $request)
    {
        $countryId = $request->query('country_id');
        $hotelId   = $request->query('hotel_id');
        $search    = $request->query('search');

        // Sidebar data (safe, already exists)
        $countries = Country::orderBy('name')->get();

        $hotels = Hotel::orderBy('name')
            ->when($countryId, fn($q) => $q->where('country_id', $countryId))
            ->get();

        // Rooms / accommodations (DB not ready yet → empty)
        $rooms = collect();

        return view('admin.accommodations.index', compact(
            'countries',
            'hotels',
            'rooms',
            'countryId',
            'hotelId',
            'search'
        ));
    }

    public function create(Request $request)
    {
        $hotelId = $request->query('hotel_id');

        $hotels = Hotel::orderBy('name')->get();

        return view('admin.accommodations.create', compact('hotels', 'hotelId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id'    => 'required|exists:hotels,id',
            'room_number' => 'required|string|max:50',
            'price'       => 'nullable|numeric|min:0',
            'size_area'   => 'nullable|numeric|min:0',
            'capacity' => 'nullable|integer|min:1|max:10',
            'bed_type'    => 'nullable|string|max:100',
            'amenities'   => 'nullable|string',
        ]);

        HotelDetail::create([
            'hotel_id'    => $data['hotel_id'],
            'room_number' => $data['room_number'],
            'price'       => $data['price'] ?? null,
            'size_area'   => $data['size_area'] ?? null,
            'capacity'    => $data['capacity'] ?? null,
            'bed_type'    => $data['bed_type'] ?? null,
            'amenities'   => $data['amenities'] ?? null,
        ]);

        return redirect()
            ->route('admin.accommodations.index', [
                'hotel_id' => $data['hotel_id'],
            ])
            ->with('success', 'Room added successfully.');
    }

    public function edit(HotelDetail $hotelDetail)
    {
        $hotels = Hotel::orderBy('name')->get();

        return view('admin.accommodations,edit', compact('hotelDtail', 'hotels'));
    }
}
