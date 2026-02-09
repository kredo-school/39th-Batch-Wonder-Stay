<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Hotel;
use App\Models\City;
use Illuminate\Http\Request;

class HotelsController extends Controller
{
  public function index(Request $request)
{
    $countryId = $request->query('country_id');
    $search    = $request->query('search');

    $countries = Country::orderBy('name')->get();

   $hotels = Hotel::with(['city', 'country'])
    ->when($countryId, fn ($q) => $q->where('country_id', $countryId))
    ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
    ->orderBy('name')
    ->get();


    return view('admin.hotels.index', compact(
        'hotels', 'countries', 'countryId', 'search'
    ));
}


public function create(Request $request)
{
    $countries = Country::orderBy('name')->get();

    $countryId = $request->query('country_id');

    $cities = City::query()
        ->when($countryId, fn($q) => $q->where('country_id', $countryId))
        ->orderBy('name')
        ->get();

    return view('admin.hotels.create', compact('countries', 'cities', 'countryId'));
}

  public function store(Request $request)
{
    $data = $request->validate([
        'name'        => 'required|string|max:255',
        'city_id' => 'nullable|exists:cities,id',
        'country_id'  => 'required|exists:countries,id',
        'description' => 'nullable|string',
        'address'     => 'nullable|string',
        'phone'       => 'nullable|string',
        'email'       => 'nullable|email',
    ]);

    // country → region 変換（DB設計上 必須）
    $regionId = Country::where('id', $data['country_id'])->value('region_id');

    if (!$regionId) {
        return back()
            ->withInput()
            ->withErrors(['country_id' => 'This country has no valid region.']);
    }

    Hotel::create([
        'name'        => $data['name'],
        'city_id' => $data['city_id'] ?? null,

        'country_id'  => $data['country_id'],
        'region_id'   => $regionId,   
        'description' => $data['description'] ?? null,
        'address'     => $data['address'] ?? null,
        'phone'       => $data['phone'] ?? null,
        'email'       => $data['email'] ?? null,
    ]);

    return redirect()->route('admin.hotels.index');
}



   public function edit(Hotel $hotel)
{
    $cities = City::with('country')->orderBy('name')->get();
    $countries = Country::orderBy('name')->get();

    return view('admin.hotels.edit', compact('hotel', 'cities', 'countries'));
}

public function update(Request $request, Hotel $hotel)
{
    $data = $request->validate([
        'name'        => 'required|string|max:255',
        'city_id' => 'nullable|exists:cities,id',

        'country_id'  => 'required|exists:countries,id',
        'description' => 'nullable|string',
        'address'     => 'nullable|string',
        'phone'       => 'nullable|string',
        'email'       => 'nullable|email',
    ]);

    // country → region 変換（必須）
    $regionId = Country::where('id', $data['country_id'])->value('region_id');

    if (!$regionId) {
        return back()
            ->withInput()
            ->withErrors(['country_id' => 'This country has no valid region.']);
    }

    $hotel->update([
        'name'        => $data['name'],
        'city_id' => $data['city_id'] ?? null,

        'country_id'  => $data['country_id'],
        'region_id'   => $regionId,   
        'description' => $data['description'] ?? null,
        'address'     => $data['address'] ?? null,
        'phone'       => $data['phone'] ?? null,
        'email'       => $data['email'] ?? null,
    ]);

    return redirect()->route('admin.hotels.index');
}

public function destroy(Hotel $hotel)
{
    $hotel->delete();

    return redirect()->route('admin.hotels.index');
}


}
