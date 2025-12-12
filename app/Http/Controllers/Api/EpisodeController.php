<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\Anime;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Get all episodes for a specific anime
     */
    public function index($animeId)
    {
        $anime = Anime::find($animeId);
        
        if (!$anime) {
            return response()->json([
                'success' => false,
                'message' => 'Anime not found'
            ], 404);
        }

        $episodes = Episode::where('anime_id', $animeId)
            ->orderBy('episode_number')
            ->get();

        return response()->json([
            'success' => true,
            'anime' => [
                'id' => $anime->id,
                'title' => $anime->title,
                'image' => $anime->image,
            ],
            'episodes' => $episodes
        ]);
    }

    /**
     * Get single episode details
     */
    public function show($animeId, $episodeId)
    {
        $episode = Episode::where('anime_id', $animeId)
            ->where('id', $episodeId)
            ->first();

        if (!$episode) {
            return response()->json([
                'success' => false,
                'message' => 'Episode not found'
            ], 404);
        }

        $anime = Anime::find($animeId);

        return response()->json([
            'success' => true,
            'anime' => [
                'id' => $anime->id,
                'title' => $anime->title,
                'image' => $anime->image,
            ],
            'episode' => $episode
        ]);
    }

    /**
     * Get available resolutions for an episode
     */
    public function resolutions($animeId, $episodeId)
    {
        $episode = Episode::where('anime_id', $animeId)
            ->where('id', $episodeId)
            ->first();

        if (!$episode) {
            return response()->json([
                'success' => false,
                'message' => 'Episode not found'
            ], 404);
        }

        $resolutions = [];
        
        if ($episode->video_144p) {
            $resolutions['144p'] = asset('storage/' . $episode->video_144p);
        }
        if ($episode->video_360p) {
            $resolutions['360p'] = asset('storage/' . $episode->video_360p);
        }
        if ($episode->video_720p) {
            $resolutions['720p'] = asset('storage/' . $episode->video_720p);
        }
        if ($episode->video_1080p) {
            $resolutions['1080p'] = asset('storage/' . $episode->video_1080p);
        }

        return response()->json([
            'success' => true,
            'episode' => [
                'id' => $episode->id,
                'number' => $episode->episode_number,
                'title' => $episode->title,
            ],
            'resolutions' => $resolutions
        ]);
    }
}