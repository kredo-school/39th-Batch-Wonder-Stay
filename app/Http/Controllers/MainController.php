<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Hotel;

class MainController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('name')->get();
        $hotels  = Hotel::select('id','name','region_id')->orderBy('name')->get();

        return view('main', compact('regions', 'hotels'));
    }
}
