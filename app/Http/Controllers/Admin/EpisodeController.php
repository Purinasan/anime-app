<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EpisodeController extends Controller
{
    // Show episodes for a specific anime
    public function index($animeId)
    {
        $anime = Anime::findOrFail($animeId);
        $episodes = Episode::where('anime_id', $animeId)->orderBy('episode_number')->get();
        
        return view('admin.episodes.index', compact('anime', 'episodes'));
    }

    // Show create episode form
    public function create($animeId)
    {
        $anime = Anime::findOrFail($animeId);
        
        // Get next episode number
        $lastEpisode = Episode::where('anime_id', $animeId)->max('episode_number');
        $nextEpisodeNumber = $lastEpisode ? $lastEpisode + 1 : 1;
        
        return view('admin.episodes.create', compact('anime', 'nextEpisodeNumber'));
    }

    // Store new episode
    public function store(Request $request, $animeId)
    {
        $anime = Anime::findOrFail($animeId);
        
        $validated = $request->validate([
            'episode_number' => 'required|integer|min:1',
            'title' => 'nullable|string|max:255',
            'video_144p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000', // 500MB max
            'video_360p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000',
            'video_720p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000',
            'video_1080p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000',
        ]);

        $episodeData = [
            'anime_id' => $animeId,
            'episode_number' => $validated['episode_number'],
            'title' => $validated['title'] ?? 'Episode ' . $validated['episode_number'],
        ];

        // Store video files for each resolution
        $resolutions = ['144p', '360p', '720p', '1080p'];
        
        foreach ($resolutions as $resolution) {
            $fieldName = "video_{$resolution}";
            if ($request->hasFile($fieldName)) {
                $file = $request->file($fieldName);
                $filename = "anime_{$animeId}_ep{$validated['episode_number']}_{$resolution}." . $file->getClientOriginalExtension();
                $path = $file->storeAs("episodes/anime_{$animeId}", $filename, 'public');
                $episodeData[$fieldName] = $path;
            }
        }

        Episode::create($episodeData);

        return redirect()
            ->route('admin.episodes.index', $animeId)
            ->with('success', 'Episode berhasil ditambahkan!');
    }

    // Show edit episode form
    public function edit($animeId, $episodeId)
    {
        $anime = Anime::findOrFail($animeId);
        $episode = Episode::where('anime_id', $animeId)->findOrFail($episodeId);
        
        return view('admin.episodes.edit', compact('anime', 'episode'));
    }

    // Update episode
    public function update(Request $request, $animeId, $episodeId)
    {
        $anime = Anime::findOrFail($animeId);
        $episode = Episode::where('anime_id', $animeId)->findOrFail($episodeId);
        
        $validated = $request->validate([
            'episode_number' => 'required|integer|min:1',
            'title' => 'nullable|string|max:255',
            'video_144p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000',
            'video_360p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000',
            'video_720p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000',
            'video_1080p' => 'nullable|file|mimes:mp4,mkv,avi,webm|max:512000',
        ]);

        $episodeData = [
            'episode_number' => $validated['episode_number'],
            'title' => $validated['title'] ?? 'Episode ' . $validated['episode_number'],
        ];

        // Update video files if new ones are uploaded
        $resolutions = ['144p', '360p', '720p', '1080p'];
        
        foreach ($resolutions as $resolution) {
            $fieldName = "video_{$resolution}";
            if ($request->hasFile($fieldName)) {
                // Delete old video
                if ($episode->$fieldName) {
                    Storage::disk('public')->delete($episode->$fieldName);
                }
                
                // Store new video
                $file = $request->file($fieldName);
                $filename = "anime_{$animeId}_ep{$validated['episode_number']}_{$resolution}." . $file->getClientOriginalExtension();
                $path = $file->storeAs("episodes/anime_{$animeId}", $filename, 'public');
                $episodeData[$fieldName] = $path;
            }
        }

        $episode->update($episodeData);

        return redirect()
            ->route('admin.episodes.index', $animeId)
            ->with('success', 'Episode berhasil diupdate!');
    }

    // Delete episode
    public function destroy($animeId, $episodeId)
    {
        $anime = Anime::findOrFail($animeId);
        $episode = Episode::where('anime_id', $animeId)->findOrFail($episodeId);

        // Delete all video files
        $resolutions = ['144p', '360p', '720p', '1080p'];
        foreach ($resolutions as $resolution) {
            $fieldName = "video_{$resolution}";
            if ($episode->$fieldName) {
                Storage::disk('public')->delete($episode->$fieldName);
            }
        }

        $episode->delete();

        return redirect()
            ->route('admin.episodes.index', $animeId)
            ->with('success', 'Episode berhasil dihapus!');
    }
}