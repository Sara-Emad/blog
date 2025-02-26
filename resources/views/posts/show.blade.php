@extends('layouts.app')
@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="row g-0">
            <!-- Image Column -->
            <div class="col-md-6">
                @if($post->image)
                    <img 
                        src="{{ Storage::url($post->image) }}" 
                        alt="{{ $post->title }}" 
                        class="img-fluid rounded-start h-100"
                        style="object-fit: cover; max-height: 500px; width: 100%;"
                    >
                @else
                    <div class="bg-light h-100 d-flex align-items-center justify-content-center">
                        <p class="text-muted">No image available</p>
                    </div>
                @endif
            </div>
            
            <!-- Content Column -->
            <div class="col-md-6">
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $post->title }}</h1>
                    
                    <!-- Author and Date Info -->
                    <div class="d-flex gap-3 text-muted mb-4">
                        <div>
                            <i class="bi bi-person-circle"></i>
                            {{ $post->user->name }}
                        </div>
                        <div>
                            <i class="bi bi-calendar"></i>
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="card-text mb-4">
                        {!! nl2br(e($post->description)) !!}
                    </div>
                    
                    <p class="card-text"><small>Created By: {{ $post->user->name }}</small></p>
                      <!-- Category Info -->
                    <div class="d-flex gap-3 text-muted mb-4">
                        <div>
                            <i class="bi bi-bookmark"></i>
                            Category: {{ $post->category->name ?? 'Uncategorized' }}
                        </div>
                    </div>
                    <!-- Actions -->
                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back
                        </a>
                        
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                        
                        @can('update-post', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
                        @endcan
                                                
                        @can('delete-post', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection