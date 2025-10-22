<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'style' => [
                    'required',
                    Rule::in(Category::$styles),
                ],
                'name' => 'required|min:5|max:16',
            ],
            [
                'name.required' => 'The NAME IS REQUIRED!!!!!',
                'required' => "REQUIRED!!",
            ]
        );

        Category::factory()->create($validated);
        Session::flash('category_created');
        Session::flash('name',$validated['name']);
        Session::flash('style',$validated['style']);
        
        return redirect()->route('categories.create');
        //!
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
