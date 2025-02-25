@extends('layouts.app')
@section('title')
    Categories menu
@endsection
@section("content")
<div class="container my-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Categories menu</h1>
        <a href="{{ route('categories.create') }}" class="btn btn-success px-2">
            <i class="bi bi-plus-circle me-1">add new categories</i> 
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>category name </th>
                            <th> posts number</th>
                            <th>Created at  </th>
                            <!-- <th>Happens</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $category->posts_count }}</span>
                                </td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye">show</i> 
                                        </a>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">
                                            <i class="bi bi-pencil">edit</i> 
                                        </a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Are you Sure?')">
                                                <i class="bi bi-trash">delete</i> 
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="alert alert-info mb-0">
                                        No categores yet <a href="{{ route('categories.create') }}">Add New category</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links() }}
    </div>
</div>
@endsection