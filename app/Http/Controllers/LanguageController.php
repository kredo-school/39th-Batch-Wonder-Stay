<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Http\RedirectResponse;


class LanguageController extends Controller
{
    public function switch($code)
    {
        session(['locale' => $code]);
        return back();
    }
}
