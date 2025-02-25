@extends('layouts.app')
@section('title')
Edit Post
@endsection
@section("content")
<div class="row my-2">
    <div class="col-md-8 mx-auto">
        <div class="d-flex align-items-center mb-4">
            <h2>Update Post</h2>
        </div>
        
        <!-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif -->

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
                       d>
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
                          d>{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Select Author <span class="text-danger">*</span></label>
                <select class="form-control @error('user_id') is-invalid @enderror" 
                        name="user_id" 
                        id="user_id"
                        d>
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
            <img src="{{ Storage::url($post->image) }}" alt="Current post image" style="max-width: 200px" class="mb-2">
        </div>
    @endif
    <input type="file" 
           class="form-control @error('image') is-invalid @enderror" 
           id="image" 
           name="image">
    <small class="text-muted">Leave empty to keep the current image</small>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

            <div class="mb-3">
    <label for="category_id" class="form-label">category <span class="text-danger">*</span></label>
    <select class="form-control @error('category_id') is-invalid @enderror" 
            name="category_id" 
            id="category_id"
            d>
        <option value=""> choose category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ (old('category_id', $post->category_id) == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

           
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-secondary">Cancel</a>
            </div>

        </form>
    </div>
</div>
@endsection