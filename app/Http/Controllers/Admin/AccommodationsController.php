<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\HotelDetail;
use App\Models\RoomPhoto;
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

   $rooms = HotelDetail::with(['hotel', 'photos'])

    ->when($search, function ($q) use ($search) {

        $q->where(function ($sub) use ($search) {

            $sub->where('id', $search)
                ->orWhere('room_number', 'like', "%{$search}%")
                ->orWhereHas('hotel', function ($hotelQuery) use ($search) {
                    $hotelQuery->where('name', 'like', "%{$search}%");
                });

        });

    })

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
            : '';

        $data['is_active'] = true;   // ✅ ADD THIS LINE

       $room = HotelDetail::create($data);

        if ($request->hasFile('photos')) {

            foreach ($request->file('photos') as $index => $photo) {

                $path = $photo->store('rooms', 'public');

               RoomPhoto::create([
                    'hotel_detail_id' => $room->id,
                    'path' => $path,
                    'sort_order' => $index,  
                ]);

            }
        }



        return redirect()
            ->route('admin.accommodations.index', [
                'hotel_id' => $data['hotel_id'],
            ])
            ->with('success', 'Room added successfully.');
    }

public function edit(HotelDetail $hotelDetail)
{
    $hotels = Hotel::orderBy('name')->get();

    $mainPhoto = $hotelDetail->photos()
                             ->where('is_main', true)
                             ->first();

    return view('admin.accommodations.edit',
        compact('hotelDetail', 'mainPhoto', 'hotels')
    );
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
            'photos.*' => 'image|max:2048',

            
        ]);

        // Option A: checkbox → TEXT
        $data['amenities'] = $request->has('amenities')
            ? implode(', ', $request->amenities)
            : '';

        $hotelDetail->update($data);


        /* ✅ PHOTO UPLOAD HERE */

       /* ✅ PHOTO UPLOAD HERE */

if ($request->hasFile('photos')) {

    $maxSort = RoomPhoto::where('hotel_detail_id', $hotelDetail->id)
                        ->max('sort_order');

    $maxSort = $maxSort ?? -1;

    foreach ($request->file('photos') as $photo) {

        $maxSort++;

        $path = $photo->store('rooms', 'public');

        RoomPhoto::create([
            'hotel_detail_id' => $hotelDetail->id,
            'path' => $path,
            'sort_order' => $maxSort,
        ]);
    }
}

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

public function show(HotelDetail $hotelDetail)
{
    $hotels = Hotel::orderBy('name')->get();

    $mainPhoto = $hotelDetail->photos()
                             ->where('is_main', true)
                             ->first();

    return view('admin.accommodations.show',
        compact('hotelDetail', 'hotels', 'mainPhoto')
    );
}

}
