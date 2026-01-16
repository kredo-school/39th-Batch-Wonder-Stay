<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        return 'Index Cities';
    }

   public function create()
{
    return view('admin.cities.create');
}

}
