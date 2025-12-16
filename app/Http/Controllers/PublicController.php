<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use App\Models\Wishlist;

class PublicController extends Controller
{
    public function index()
    {
        $recommendations = Destination::where('crowd_level', 'Sangat Sepi')
                            ->inRandomOrder()
                            ->take(3)
                            ->get();
        
        // Kirim data provinsi ke view
        $provinces = $this->getProvinces();

        return view('home', compact('recommendations', 'provinces'));
    }

    public function explore(Request $request)
    {
        $query = Destination::query();

        // 1. Filter Pencarian Utama
        if ($request->filled('province')) {
            $query->where('province', 'like', '%' . $request->province . '%');
        }

        if ($request->filled('nature_type')) {
            $query->where('nature_type', $request->nature_type);
        }

        if ($request->filled('crowd_level')) {
            $query->where('crowd_level', $request->crowd_level);
        }

        // 2. Filter Lanjutan (Advanced Header)
        if ($request->filled('access_difficulty')) {
            $query->where('access_difficulty', $request->access_difficulty);
        }

        // Filter Biaya (Range sederhanya: <= input user)
        if ($request->filled('max_price')) {
            $query->where('price_estimate', '<=', $request->max_price);
        }

        // Eksekusi query dengan pagination (9 item per halaman)
        $destinations = $query->latest()->paginate(9);
        $destinations->appends($request->all());

        return view('explore', compact('destinations'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();

        $isWishlisted = false;
        if (auth()->check()) {
            $isWishlisted = Wishlist::where('user_id', auth()->id())
                            ->where('destination_id', $destination->id)
                            ->exists();
        }

        return view('detail', compact('destination', 'isWishlisted'));
    }

    private function getProvinces()
    {
        return [
            'Aceh', 'Sumatera Utara', 'Sumatera Barat', 'Riau', 'Jambi', 'Sumatera Selatan', 'Bengkulu', 'Lampung', 'Kepulauan Bangka Belitung', 'Kepulauan Riau',
            'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'DI Yogyakarta', 'Jawa Timur', 'Banten',
            'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
            'Kalimantan Barat', 'Kalimantan Tengah', 'Kalimantan Selatan', 'Kalimantan Timur', 'Kalimantan Utara',
            'Sulawesi Utara', 'Sulawesi Tengah', 'Sulawesi Selatan', 'Sulawesi Tenggara', 'Gorontalo', 'Sulawesi Barat',
            'Maluku', 'Maluku Utara',
            'Papua', 'Papua Barat', 'Papua Selatan', 'Papua Tengah', 'Papua Pegunungan', 'Papua Barat Daya'
        ];
    }
}
