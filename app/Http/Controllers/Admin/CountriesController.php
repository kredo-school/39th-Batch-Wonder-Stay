<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::orderBy('name')->get();
        return view('admin.countries.index', compact('countries'));
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('admin.countries.index');
    }
}
