<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::latest();
        if ($request->filled('search')) {
            $categories->where('name', 'like', "%$request->search%");
        }
        $categories  = $categories->paginate(10);
        return view('admin.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->dd();
        $validation = $request->validate([
            'name'     => 'required',
            'name.*'   => 'required|min:3',
            'images'   => 'required|array',
            'images.*' => 'required|file|image',
        ]);

        $category = Category::create($validation);
        if ($request->hasFile('images')) {
            $fileAdders = $category->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->preservingOriginal()->toMediaCollection('images');
            });
        }
        return redirect()->route('admin.categories.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $mediaItems = $category->getMedia('images');
        return view('admin.categories.show', ['category' => $category, 'mediaItems' => $mediaItems]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $mediaItems = $category->getMedia('images');
        return view('admin.categories.edit', ['category' => $category, 'mediaItems' => $mediaItems]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validation = $request->validate([
            'name'     => 'required',
            'name.*'   => 'required|min:3',
            'images'   => 'required|array',
            'images.*' => 'required|file|image',
        ]);


        foreach ($validation['name'] as $lang => $name) {
            $category->setTranslation('name', $lang, $name);
        }
        if ($request->hasFile('images')) {
            $category->clearMediaCollection('images');
            $fileAdders = $category->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('images');
            });
        }

        $category->save();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // $category->clearMediaCollection('images');
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
