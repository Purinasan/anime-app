@extends('admin.layouts.app')

@section('title', 'Add New Anime')

@section('page-title', 'Add New Anime')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.anime.index') }}">Anime List</a></li>
    <li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Anime Information</h3>
            </div>
            
            <form action="{{ route('admin.anime.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               placeholder="Enter anime title"
                               value="{{ old('title') }}"
                               required>
                        @error('title')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Genre -->
                    <div class="form-group">
                        <label for="genre">Genre <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('genre') is-invalid @enderror" 
                               id="genre" 
                               name="genre" 
                               placeholder="e.g., Action, Drama, Romance"
                               value="{{ old('genre') }}"
                               required>
                        @error('genre')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="5" 
                                  placeholder="Enter anime description"
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div class="form-group">
                        <label for="rating">Rating <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('rating') is-invalid @enderror" 
                               id="rating" 
                               name="rating" 
                               placeholder="e.g., 8.5/10"
                               value="{{ old('rating') }}"
                               required>
                        @error('rating')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label for="image">Anime Image</label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            <label class="custom-file-label" for="image">Choose image</label>
                        </div>
                        <small class="form-text text-muted">
                            Supported formats: JPG, PNG, GIF, WebP (Max: 5MB)
                        </small>
                        @error('image')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        
                        <!-- Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <img id="preview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 300px;">
                        </div>
                    </div>

                    <!-- Video URL -->
<!-- Video URL -->
                <div class="form-group">
                    <label for="video_url">
                        <i class="fab fa-youtube text-danger"></i> YouTube Trailer URL
                    </label>
                    <input type="url" 
                        class="form-control @error('video_url') is-invalid @enderror" 
                        id="video_url" 
                        name="video_url" 
                        placeholder="https://www.youtube.com/watch?v=..."
                        value="{{ old('video_url') }}">
                    <small class="form-text text-muted">
                        Optional: Add a YouTube trailer link
                    </small>
                    @error('video_url')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Opening URL - NEW -->
                <div class="form-group">
                    <label for="opening_url">
                        <i class="fab fa-youtube text-danger"></i> YouTube Opening URL
                    </label>
                    <input type="url" 
                        class="form-control @error('opening_url') is-invalid @enderror" 
                        id="opening_url" 
                        name="opening_url" 
                        placeholder="https://www.youtube.com/watch?v=..."
                        value="{{ old('opening_url') }}">
                    <small class="form-text text-muted">
                        Optional: Add a YouTube opening link
                    </small>
                    @error('opening_url')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Anime
                    </button>
                    <a href="{{ route('admin.anime.index') }}" class="btn btn-secondary">
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
    // Update file input label with filename
    $('input[type="file"]').change(function(e) {
        var fileName = e.target.files[0].name;
        $('.custom-file-label').text(fileName);
    });

    // Image preview function
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');
        const previewDiv = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewDiv.style.display = 'block';
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush