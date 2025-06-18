<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(2);
        return view('blogs.index', compact('blogs'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'featured_images' => 'nullable|mimes:jpeg,png,jpg,gif,avif|max:2048',
        ]);

        if ($request->hasFile('featured_images')){
            $data['featured_images'] = $request->file('featured_images')->store('blogs', 'public');        
        }
        Blog::create($data);
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'author' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'featured_images' => 'nullable|mimes:jpeg,png,jpg,gif,avif|max:2048',
        ]);
         if ($request->hasFile('featured_images')){
            $data['featured_images'] = $request->file('featured_images')->store('blogs', 'public');        
        }
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->update($data);
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    // Show all soft-deleted blogs (Recycle Bin)
    public function recycleBin()
    {
        $deletedBlogs = Blog::onlyTrashed()->latest()->paginate(3);
        return view('blogs.recycle-bin', compact('deletedBlogs'));
    }

    // Restore soft-deleted blog
    public function restore($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->restore();
        return redirect()->route('blogs.recycle-bin')->with('success', 'Blog restored successfully.');
    }

    // Permanently delete blog
    public function forceDelete($id)
    {
        $blog = Blog::withTrashed()->findOrFail($id);
        $blog->forceDelete();
        return redirect()->route('blogs.recycle-bin')->with('success', 'Blog permanently deleted.');
    }


    /**
     * Remove the specified resource from storage.
    */
    public function destroy(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $blog->delete();
        return redirect()-> route('blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
