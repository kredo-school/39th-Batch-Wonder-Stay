<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Country;
use App\Models\City;

class CitiesController extends Controller
{
    public function index()
    {
        return 'Index Cities';
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
}
