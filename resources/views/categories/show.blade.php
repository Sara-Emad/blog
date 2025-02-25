@extends('layouts.app')
@section('title')
    {{ $category->name }}
@endsection
@section("content")
<div class="container my-4">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h1 class="card-title">{{ $category->name }}</h1>
            @if($category->description)
                <p class="card-text">{{ $category->description }}</p>
            @endif
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil me-1">Edit Category</i> 
                </a>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-1">Return to menu</i> 
                </a>
            </div>
        </div>
    </div>

    <h3 class="mb-3"> posts in this category  </h3>
    
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
                        <p class="text-muted"><small>By: <b>{{ $post->user->name ?? 'unknown' }}</b></small></p>
                        <p class="text-muted"><small>date create : {{ $post->created_at->format('Y-m-d') }}</small></p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary w-100">
                          read more
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    no posts yet
                </div>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection