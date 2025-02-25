@extends('layouts.app')
@section('title')
Add Post
@endsection
@section("content")
<div class="row my-2">
    <div class="col-md-8 mx-auto">
        <div class="d-flex align-items-center mb-4">
            <h2>Add New Post</h2>
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

        <form action="{{ route('posts.store') }}" method="post" class="needs-validation" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
    </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea class="form-control @error('description') is-invalid @enderror" 
                          id="description" 
                          rows="3" 
                          placeholder="Enter post description" 
                          name="description"
                          d>{{ old('description') }}</textarea>
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
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('user_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Post Image <span class="text-danger">*</span></label>
                <input type="file" 
                       class="form-control @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image"
                       accept="image/*"
                       d>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="text-muted">Please upload an image file (JPG, PNG, GIF, etc.) up to 2MB</small>
            </div>
            <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select class="form-control" id="category_id" name="category_id">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
           <br>
           
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Add Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
            </div>

          
</div>

        </form>
    </div>
</div>
@endsection