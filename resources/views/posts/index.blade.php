@extends('layouts.app')

@section('content')
<div class="container">

<div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Posts</h1>
        <a href="{{ route('posts.create') }}" class="btn btn-success px-2">
            <i class="bi bi-plus-circle me-1"></i> Add New Post
        </a>
    </div>

    <div class="row">

        @foreach($posts as $post)
            <div class="col-md-4 mb-4">
                <div class="card">
                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="{{ $post->title }} "  style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text">{{ Str::limit($post->description, 100) }}</p>
                        <p class="card-text"><small>Created By: {{ $post->user->name }}</small></p>
                        <!-- Category Info -->
                       <div class="d-flex gap-3  mb-4">
                       <div>
                          <i class="bi bi-bookmark"></i>
                               Category: {{ $post->category->name ?? 'Uncategorized' }}
                           </div>
                          </div>
                        <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Read More</a>
                        
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning">Edit</a>
                        @endcan
                        
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        @endcan
                    </div>

                    
                </div>
            </div>

        @endforeach
        <div class="d-flex justify-content-center mt-4">
    {{ $posts->links() }}
</div>

    </div>
</div>
@endsection