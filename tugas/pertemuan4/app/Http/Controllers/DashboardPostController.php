<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
        $categories = Category::all();
        return view('dashboard.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input dengan custom messages
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id', // Memastikan ID ada di tabel categories
            'excerpt' => 'required',
            'body' => 'required',
            // Aturan untuk image: Opsional (nullable), harus gambar, format tertentu, max 2MB
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [ // Custom Messages
            'title.required' => 'Field Title wajib diisi',
            'title.max' => 'Field Title harus lebih dari 255 karakter',
            'category_id.required' => 'Field Category wajib dipilih',
            'category_id.exists' => 'Category yang dipilih tidak valid',
            'excerpt.required' => 'Field Excerpt wajib diisi',
            'body.required' => 'Field Content wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator) // Mengirimkan semua pesan error kembali
                ->withInput(); // Mengirimkan semua data yang sudah diinput (old data)
        }

        // Generate slug dari title
        $slug = str()->slug($request->title);

        // Position slug unique - jika sudah ada, tambahkan angka di belakang
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Store file di storage/app/public/post-images
            // Method store() akan generate nama file unik otomatis
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        // Create post
        Post::create([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        // Menampilkan detail post berdasarkan slug
        return view('dashboard.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        // Cek apakah user yang sedang login adalah pemilik post
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Menampilkan form edit post
        $categories = Category::all();
        return view('dashboard.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        // Cek apakah user yang sedang login adalah pemilik post
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi input dengan custom messages
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Field Title wajib diisi',
            'title.max' => 'Field Title harus lebih dari 255 karakter',
            'category_id.required' => 'Field Category wajib dipilih',
            'category_id.exists' => 'Category yang dipilih tidak valid',
            'excerpt.required' => 'Field Excerpt wajib diisi',
            'body.required' => 'Field Content wajib diisi',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate slug dari title jika title berubah
        $slug = $post->slug;
        if ($request->title !== $post->title) {
            $slug = str()->slug($request->title);
            
            // Pastikan slug unique
            $originalSlug = $slug;
            $count = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }

        // Handle file upload
        $imagePath = $post->image_path;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            // Upload gambar baru
            $imagePath = $request->file('image')->store('post-images', 'public');
        }

        // Update post
        $post->update([
            'title' => $request->title,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Post updated successfully!');
    }

    public function destroy(Post $post)
    {
        // Cek apakah user yang sedang login adalah pemilik post
        if ($post->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hapus gambar jika ada
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }

        // Delete post
        $post->delete();

        return redirect()->route('dashboard.index')->with('success', 'Post deleted successfully!');
    }
}
