<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoomPhoto;
use Illuminate\Support\Facades\Storage;

class RoomPhotoController extends Controller
{
    public function destroy(RoomPhoto $roomPhoto)
    {
        Storage::disk('public')->delete($roomPhoto->path);

        $roomPhoto->delete();

        return back()->with('success', 'Photo deleted');
    }
    // set main photo
    public function setMain(RoomPhoto $roomPhoto)
    {
        RoomPhoto::where('hotel_detail_id', $roomPhoto->hotel_detail_id)
            ->update(['is_main' => false]);

        $roomPhoto->update([
            'is_main' => true
        ]);

        return response()->json([
            'success' => true
        ]);
}


}
