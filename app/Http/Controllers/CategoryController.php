<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('posts')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return to_route('categories.index')->with('success', 'Category created successfully');
    }

    public function show(Category $category)
    {
        $posts = $category->posts()->with('user')->paginate(5);
        return view('categories.show', compact('category', 'posts'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return to_route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->posts()->count() > 0) {
            return back()->with('error', 'Cannot delete a category that contains posts');
        }
        $category->delete();
        return to_route('categories.index')->with('success', 'Category deleted successfully');
    }
}