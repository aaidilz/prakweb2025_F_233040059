<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DashboardCategoryController extends Controller
{
    public function index()
    {
        // Menampilkan semua kategori dengan jumlah posts
        $categories = Category::withCount('posts')->get();
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat kategori baru
        return view('dashboard.categories.create');
    }

    public function store(Request $request)
    {
        // Validasi input dengan custom messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name',
            'slug' => 'required|max:255|unique:categories,slug',
        ], [
            'name.required' => 'Field Name wajib diisi',
            'name.max' => 'Field Name harus kurang dari 255 karakter',
            'name.unique' => 'Category dengan nama ini sudah ada',
            'slug.required' => 'Field Slug wajib diisi',
            'slug.max' => 'Field Slug harus kurang dari 255 karakter',
            'slug.unique' => 'Slug ini sudah digunakan',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create category
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(Category $category)
    {
        // Menampilkan form edit kategori
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Validasi input dengan custom messages
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
            'slug' => 'required|max:255|unique:categories,slug,' . $category->id,
        ], [
            'name.required' => 'Field Name wajib diisi',
            'name.max' => 'Field Name harus kurang dari 255 karakter',
            'name.unique' => 'Category dengan nama ini sudah ada',
            'slug.required' => 'Field Slug wajib diisi',
            'slug.max' => 'Field Slug harus kurang dari 255 karakter',
            'slug.unique' => 'Slug ini sudah digunakan',
        ]);

        // Jika validasi gagal, redirect kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update category
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(Category $category)
    {
        // Cek apakah kategori memiliki posts
        if ($category->posts()->count() > 0) {
            return redirect()->route('dashboard.categories.index')
                ->with('error', 'Cannot delete category that has posts!');
        }

        // Delete category
        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully!');
    }
}
