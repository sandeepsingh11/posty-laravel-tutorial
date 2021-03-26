<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        // works for 1-many
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);


        // send mail
        Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));

        return back();
    }

    public function destroy(Post $post, Request $request)
    {
        // get current user->their likes->where post id equals->delete
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
