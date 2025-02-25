<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller

{

  public function __construct()
  {
      $this->middleware('auth')->except(['index', 'show']);
  }


    public function allPosts()
    {
        $posts = Post::with(['user', 'category'])->paginate(5);
        return view("posts.index", ["posts" => $posts]);
    }

    public function show($id)
    {
        $post = Post::with(['user', 'category'])->findOrFail($id);
        return view("posts.show", ["post" => $post]);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image && !Str::startsWith($post->image, 'http')) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return to_route("posts.index")->with('success', 'Delete Successfuly');
    }

    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view("posts.create", compact("users", "categories"));
    }

    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
        
        $post = Post::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'user_id' => $validated['user_id'],
            'category_id' => $validated['category_id'],
            'slug' => Str::slug($validated['title'])
        ]);
        
        return to_route("posts.show", $post->id)
            ->with('success', 'Done successfuly');
    }

    public function edit($id)
    {
        $users = User::all();
        $categories = Category::all();
        $post = Post::findOrFail($id);
        return view("posts.edit", compact("post", "users", "categories"));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $validated = $request->validated();
        
        // Initialize $imagePath with the existing image path
        $imagePath = $post->image;
        
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not a URL
            if ($post->image && !Str::startsWith($post->image, 'http')) {
                Storage::disk('public')->delete($post->image);
            }
            // Store the new image
            $imagePath = $request->file('image')->store('posts', 'public');
        } elseif (!$request->hasFile('image') && $request->has('remove_image')) {
            // If remove_image is set and no new image is uploaded, delete the old image
            if ($post->image && !Str::startsWith($post->image, 'http')) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = null;
        }
        // If no new image is uploaded and no remove request, keep the old image
        
        $post->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath, 
            'user_id' => $validated['user_id'],
            'category_id' => $validated['category_id'],
            'slug' => Str::slug($validated['title'])
        ]);
        
        return to_route("posts.show", $post->id)
            ->with('success', 'Post updated successfully');
    }

}