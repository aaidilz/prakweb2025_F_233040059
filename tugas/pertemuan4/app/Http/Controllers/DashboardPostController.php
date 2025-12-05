<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPostController extends Controller
{
    public function index()
    {
        // menampilkan user_id dari user yang sedang login
        $posts = Post::where('user_id', Auth::id());

        // fitur search
        if (request('search')) {
            $posts = $posts->where('title', 'like', '%' . request('search') . '%');
        }

        // menampilkan 5 data per halaman dengan pagination
        return view('dashboard.index', ['posts' => $posts->paginate(5)->withQueryString()]);
    }

    public function create()
    {
        // menampilkan create post baru
        return view('dashboard.create');
    }

    public function store(Request $request)
    {
        // TODO: implement create logic; placeholder to avoid error
        return back()->with('status', 'Store action belum diimplementasikan.');
    }

    public function show(Post $post)
    {
        // Menampilkan detail post berdasarkan slug
        return view('dashboard.show', ['post' => $post]);
    }
}
