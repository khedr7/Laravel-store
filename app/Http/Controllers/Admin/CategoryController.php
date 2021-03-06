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
        if ($request->filled('sort')) {
            if ($request->filled('order')) {
                if ($request->order == 'ascending') {
                    if ($request->sort == 'name_ar') {
                        $categories = Category::orderBy('name', 'asc');
                        // $categories = Category::orderByTranslation('name', 'asc')->get();
                    }
                    if ($request->sort == 'name_en') {
                        $categories = Category::orderBy('name', 'asc');
                    }
                    if ($request->sort == 'creation_date') {
                        $categories = Category::orderBy('created_at', 'asc');
                    }
                }
                if ($request->order == 'descending') {
                    if ($request->sort == 'name_ar') {
                        $categories = Category::orderBy('name->ar', 'desc');
                    }
                    if ($request->sort == 'name_en') {
                        $categories = Category::orderBy('name', 'desc');
                    }
                    if ($request->sort == 'creation_date') {
                        $categories = Category::orderBy('created_at', 'desc');
                    }
                }
            }
                else {
                    if ($request->sort == 'name_ar') {
                        $categories = Category::orderBy('name->ar', 'asc');
                    }
                    if ($request->sort == 'name_en') {
                        $categories = Category::orderBy('name', 'asc');
                    }
                    if ($request->sort == 'creation_date') {
                        $categories = Category::orderBy('created_at', 'asc');
                    }
                }
        }
        $categories  = $categories->paginate(8);
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
        $category->clearMediaCollection('images');
        $category->offers()->detach();
        // $category->products()->detach();
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
