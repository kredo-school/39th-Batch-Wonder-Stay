<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Reservation;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        $reservations = Reservation::with(['hotel', 'hotelDetail'])->where('user_id', $user->id)->latest()->get();

        $points = Reservation::where('user_id', $user->id)
            ->where('status', 'confirmed')->count();

        if($points <= 1){
            $grade = 'First-time';
        }elseif($points<=4){
            $grade = 'Repeater';
        }else{
            $grade = 'VIP';
        }
        return view('profile.show', compact('user', 'points', 'grade', 'reservations'));
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'password' => 'nullable|min:6|confirmed',
            'icon' => 'nullable|image|mimes:jpg,png,jpeg,avif|max:2048',
        ]);

        if($request->hasFile('icon')){
            $file = $request->file('icon');
            $filename = time() . '.' . $file->getClientOriginalName();
            $file->move(public_path('images/icons'), $filename);
            $user->icon = 'images/icons/' . $filename;
        }

        if($request->name){
            $user->name = $request->name;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
