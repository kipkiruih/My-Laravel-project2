<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->take(3)->get(); // Get latest 3 blogs
        return view('home', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        
        return view('blog.show', compact('blog'));
    }
    public function blogIndex()
{
    $blogs = Blog::latest()->paginate(6); // Paginate with 6 blogs per page
    return view('blog.index', compact('blogs'));
}

}
