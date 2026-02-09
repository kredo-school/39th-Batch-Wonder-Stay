<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Region;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(int $id)
    {
        if ($id) {
            $hotel = Hotel::with(['mainPhoto', 'photos'])->findOrFail($id);
            return view('layouts.hotels.index', compact('hotel'));
        }

        $regions = Region::orderBy('name')->get();
        $hotels  = Hotel::with('mainPhoto')
            ->select('id', 'name', 'region_id')
            ->orderBy('name')
            ->get();

        return view('hotels.list', compact('regions', 'hotels'));
    }

    public function show(int $id)
    {
        $hotel = Hotel::with(['photos', 'mainPhoto'])->findOrFail($id);

        return view('layouts.hotels.show', compact('hotel'));
    }
}
