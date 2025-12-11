<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    protected $fillable = [
        'anime_id',
        'episode_number',
        'title',
        'video_144p',
        'video_360p',
        'video_720p',
        'video_1080p',
        'duration'
    ];

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
    public function episodes()
{
    return $this->hasMany(Episode::class);
}

}