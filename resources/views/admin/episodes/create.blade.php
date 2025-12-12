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
            
            <form action="{{ route('admin.episodes.store', $anime->id) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                
                <div class="card-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> 
                        <strong>Upload Tips:</strong> 
                        Upload at least one resolution. Large files may take several minutes to upload.
                        Max file size: 500MB per video.
                    </div>

                    <!-- Upload Progress Bar -->
                    <div id="uploadProgress" style="display: none;">
                        <div class="alert alert-warning">
                            <h5><i class="fas fa-spinner fa-spin"></i> Uploading...</h5>
                            <div class="progress mb-2" style="height: 30px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" 
                                     id="progressBar" 
                                     role="progressbar" 
                                     style="width: 0%; font-size: 16px; font-weight: bold;">
                                    0%
                                </div>
                            </div>
                            <p class="mb-0"><strong>Please wait... Do not close this page!</strong></p>
                            <p class="mb-0" id="uploadStatus">Preparing upload...</p>
                        </div>
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
                                   class="custom-file-input video-file @error('video_144p') is-invalid @enderror" 
                                   id="video_144p" 
                                   name="video_144p"
                                   accept="video/*"
                                   data-resolution="144p">
                            <label class="custom-file-label" for="video_144p">Choose 144p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        <div class="file-size-info" id="size_144p"></div>
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
                                   class="custom-file-input video-file @error('video_360p') is-invalid @enderror" 
                                   id="video_360p" 
                                   name="video_360p"
                                   accept="video/*"
                                   data-resolution="360p">
                            <label class="custom-file-label" for="video_360p">Choose 360p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        <div class="file-size-info" id="size_360p"></div>
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
                                   class="custom-file-input video-file @error('video_720p') is-invalid @enderror" 
                                   id="video_720p" 
                                   name="video_720p"
                                   accept="video/*"
                                   data-resolution="720p">
                            <label class="custom-file-label" for="video_720p">Choose 720p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        <div class="file-size-info" id="size_720p"></div>
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
                                   class="custom-file-input video-file @error('video_1080p') is-invalid @enderror" 
                                   id="video_1080p" 
                                   name="video_1080p"
                                   accept="video/*"
                                   data-resolution="1080p">
                            <label class="custom-file-label" for="video_1080p">Choose 1080p video</label>
                        </div>
                        <small class="form-text text-muted">Format: MP4, MKV, AVI, WebM | Max: 500MB</small>
                        <div class="file-size-info" id="size_1080p"></div>
                        @error('video_1080p')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div id="totalSizeInfo" class="alert alert-secondary" style="display: none;">
                        <strong>Total Upload Size:</strong> <span id="totalSize">0 MB</span>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success" id="submitBtn">
                        <i class="fas fa-upload"></i> Upload Episode
                    </button>
                    <a href="{{ route('admin.episodes.index', $anime->id) }}" class="btn btn-secondary" id="cancelBtn">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .file-size-info {
        margin-top: 5px;
        font-weight: bold;
    }
    .file-size-ok {
        color: #28a745;
    }
    .file-size-warning {
        color: #ffc107;
    }
    .file-size-error {
        color: #dc3545;
    }
</style>
@endpush

@push('scripts')
<script>
    let totalFileSize = 0;
    const MAX_FILE_SIZE = 500 * 1024 * 1024; // 500MB in bytes

    // Update file input labels and show file size
    $('.video-file').change(function(e) {
        if (e.target.files.length > 0) {
            const file = e.target.files[0];
            const fileName = file.name;
            const fileSize = file.size;
            const resolution = $(this).data('resolution');
            
            // Update label
            $(this).next('.custom-file-label').text(fileName);
            
            // Show file size
            const sizeMB = (fileSize / (1024 * 1024)).toFixed(2);
            let sizeClass = 'file-size-ok';
            let sizeIcon = 'check-circle';
            
            if (fileSize > MAX_FILE_SIZE) {
                sizeClass = 'file-size-error';
                sizeIcon = 'times-circle';
            } else if (fileSize > MAX_FILE_SIZE * 0.8) {
                sizeClass = 'file-size-warning';
                sizeIcon = 'exclamation-triangle';
            }
            
            $(`#size_${resolution.replace('p', '')}`).html(
                `<i class="fas fa-${sizeIcon}"></i> File size: <span class="${sizeClass}">${sizeMB} MB</span>`
            );
            
            // Calculate total size
            calculateTotalSize();
        }
    });

    function calculateTotalSize() {
        totalFileSize = 0;
        $('.video-file').each(function() {
            if (this.files.length > 0) {
                totalFileSize += this.files[0].size;
            }
        });
        
        if (totalFileSize > 0) {
            const totalMB = (totalFileSize / (1024 * 1024)).toFixed(2);
            $('#totalSize').text(totalMB + ' MB');
            $('#totalSizeInfo').show();
        } else {
            $('#totalSizeInfo').hide();
        }
    }

    // Handle form submission with progress
    $('#uploadForm').submit(function(e) {
        e.preventDefault();
        
        // Validate at least one video selected
        let hasVideo = false;
        $('.video-file').each(function() {
            if (this.files.length > 0) {
                hasVideo = true;
            }
        });
        
        if (!hasVideo) {
            alert('Please select at least one video file!');
            return false;
        }
        
        // Check file sizes
        let oversizedFiles = false;
        $('.video-file').each(function() {
            if (this.files.length > 0 && this.files[0].size > MAX_FILE_SIZE) {
                oversizedFiles = true;
            }
        });
        
        if (oversizedFiles) {
            alert('One or more files exceed 500MB limit!');
            return false;
        }
        
        // Show progress bar
        $('#uploadProgress').show();
        $('#submitBtn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Uploading...');
        $('#cancelBtn').prop('disabled', true);
        
        // Create FormData
        const formData = new FormData(this);
        
        // Upload with AJAX to show progress
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            xhr: function() {
                const xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        const percentComplete = Math.round((e.loaded / e.total) * 100);
                        $('#progressBar').css('width', percentComplete + '%').text(percentComplete + '%');
                        
                        const uploadedMB = (e.loaded / (1024 * 1024)).toFixed(2);
                        const totalMB = (e.total / (1024 * 1024)).toFixed(2);
                        $('#uploadStatus').text(`Uploaded: ${uploadedMB} MB / ${totalMB} MB`);
                        
                        if (percentComplete === 100) {
                            $('#uploadStatus').text('Processing... Please wait...');
                        }
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                $('#progressBar').removeClass('progress-bar-animated').addClass('bg-success');
                $('#uploadStatus').html('<i class="fas fa-check-circle"></i> Upload successful! Redirecting...');
                
                // Redirect after short delay
                setTimeout(function() {
                    window.location.href = '{{ route("admin.episodes.index", $anime->id) }}';
                }, 1500);
            },
            error: function(xhr) {
                $('#uploadProgress').removeClass('alert-warning').addClass('alert-danger');
                $('#progressBar').removeClass('progress-bar-animated').addClass('bg-danger');
                $('#uploadStatus').html('<i class="fas fa-times-circle"></i> Upload failed! Please try again.');
                $('#submitBtn').prop('disabled', false).html('<i class="fas fa-upload"></i> Upload Episode');
                $('#cancelBtn').prop('disabled', false);
                
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = '';
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errors += value[0] + '<br>';
                    });
                    $('#uploadStatus').html('<i class="fas fa-times-circle"></i> ' + errors);
                }
            }
        });
    });
</script>
@endpush