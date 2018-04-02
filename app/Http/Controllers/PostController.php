<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function show(Post $post, $slug) {

        //abort_unless($post->slug == $slug, 404);
        //abort_if($post->slug != $slug, 404);
        if($post->slug != $slug){
            return redirect($post->url, 301); // 301 = permanent redirection.
        }

        return view('posts.show', compact('post'));
    }
}
