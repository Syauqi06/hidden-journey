<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminDestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::latest()->paginate(10);
        return view('admin.dashboard', compact('destinations'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'province' => 'required',
            'nature_type' => 'required',
            'price_estimate' => 'required|numeric',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'facilities_list' => 'required', // Input string dipisah koma
        ]);

        // Upload Gambar
        $imagePath = $request->file('cover_image')->store('destinations', 'public');

        // Convert string fasilitas "Toilet, Mushola" menjadi Array JSON
        $facilitiesArray = array_map('trim', explode(',', $request->facilities_list));

        Destination::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'province' => $request->province,
            'nature_type' => $request->nature_type,
            'crowd_level' => $request->crowd_level,
            'price_estimate' => $request->price_estimate,
            'description' => $request->description,
            'vibe_description' => $request->vibe_description,
            'access_difficulty' => $request->access_difficulty,
            'facilities_list' => $facilitiesArray,
            'location_url' => $request->location_url,
            'contact_person' => $request->contact_person,
            'cover_image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('status', 'Destinasi berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $facilitiesString = implode(', ', $destination->facilities_list ?? []);

        return view('admin.edit', compact('destination', 'facilitiesString'));
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        // Logic Upload Gambar Baru (Jika ada)
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama jika bukan link external
            if (!Str::startsWith($destination->cover_image, 'http')) {
                Storage::disk('public')->delete($destination->cover_image);
            }
            $imagePath = $request->file('cover_image')->store('destinations', 'public');
        } else {
            $imagePath = $destination->cover_image;
        }

        $facilitiesArray = array_map('trim', explode(',', $request->facilities_list));

        $destination->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'province' => $request->province,
            'nature_type' => $request->nature_type,
            'crowd_level' => $request->crowd_level,
            'price_estimate' => $request->price_estimate,
            'description' => $request->description,
            'vibe_description' => $request->vibe_description,
            'access_difficulty' => $request->access_difficulty,
            'facilities_list' => $facilitiesArray,
            'location_url' => $request->location_url,
            'contact_person' => $request->contact_person,
            'cover_image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('status', 'Destinasi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        if (!Str::startsWith($destination->cover_image, 'http')) {
            Storage::disk('public')->delete($destination->cover_image);
        }
        $destination->delete();

        return back()->with('status', 'Destinasi dihapus.');
    }
}
