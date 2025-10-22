<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::all(),
            'users' => User::all(),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create',[
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'title'         => 'required|min:5|max:32',
                'description'   => 'nullable',
                'text'          => 'required',
                'categories'    => 'nullable|array',
                'categories.*'  => 'numeric|integer|exists:categories,id',
                'cover_image'   => 'file|mimes:jpg,png|max:4096'
            ]
        );

        $cover_image_path = '';
        if($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $cover_image_path = 'cover_image_'.Str::random(10).'.'.$file->getClientOriginalExtension();
            Storage::disk('public')->put($cover_image_path,$file->get());
        }

        $post = Post::factory()->create([
                'title'             => $validated['title'],
                'description'       => $validated['description'],
                'text'              => $validated['text'],
                'cover_image_path'  => $cover_image_path == '' ? null : $cover_image_path,
        ]);

        if(isset($validated['categories'])) {
            $post->categories()->attach($validated['categories']);
        }
        return redirect()->route('posts.show',$post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
