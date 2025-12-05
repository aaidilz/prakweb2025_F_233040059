<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $query = Post::query();
        
        if ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                  ->orWhere('excerpt', 'like', '%' . $search . '%');
        }
        
        $posts = $query->paginate(9);
        
        return view('posts', compact('posts', 'search'));
    }

    public function show(Post $post)
    {
        return view('post', compact('post'));
    }
}
