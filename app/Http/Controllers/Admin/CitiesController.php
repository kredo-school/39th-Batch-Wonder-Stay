<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\Country;

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

    public function store()
    {
        return 'Store City okay';
    }
}
