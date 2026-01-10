<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
        {
            $exists = User::where('email', $request->email)->exists();

            if ($exists) {
                return back()->with('already_registered', true);
            }
        }
}
