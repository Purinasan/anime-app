<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    public function index()
    {
        // Load episodes relationship to count them
        $anime = Anime::with('episodes')->latest()->get();
        return view('admin.anime.index', compact('anime'));
    }

    public function create()
    {
        return view('admin.anime.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_url' => 'nullable|url',
            'opening_url' => 'nullable|url'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('anime', 'public');
        }

        Anime::create($validated);

        return redirect()->route('admin.anime.index')
            ->with('success', 'Anime berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        return view('admin.anime.edit', compact('anime'));
    }

    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_url' => 'nullable|url',
            'opening_url' => 'nullable|url'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($anime->image) {
                Storage::disk('public')->delete($anime->image);
            }
            $validated['image'] = $request->file('image')->store('anime', 'public');
        }

        $anime->update($validated);

        return redirect()->route('admin.anime.index')
            ->with('success', 'Anime berhasil diupdate!');
    }

    public function destroy($id)
    {
        $anime = Anime::findOrFail($id);
        
        // Delete image
        if ($anime->image) {
            Storage::disk('public')->delete($anime->image);
        }
        
        $anime->delete();

        return redirect()->route('admin.anime.index')
            ->with('success', 'Anime berhasil dihapus!');
    }
}