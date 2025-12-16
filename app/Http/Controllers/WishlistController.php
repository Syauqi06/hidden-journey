<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Destination;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())
                        ->with('destination')
                        ->latest()
                        ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function toggle($destinationId)
    {
        $user = Auth::user();
        $destination = Destination::findOrFail($destinationId);

        // Cek database apakah sudah ada kombinasi user_id & destination_id ini
        $existingWishlist = Wishlist::where('user_id', $user->id)
                                    ->where('destination_id', $destination->id)
                                    ->first();

        if ($existingWishlist) {
            // Hapus (Un-wishlist)
            $existingWishlist->delete();
            $message = 'Destinasi dihapus dari koleksi Anda.';
            $status = 'info'; // untuk warna notifikasi nanti
        } else {
            // Simpan Baru
            Wishlist::create([
                'user_id' => $user->id,
                'destination_id' => $destination->id
            ]);
            $message = 'Destinasi berhasil disimpan!';
            $status = 'success';
        }

        return back()->with('status', $message)->with('type', $status);
    }
}
