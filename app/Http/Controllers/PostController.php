<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        // ::with -> eager loading: reduces queries by bundling similar queries together.
        // in this case, Post has a relationship with User and Like
        // check using https://github.com/barryvdh/laravel-debugbar
        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(20);
        // or replace orderBy with ::latest()->with

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        // create a post THROUGH a user (vs creating a new Post (like for Register->User::create))
        $request->user()->posts()->create([
            // by creating a Post in this manner, laravel will automatically fill in the user_id col
            'body' => $request->get('body')
        ]);
        // could also write ...->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        // call policy function
        // this is defined in PostPolicy and setup within AuthServiceProvider
        // only pass Post as User is implicit with policy
        $this->authorize('delete', $post);

        $post->delete();

        return back();
    }
}
