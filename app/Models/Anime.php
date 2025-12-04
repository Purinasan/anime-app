<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anime extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anime';

    protected $fillable = [
        'title',
        'genre',
        'description',
        'rating',
        'image',
        'video_url',
        'opening_url' 
    ];

    protected $dates = ['deleted_at'];
}