<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index()
    {
        $regions = Region::orderBy('name')->get();
        $hotels  = Hotel::select('id','name','region_id')->orderBy('name')->get();

        return view('your-view-name', compact('regions', 'hotels'));
    }
}
