<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostContoller extends Controller
{
    public function index()
    {
        $posts = Post::all();
       /*  $posts = Post::where('published', false)->get(); */
        return response()->json($posts);
    }
}
