<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Country;
use App\Models\City;

class CitiesController extends Controller
{
  public function index(Request $request)
{
    $regionId  = $request->query('region_id');
    $countryId = $request->query('country_id');

    // Cities list (filter by region first, then country)
    $cities = City::with(['region', 'country'])
        ->when($regionId, function ($q) use ($regionId) {
            $q->where('region_id', $regionId);
        })
        ->when($countryId, function ($q) use ($countryId) {
            $q->where('country_id', $countryId);
        })
        ->orderBy('name')
        ->paginate(10);   // ✅ ← ONLY CHANGE


    // Regions for left sidebar
    $regions = \App\Models\Region::orderBy('name')->get();

    // Countries for dropdown:
    // If region is selected, show ONLY countries that have cities in that region
    $countries = \App\Models\Country::query()
        ->when($regionId, function ($q) use ($regionId) {
            $q->whereHas('cities', function ($cityQ) use ($regionId) {
                $cityQ->where('region_id', $regionId);
            });
        })
        ->orderBy('name')
        ->get();

    return view('admin.cities.index', compact(
        'cities', 'regions', 'countries', 'regionId', 'countryId'
    ));
}



    public function create()
    {
        /** Fetch regions and countries from DB
         *  Pass them to the Blade view */

        $regions = Region::orderBy('name')->get(); // Get all regions
        $countries = Country::orderBy('name')->get(); // Get all conutries

        return view('admin.cities.create', compact('regions', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'region_id' => ['required', 'exists:regions,id'], //Region must exist
            'country_id' => ['required', 'exists:countries,id'], //Country must exist
            'name' => ['required', 'string', 'max:255'], // City name
        ]);

        // Create city record
        City::create($validated);

        // Redirect back with success message
        return redirect()->route('admin.cities.create')->with('success', 'City saved!');
    }

    // Show edit page
    public function edit(City $city)
    {
        $regions = Region::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();

        return view('admin.cities.edit', compact('city', 'regions', 'countries'));
    }

    // Update city data
    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'region_id'  => ['required', 'exists:regions,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'name'       => ['required', 'string', 'max:255'],
        ]);

        $city->update($validated);

        return redirect()->route('admin.cities.index')
            ->with('success', 'City updated!');
    }

    // Delete a city
    public function destroy(City $city)
    {
        $city->delete();

        return redirect()
            ->route('admin.cities.index')
            ->with('success', 'City deleted');
    }
}
