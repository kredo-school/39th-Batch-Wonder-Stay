<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Hotel;

class RegionController extends Controller
{
    // Region一覧（API用にも使える）
    public function index()
    {
        $regions = Region::orderBy('name')->get();
        //return view('regions.index', compact('regions')); // 画面が必要なら
    }

    // ✅ Regionクリックで「そのRegionのホテル一覧」を返す（JSON）
    public function hotels(Region $region)
    {
        $hotels = $region->hotels()
            ->select('id', 'name', 'region_id')
            ->orderBy('name')
            ->get();

        return response()->json($hotels);
    }
}