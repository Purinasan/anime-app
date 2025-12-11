@extends('admin.layouts.app')

@section('title', 'Manage Episodes')

@section('page-title', 'Episodes - ' . $anime->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.anime.index') }}">Anime List</a></li>
    <li class="breadcrumb-item active">Episodes</li>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2">
                        @if($anime->image)
                            <img src="{{ asset('storage/' . $anime->image) }}" 
                                 alt="{{ $anime->title }}" 
                                 class="img-fluid rounded">
                        @else
                            <div class="bg-secondary text-white d-flex align-items-center justify-content-center rounded" 
                                 style="height: 150px;">
                                <i class="fas fa-image fa-3x"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <h3>{{ $anime->title }}</h3>
                        <p class="mb-1"><strong>Genre:</strong> {{ $anime->genre }}</p>
                        <p class="mb-1"><strong>Rating:</strong> ⭐ {{ $anime->rating }}</p>
                        <p class="mb-0"><strong>Total Episodes:</strong> {{ $episodes->count() }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Episode List</h3>
        <div class="card-tools">
            <a href="{{ route('admin.episodes.create', $anime->id) }}" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i> Add Episode
            </a>
            <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Back to Anime
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 80px">Episode</th>
                    <th>Title</th>
                    <th>Available Resolutions</th>
                    <th>Duration</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($episodes as $episode)
                <tr>
                    <td class="text-center">
                        <span class="badge badge-primary badge-lg">EP {{ $episode->episode_number }}</span>
                    </td>
                    <td>
                        <strong>{{ $episode->title }}</strong>
                    </td>
                    <td>
                        @if($episode->video_144p)
                            <span class="badge badge-secondary">144p</span>
                        @endif
                        @if($episode->video_360p)
                            <span class="badge badge-info">360p</span>
                        @endif
                        @if($episode->video_720p)
                            <span class="badge badge-primary">720p</span>
                        @endif
                        @if($episode->video_1080p)
                            <span class="badge badge-success">1080p</span>
                        @endif
                        @if(!$episode->video_144p && !$episode->video_360p && !$episode->video_720p && !$episode->video_1080p)
                            <span class="text-muted">No videos</span>
                        @endif
                    </td>
                    <td>
                        @if($episode->duration)
                            {{ gmdate('H:i:s', $episode->duration) }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.episodes.edit', [$anime->id, $episode->id]) }}" 
                               class="btn btn-info" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.episodes.destroy', [$anime->id, $episode->id]) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this episode?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        <div class="py-4">
                            <i class="fas fa-film fa-3x text-muted mb-3"></i>
                            <p class="text-muted">No episodes yet. Add your first episode!</p>
                            <a href="{{ route('admin.episodes.create', $anime->id) }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Add Episode
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection