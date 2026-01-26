<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
 public function index(Request $request)
{
    $regionId  = $request->query('region_id');
    $countryId = $request->query('country_id');
    $search    = $request->query('search');

    $regions   = Region::orderBy('name')->get();
    $countries = Country::orderBy('name')->get();

    if ($countryId && !$regionId) {
        $regionId = Country::where('id', $countryId)->value('region_id');
    }

    $hotels = Hotel::with('region')
        ->when($regionId, fn($q) => $q->where('region_id', $regionId))
        ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
        ->orderBy('name')
        ->get();

    return view('admin.hotels.index', compact(
        'hotels', 'regions', 'countries', 'regionId', 'countryId', 'search'
    ));
}
}
