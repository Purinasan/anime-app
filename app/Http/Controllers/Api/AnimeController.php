<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnimeController extends Controller
{
    public function index()
    {
        $anime = Anime::latest()->get();
        return response()->json([
            'success' => true,
            'data' => $anime
        ]);
    }

    public function show($id)
    {
        $anime = Anime::find($id);
        
        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $anime
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'required|string',
            'rating' => 'required|string|max:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_url' => 'nullable|url'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('anime', 'public');
        }

        $anime = Anime::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Anime berhasil ditambahkan',
            'data' => $anime
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime tidak ditemukan'
            ], 404);
        }

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
            if ($anime->image) {
                Storage::disk('public')->delete($anime->image);
            }
            $validated['image'] = $request->file('image')->store('anime', 'public');
        }

        $anime->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Anime berhasil diupdate',
            'data' => $anime
        ]);
    }

    public function destroy($id)
    {
        $anime = Anime::find($id);

        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime tidak ditemukan'
            ], 404);
        }

        if ($anime->image) {
            Storage::disk('public')->delete($anime->image);
        }

        $anime->delete();

        return response()->json([
            'success' => true,
            'message' => 'Anime berhasil dihapus'
        ]);
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('searchTerm');
        
        $anime = Anime::where('title', 'LIKE', "%{$searchTerm}%")
            ->orWhere('genre', 'LIKE', "%{$searchTerm}%")
            ->orWhere('description', 'LIKE', "%{$searchTerm}%")
            ->get();

        return response()->json([
            'success' => true,
            'data' => $anime
        ]);
    }
}