<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    function allPosts()
    {
        $posts = Post::with('user')->paginate(5);
        return view("posts.index", ["posts" => $posts]);
    }

    function show($id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view("posts.show", ["post" => $post]);
    }

    function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->image && !Str::startsWith($post->image, 'http')) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return to_route("posts.index")->with('success', 'Post deleted successfully');
    }

    function create()
    {
        $users = User::all();
        return view("posts.create", compact("users"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255|min:3',
            'description' => 'required|min:10',
            'image' => 'required|image|max:2048', 
            'user_id' => 'required|exists:users,id'
        ]);
        

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }
    
        $post = Post::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'user_id' => $validated['user_id'],
            'slug' => Str::slug($validated['title'])
        ]);
    
        return to_route("posts.show", $post->id)
            ->with('success', 'Post created successfully');
    }

    function edit($id)
    {
        $users = User::all();
        $post = Post::findOrFail($id);
        return view("posts.edit", compact("post", "users"));
    }

    function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $validationRules = [
            'title' => 'required|max:255',
            'description' => 'required|min:10',
            'user_id' => 'required|exists:users,id'
        ];
        

        if ($request->hasFile('image')) {
            $validationRules['image'] = 'image|max:2048';
        } elseif (!$post->image) {
            $validationRules['image'] = 'required|image|max:2048';
        }
        
        $validated = $request->validate($validationRules);
        
        // Handle image update
        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not a URL
            if ($post->image && !Str::startsWith($post->image, 'http')) {
                Storage::disk('public')->delete($post->image);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        $post->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'user_id' => $validated['user_id'],
            'slug' => Str::slug($validated['title'])
        ]);

        return to_route("posts.show", $post->id)->with('success', 'Post updated successfully');
    }
}