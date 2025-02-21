@extends('layouts.app')
@section('title')
Posts
@endsection
@section("main")
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-success px-2">
            <i class="bi bi-plus-circle me-1"></i> Add New Post
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse ($posts as $post)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img 
                        src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}" 
                        class="card-img-top"
                        alt="{{ $post->title }}" 
                        style="height: 200px; object-fit: cover;"
                    >
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text text-truncate">{{ $post->description }}</p>
                        <p class="text-muted"><small>By: <b>{{ $post->user->name ?? 'Unknown' }}</b></small></p>
                        <p class="text-muted"><small>Created: {{ $post->created_at->format('M d, Y') }}</small></p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye me-1"></i> View
                            </a>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil me-1"></i> Edit
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post" class="d-inline">
                                @csrf
                                @method("delete")
                                <button type="submit" class="btn btn-sm btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this post?')">
                                    <i class="bi bi-trash me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    No posts found. <a href="{{ route('posts.create') }}">Create your first post</a>!
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection