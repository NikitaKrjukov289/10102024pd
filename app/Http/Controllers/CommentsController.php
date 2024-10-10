<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Http\Controllers\PostsController;

class CommentsController extends Controller
{
    public function store(Request $request, $slug)
    {
        $request->validate([
            'content' => 'required'
        ]);

        Post::where('slug', $slug)->first();

        Comment::create([
            'content' => $request->input('content'),
            'user_id' => auth()->user()->id,
        ]);

        return redirect("/blog/{$slug}")
            ->with('message', 'Your comment has been added!');
    }

}
