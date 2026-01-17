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
        $regions = Region::orderBy('name')->get();
        $countries = Country::orderBy('name')->get();

        return view('admin.cities.create', compact('regions', 'countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'region_id' => ['required', 'exists:regions,id'],
            'country_id' => ['required', 'exists:countries,id'],
            'name' => ['required', 'string', 'max:255'],
        ]);

        City::create($validated);

        return redirect()->route('admin.cities.create')->with('success', 'City saved!');
    }
}
