<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Region;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('name')->get();

        $hotels = Hotel::with('mainPhoto')
            ->select('id', 'name', 'region_id')
            ->orderBy('name')
            ->get();

        return view('hotels.index', compact('regions', 'hotels'));
    }

    public function show($id)
    {
        $hotel = Hotel::with(['photos', 'mainPhoto'])
            ->findOrFail($id);

        return view('hotels.show', compact('hotel'));
    }
}
