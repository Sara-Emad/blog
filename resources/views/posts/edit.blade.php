@extends('layouts.app')
@section('title')
Edit Post
@endsection
@section("main")
<div class="row my-2">
    <div class="col-md-8 mx-auto">
        <div class="d-flex align-items-center mb-4">
            <h2>Update Post</h2>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method("put")
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       placeholder="Enter post title" 
                       name="title" 
                       value="{{ old('title', $post->title) }}"
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          rows="3" 
                          placeholder="Enter post description" 
                          name="description"
                          required>{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Select Author <span class="text-danger">*</span></label>
                <select class="form-control @error('user_id') is-invalid @enderror" 
                        name="user_id" 
                        id="user_id"
                        required>
                    <option value="">Select a User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ (old('user_id', $post->user_id) == $user->id) ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Post Image</label>
                @if($post->image)
                    <div class="mb-2">
                        <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                             alt="Current post image" 
                             class="img-thumbnail" 
                             style="max-height: 200px">
                        <p class="text-muted mb-0">Current image</p>
                    </div>
                @endif
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image"
                       accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Upload a new image to replace the current one (JPG, PNG, GIF, etc.) up to 2MB</small>
            </div>
           
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection