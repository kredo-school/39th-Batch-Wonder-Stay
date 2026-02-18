<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class MapController extends Controller
{
    public function index()
    {
        $continents = ['Asia', 'Europe', 'North America', 'South America', 'Africa', 'Oceania'];

        $hotels = Hotel::with(['mainPhoto'])
            ->whereNotNull('continent')
            ->whereNotNull('map_x')
            ->whereNotNull('map_y')
            ->get();

        // 初期表示は Asia（なければ先頭の大陸にする）
        $initial = 'Asia';
        if (!$hotels->where('continent', $initial)->count()) {
            $initial = $continents[0];
        }

        return view('maps.index', compact('continents', 'hotels', 'initial'));
    }
}
