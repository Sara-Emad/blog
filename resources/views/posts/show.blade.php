@extends('layouts.app')
@section('title')
{{ $post->title }} - Post Details
@endsection
@section("main")
<div class="container my-4">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow">
        <div class="row g-0">
            <div class="col-md-5">
                <img 
                    src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                    class="img-fluid rounded-start h-100"
                    alt="{{ $post->title }}" 
                    style="object-fit: cover; max-height: 500px; width: 100%;"
                >
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h2 class="card-title">{{ $post->title }}</h2>
                    <div class="d-flex gap-3 text-muted mb-3">
                        <div><i class="bi bi-person"></i> {{ $post->user->name ?? 'Unknown' }}</div>
                        <div><i class="bi bi-calendar"></i> {{ $post->created_at->format('M d, Y') }}</div>
                        <div><i class="bi bi-clock"></i> {{ $post->updated_at->diffForHumans() }}</div>
                    </div>
                    
                    <div class="card-text mb-4">
                        {!! nl2br(e($post->description)) !!}
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Posts
                        </a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil"></i> Edit Post
                        </a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="d-inline">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger" 
                                    onclick="return confirm('Are you sure you want to delete this post?')">
                                <i class="bi bi-trash"></i> Delete Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection