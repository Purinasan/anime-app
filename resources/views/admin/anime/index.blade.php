@extends('admin.layouts.app')

@section('title', 'Manage Anime')

@section('page-title', 'Anime List')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.anime.index') }}">Home</a></li>
    <li class="breadcrumb-item active">Anime List</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Anime</h3>
        <div class="card-tools">
            <a href="{{ route('admin.anime.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Add New Anime
            </a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="animeTable">
            <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Rating</th>
                    <th>Video</th>
                    <th style="width: 150px">Actions</th>
                </tr>
            </thead>
                <tbody>
            @forelse($anime as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" 
                            alt="{{ $item->title }}" 
                            class="img-thumbnail" 
                            style="width: 60px; height: 60px; object-fit: cover;">
                    @else
                        <div class="bg-secondary text-white d-flex align-items-center justify-content-center" 
                            style="width: 60px; height: 60px; border-radius: 4px;">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </td>
                <td>
                    <strong>{{ $item->title }}</strong>
                    <br>
                    <small class="text-muted">{{ Str::limit($item->description, 50) }}</small>
                </td>
                <td><span class="badge badge-info">{{ $item->genre }}</span></td>
                <td><span class="badge badge-warning">⭐ {{ $item->rating }}</span></td>
                <td style="min-width: 100px;">
                    @if($item->video_url)
                        <a href="{{ $item->video_url }}" target="_blank" class="btn btn-xs btn-danger mb-1 d-block">
                            <i class="fab fa-youtube"></i> Trailer
                        </a>
                    @endif
                    @if($item->opening_url)
                        <a href="{{ $item->opening_url }}" target="_blank" class="btn btn-xs btn-info d-block">
                            <i class="fab fa-youtube"></i> Opening
                        </a>
                    @endif
                    @if(!$item->video_url && !$item->opening_url)
                        <span class="text-muted small">No video</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('admin.anime.edit', $item->id) }}" 
                        class="btn btn-info" 
                        title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.anime.destroy', $item->id) }}" 
                            method="POST" 
                            class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this anime?')">
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
                <td colspan="7" class="text-center">
                    <div class="py-4">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No anime found. Add your first anime!</p>
                        <a href="{{ route('admin.anime.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Anime
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

