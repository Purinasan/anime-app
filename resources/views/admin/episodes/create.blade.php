@extends('admin.layouts.app')

@section('title', 'Add Episode')

@section('page-title', 'Add Episode - ' . $anime->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.anime.index') }}">Anime List</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.episodes.index', $anime->id) }}">Episodes</a></li>
    <li class="breadcrumb-item active">Add Episode</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">Add New Episode for: {{ $anime->title }}</h3>
            </div>
            
            <form action="{{ route('admin.episodes.store', $anime->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Upload Tips:</strong> 
                        Upload at least one resolution. You can upload multiple resolutions for better quality options.
                        Max file size: 500MB per video.
                    </div>

                    <!-- Episode Number -->
                    <div class="form-group">
                        <label for="episode_number">Episode Number <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control @error('episode_number') is-invalid @enderror" 
                               id="episode_number" 
                               name="episode_number" 
                               value="{{ old('episode_number', $nextEpisodeNumber) }}"
                               min="1"
                               required>
                        @error('episode_number')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Episode Title -->
                    <div class="form-group">
                        <label for="title">Episode Title</label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               placeholder="e.g., The Beginning">
                        <small class="form-text text-muted">Optional: If empty, will use "Episode X"</small>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <hr>
                    <h4 class="mb-3"><i class="fas fa-video"></i> Video Files (Upload at least one)</h4>

                    <!-- Video 144p -->
                    <div class="form-group">
                        <label for="video_144p">
                            <i class="fas fa-mobile-alt"></i> Video 144p (Mobile)
                        </label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('video_144p') is-invalid @enderror" 
                                   id="video_144p" 
                                   name="video_144p"
                                   accept="video/*">
                            <label class="custom-file-label" for="video_144p">Choose 144p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        @error('video_144p')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Video 360p -->
                    <div class="form-group">
                        <label for="video_360p">
                            <i class="fas fa-mobile-alt"></i> Video 360p (Low Quality)
                        </label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('video_360p') is-invalid @enderror" 
                                   id="video_360p" 
                                   name="video_360p"
                                   accept="video/*">
                            <label class="custom-file-label" for="video_360p">Choose 360p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        @error('video_360p')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Video 720p -->
                    <div class="form-group">
                        <label for="video_720p">
                            <i class="fas fa-desktop"></i> Video 720p (HD)
                        </label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('video_720p') is-invalid @enderror" 
                                   id="video_720p" 
                                   name="video_720p"
                                   accept="video/*">
                            <label class="custom-file-label" for="video_720p">Choose 720p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        @error('video_720p')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Video 1080p -->
                    <div class="form-group">
                        <label for="video_1080p">
                            <i class="fas fa-tv"></i> Video 1080p (Full HD)
                        </label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('video_1080p') is-invalid @enderror" 
                                   id="video_1080p" 
                                   name="video_1080p"
                                   accept="video/*">
                            <label class="custom-file-label" for="video_1080p">Choose 1080p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        @error('video_1080p')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-upload"></i> Upload Episode
                    </button>
                    <a href="{{ route('admin.episodes.index', $anime->id) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Update file input labels with filename
    $('input[type="file"]').change(function(e) {
        if (e.target.files.length > 0) {
            var fileName = e.target.files[0].name;
            $(this).next('.custom-file-label').text(fileName);
        }
    });
</script>
@endpush