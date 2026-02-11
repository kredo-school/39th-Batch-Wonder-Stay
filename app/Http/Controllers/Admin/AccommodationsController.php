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
    $search    = $request->query('search'); // ← ADD THIS

    $countries = Country::orderBy('name')->get();

    $hotels = Hotel::orderBy('name')
        ->when($countryId, fn ($q) => $q->where('country_id', $countryId))
        ->get();

    $rooms = HotelDetail::with('hotel')
    ->when($countryId, function ($q) use ($countryId) {
        $q->whereHas('hotel', function ($hotelQuery) use ($countryId) {
            $hotelQuery->where('country_id', $countryId);
        });
    })
    ->when($hotelId, fn ($q) => $q->where('hotel_id', $hotelId))
    ->paginate(10);



    return view('admin.accommodations.index', compact(
        'countries',
        'hotels',
        'rooms',
        'countryId',
        'hotelId',
        'search'   // ← ADD THIS
    ));
}


    public function create(Request $request)
    {
        $hotelId = $request->query('hotel_id');
        $hotels  = Hotel::orderBy('name')->get();

        return view('admin.accommodations.create', compact('hotels', 'hotelId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id'    => 'required|exists:hotels,id',
            'room_number' => 'required|string|max:50',
            'price'       => 'nullable|numeric|min:0',
            'size_area'   => 'nullable|numeric|min:0',
            'capacity'    => 'nullable|integer|min:1|max:10',
            'bed_type'    => 'nullable|string|max:100',
            'is_active'   => 'required|in:0,1',

        ]);

        // ✅ Option A: checkbox → TEXT
        $data['amenities'] = $request->has('amenities')
            ? implode(', ', $request->amenities)
            : null;

        $data['is_active'] = true;   // ✅ ADD THIS LINE

        HotelDetail::create($data);


        return redirect()
            ->route('admin.accommodations.index', [
                'hotel_id' => $data['hotel_id'],
            ])
            ->with('success', 'Room added successfully.');
    }

    public function edit(HotelDetail $hotelDetail)
    {
        $hotels = Hotel::orderBy('name')->get();

        return view('admin.accommodations.edit', compact('hotelDetail', 'hotels'));
    }

    public function update(Request $request, HotelDetail $hotelDetail)
    {
        $data = $request->validate([
            'hotel_id'    => 'required|exists:hotels,id',
            'room_number' => 'required|string|max:50',
            'price'       => 'nullable|numeric|min:0',
            'size_area'   => 'nullable|numeric|min:0',
            'capacity'    => 'nullable|integer|min:1|max:10',
            'bed_type'    => 'nullable|string|max:100',
        ]);

        // Option A: checkbox → TEXT
        $data['amenities'] = $request->has('amenities')
            ? implode(', ', $request->amenities)
            : null;

        $hotelDetail->update($data);

        return redirect()
            ->route('admin.accommodations.index', [
                'hotel_id' => $hotelDetail->hotel_id,
            ])
            ->with('success', 'Room updated successfully.');
    }

    public function destroy(HotelDetail $hotelDetail)
    {
        $hotelDetail->delete();

        return redirect()
            ->route('admin.accommodations.index')
            ->with('success', 'Room deleted successfully.');
    }

    // Status (Accomodations)
    public function toggleStatus(HotelDetail $hotelDetail)
{
    $hotelDetail->update([
        'is_active' => !$hotelDetail->is_active
    ]);

    return redirect()
        ->back()
        ->with('success', 'Room status updated.');
}

}
