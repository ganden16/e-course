@extends('admin.layouts.app')

@section('title', isset($blogTag) ? 'Edit Tag' : 'Create Tag')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ isset($blogTag) ? 'Edit Tag' : 'Create Tag' }}</h1>
        <a href="{{ route('admin.blog-tags') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Tags
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ isset($blogTag) ? route('admin.blog-tags.update', $blogTag) : route('admin.blog-tags.store') }}">
                @csrf
                @method(isset($blogTag) ? 'PUT' : 'POST')

                <div class="row">
                    <div class="col-md-6">
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', isset($blogTag) ? $blogTag->name : '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', isset($blogTag) ? $blogTag->slug : '') }}" readonly>
                            <small class="form-text text-muted">Auto-generated from name</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <!-- Color -->
                        <div class="mb-3">
                            <label for="color" class="form-label">Color</label>
                            <div class="input-group">
                                <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{ old('color', isset($blogTag) ? $blogTag->color : '') }}" placeholder="#3B82F6">
                                <input type="color" class="form-control form-control-color" id="color_picker" value="{{ old('color', isset($blogTag) ? $blogTag->color : '#3B82F6') }}" style="max-width: 60px;">
                            </div>
                            <small class="form-text text-muted">Choose a color for the tag</small>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input @error('is_active') is-invalid @enderror" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', isset($blogTag) ? $blogTag->is_active : true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Preview -->
                        <div class="mb-3">
                            <label class="form-label">Preview</label>
                            <div class="p-3 border rounded">
                                <div id="tag_preview" class="d-inline-flex align-items-center px-3 py-1 rounded-full text-white" style="background-color: {{ old('color', isset($blogTag) ? $blogTag->color : '#3B82F6') }};">
                                    <i class="fas fa-tag me-2"></i>
                                    <span id="tag_preview_text">{{ old('name', isset($blogTag) ? $blogTag->name : 'Tag Name') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> {{ isset($blogTag) ? 'Update Tag' : 'Create Tag' }}
                            </button>
                            <a href="{{ route('admin.blog-tags') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Auto-generate slug from name
    $('#name').on('input', function() {
        var name = $(this).val();
        var slug = name.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        $('#slug').val(slug);

        // Update preview
        $('#tag_preview_text').text(name || 'Tag Name');
    });

    // Color picker sync
    $('#color_picker').on('input', function() {
        var color = $(this).val();
        $('#color').val(color);
        $('#tag_preview').css('background-color', color);
    });

    // Color input sync
    $('#color').on('input', function() {
        var color = $(this).val();
        if (/^#[0-9A-F]{6}$/i.test(color)) {
            $('#color_picker').val(color);
            $('#tag_preview').css('background-color', color);
        }
    });
});
</script>
@endpush
