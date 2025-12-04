@extends('admin.layouts.app')

@section('title', 'Edit Anime')

@section('page-title', 'Edit Anime')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.anime.index') }}">Anime List</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Edit: {{ $anime->title }}</h3>
            </div>
            
            <form action="{{ route('admin.anime.update', $anime->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('title') is-invalid @enderror" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $anime->title) }}"
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
                               value="{{ old('genre', $anime->genre) }}"
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
                                  required>{{ old('description', $anime->description) }}</textarea>
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
                               value="{{ old('rating', $anime->rating) }}"
                               required>
                        @error('rating')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Current Image -->
                    @if($anime->image)
                    <div class="form-group">
                        <label>Current Image</label>
                        <div>
                            <img src="{{ asset('storage/' . $anime->image) }}" 
                                 alt="{{ $anime->title }}" 
                                 class="img-thumbnail" 
                                 style="max-width: 300px;">
                        </div>
                    </div>
                    @endif

                    <!-- New Image Upload -->
                    <div class="form-group">
                        <label for="image">Change Image</label>
                        <div class="custom-file">
                            <input type="file" 
                                   class="custom-file-input @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image"
                                   accept="image/*"
                                   onchange="previewImage(event)">
                            <label class="custom-file-label" for="image">Choose new image</label>
                        </div>
                        <small class="form-text text-muted">
                            Leave empty to keep current image. Supported formats: JPG, PNG, GIF, WebP (Max: 5MB)
                        </small>
                        @error('image')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                        
                        <!-- New Image Preview -->
                        <div id="imagePreview" class="mt-3" style="display: none;">
                            <label>New Image Preview:</label>
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
                    value="{{ old('video_url', $anime->video_url) }}"
                    placeholder="https://www.youtube.com/watch?v=...">
                <small class="form-text text-muted">
                    Optional: YouTube trailer link
                </small>
                @error('video_url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                
                @if($anime->video_url)
                <div class="mt-2">
                    <a href="{{ $anime->video_url }}" target="_blank" class="btn btn-sm btn-danger">
                        <i class="fab fa-youtube"></i> Watch Current Trailer
                    </a>
                </div>
                @endif
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
                    value="{{ old('opening_url', $anime->opening_url) }}"
                    placeholder="https://www.youtube.com/watch?v=...">
                <small class="form-text text-muted">
                    Optional: YouTube opening link
                </small>
                @error('opening_url')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                
                @if($anime->opening_url)
                <div class="mt-2">
                    <a href="{{ $anime->opening_url }}" target="_blank" class="btn btn-sm btn-danger">
                        <i class="fab fa-youtube"></i> Watch Current Opening
                    </a>
                </div>
                @endif
            </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Update Anime
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
        if (e.target.files.length > 0) {
            var fileName = e.target.files[0].name;
            $('.custom-file-label').text(fileName);
        }
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