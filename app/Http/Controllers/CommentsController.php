<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
        $comment =new Comment;
        $comment -> body = $request-> body;
        $comment -> user_id = Auth::user()->id;
        $comment -> post_id = $request -> post_id;
        $comment ->save();

        return redirect()->route('posts.show', ['post' => $request->post_id]);
    }
}
