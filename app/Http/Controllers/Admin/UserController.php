<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $totalGuests = User::count();
        $vipGuests = User::where('tier', 'VIP')->count();
        $highValueGuests = User::where('total_spend', '>', 6500)->count();
        $flaggedGuests = User::where('is_flagged', true)->count();

        //to get data 
        $query = User::query();

        if($request->filled('search')){
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        //tier filter
        if ($request->filled('tier')) {
            $query->where('tier', $request->tier);
        }

        //status filter
        if($request->filled('status')) {
            $query->where('status', $request->status);
        }

        //pagenation
        $users = $query->latest()->paginate(10)->withQueryString();

        //view
        return view('admin.users.index', compact('users', 'totalGuests', 'vipGuests', 'highValueGuests', 'flaggedGuests'));
    }

    public function updateMemo(Request $request, User $user)
    {
        //validation
        $request->validate([
            'memo' => 'nullable|string|max:500',
        ]);

        //update database
        $user->update([
            'admin_memo' => $request->memo
        ]);

        //return 
        return redirect()->back()->with('success', 'Memo updated successfully!');
    }
}
