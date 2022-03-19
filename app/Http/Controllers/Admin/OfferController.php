<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = Offer::latest();
        $offers = $offers->paginate(10);

        return view('admin.offers.index',['offers'=> $offers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.offers.create',['categories' => $categories, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name'          => 'required',
            'name.*'        => 'required|min:3',
            'discount'      =>  'required|numeric',
            'type'          =>  'required',
            'started_at'    => 'required|date|before:ended_at',
            'ended_at'      => 'required|date|after:started_at',
            'products'      => 'array',
            'products.*'    => 'numeric|exists:products,id',
            'categories'    => 'array',
            'categories.*'  => 'numeric|exists:categories,id',
        ]);

        $offer = Offer::create($validation);
        $offer->products()->attach($request->products);
        $offer->categories()->attach($request->categories);
        $categories = $offer->categories;
        if ($categories) {
            foreach ($categories as $category) {
                foreach ($category->products as $product) {
                    if ($product->offers->contains($offer->id)) {
                        continue;
                    }
                    else {
                        $offer->products()->attach($product->id);
                    }
                }
            }
        }
            
        return redirect()->route('admin.offers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function show(Offer $offer)
    {
        return view('admin.offers.show',['offer'=>$offer]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function edit(Offer $offer)
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.offers.edit',['offer'=>$offer, 'categories' => $categories, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Offer $offer)
    {
        $validation = $request->validate([
            'name'         => 'required',
            'name.*'       => 'required|min:3',
            'discount'     =>  'required|numeric',
            'type'         =>  'required',
            'started_at'   => 'required|date|before:ended_at',
            'ended_at'     => 'required|date|after:started_at',
            'products'     => 'array',
            'products.*'   => 'numeric|exists:products,id',
            'categories'   => 'array',
            'categories.*' => 'numeric|exists:categories,id',
        ]);

        foreach ($validation['name'] as $lang => $name) {
            $offer->setTranslation('name', $lang, $name);
        }
        $offer->discount =  $validation['discount'];
        $offer->type =  $validation['type'];
        $offer->started_at = $validation['started_at'];
        $offer->ended_at = $validation['ended_at'];
        if ($request->filled('products')) {
            $offer->products()->detach();
            $offer->products()->attach($request->products);
        }
        if ($request->filled('categories')) {
            $offer->categories()->detach();
            $offer->categories()->attach($request->categories);
        }
        $categories = $offer->categories;
        if ($categories) {
            foreach ($categories as $category) {
                foreach ($category->products as $product) {
                    if ($product->offers->contains($offer->id)) {
                        continue;
                    }
                    else {
                        $offer->products()->attach($product->id);
                    }
                }
            }
        }
        $offer->save();

        return redirect()->route('admin.offers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offer  $offer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Offer $offer)
    {
        $offer->products()->detach();
        $offer->categories()->detach();
        $offer->delete();
        return redirect()->route('admin.offers.index');
    }
}
