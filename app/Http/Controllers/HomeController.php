<?php

namespace App\Http\Controllers;
use App\Models\Property;
use App\Models\Blog;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { $blogs = Blog::latest()->take(3)->get(); // Get latest 3 blogs
        $properties = Property::latest()->take(5)->get(); // Fetch latest 5 properties
        return view('home', compact('properties','blogs'));
    }

}
