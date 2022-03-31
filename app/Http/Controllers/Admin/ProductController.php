<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'category_id'  => 'numeric'
        ]);

        $products = Product::all();
        $categories = Category::all();

        if ($request->filled('search')) {
            $products->where('name', 'like', "%$request->search%");
            $products->orWhere('price', 'like', "%$request->search%");
            $products->orWhere('description', 'like', "%$request->search%");
            $products->orWhere('status', 'like', "%$request->search%");
        }
        if ($request->filled('categories')) {
            $products->whereIn('category_id', $request->categories);
        }
        if ($request->filled('product_status')) {
            $products->whereIn('status->en', $request->product_status);
        }

        foreach ($products as $product) {
            $product->current_price = $product->price;
            $offers = $product->offers()->orderBy('started_at')->get();
            foreach ($offers as $offer) {
                if ($offer->started_at <= now() && $offer->ended_at >= now()) {
                    if ($offer->type == 'Percentage') {
                        $dis = (1 - (0.01 * $offer->discount));
                        $product->current_price = $product->current_price * $dis;
                    }
                    elseif ($offer->type == 'Constant') {
                        $product->current_price = $product->current_price * $offer->discount;
                    }
                }
            }
        $product->save();
        }

        $products = Product::latest();
        $products = $products->paginate(8);
        return view('admin.products.index', ['products' => $products,'categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',['categories' => $categories]);
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
            'name'          => 'required',
            'name.*'        => 'required|string|min:3|max:20',
            'price'         => 'required|numeric',
            'description'   => 'required',
            'description.*' => 'required|min:5|max:100',
            'status'        => 'required',
            'status.*'      => 'required',
            'category_id'   => 'required|numeric|exists:categories,id',
            'images'        => 'required|array',
            'images.*'      => 'required|file|image',
        ]);

        $validation['current_price'] = $validation['price'];
        $product = Product::create($validation);
            if ($request->hasFile('images')) {
                $fileAdders = $product->addMultipleMediaFromRequest(['images'])
                ->each(function ($fileAdder) {
                    $fileAdder->preservingOriginal()->toMediaCollection('images');
                });
            }

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->current_price = $product->price;
        $offers = $product->offers()->orderBy('started_at')->get();
            foreach ($offers as $offer) {
                if ($offer->started_at <= now() && $offer->ended_at >= now()) {
                    if ($offer->type == 'Percentage') {
                        $dis = (1 - (0.01 * $offer->discount));
                        $product->current_price = $product->current_price * $dis;
                    }
                    elseif ($offer->type == 'Constant') {
                        $product->current_price = $product->current_price * $offer->discount;
                    }
                }
            }
        $product->save();

        $mediaItems = $product->getMedia('images');
        return view('admin.products.show', ['product' => $product, 'mediaItems' => $mediaItems]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $mediaItems = $product->getMedia('images');
        $categories = Category::all();

        return view('admin.products.edit', ['product' => $product,'categories' => $categories, 'mediaItems' => $mediaItems]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validation = $request->validate([
            'name'           => 'required',
            'name.*'         => 'required|string|min:3|max:20',
            'price'          => 'required|numeric',
            'description'    => 'required',
            'description.*'  => 'required|min:10|max:100',
            'status'         => 'required',
            'status.*'       => 'required',
            'category_id'    => 'required|numeric|exists:categories,id',
            'images'         => 'required|array',
            'images.*'       => 'required|file|image',
        ]);

        $product->price       = $validation['price'];
        $product->category_id = $validation['category_id'];

        foreach ($validation['name'] as $lang => $name) {
            $product->setTranslation('name', $lang, $name);
        }
        foreach ($validation['description'] as $lang => $description) {
            $product->setTranslation('description', $lang, $description);
        }
        foreach ($validation['status'] as $lang => $status) {
            $product->setTranslation('status', $lang, $status);
        }

        if ($request->hasFile('images')) {
            $product->clearMediaCollection('images');
            $fileAdders = $product->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->toMediaCollection('images');
            });
        }

        $product->save();
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->clearMediaCollection('images');
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
