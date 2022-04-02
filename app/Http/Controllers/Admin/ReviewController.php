<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reviews = Review::latest();
        if ($request->filled('search')) {
            $reviews->where('content', 'like', "%$request->search%");
            $reviews->where('rate', 'like', "%$request->search%");
        }
        if ($request->filled('rate')) {
            $reviews->where('rate', 'like', "$request->rate%");
        }
        $reviews = $reviews->paginate(10);
        return view('admin.reviews.index',['reviews'=> $reviews]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return view('admin.reviews.show',['review'=>$review]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index');
    }

    public function productReviews($product_id)
    {
        $product = Product::findOrFail($product_id);
        $reviews = $product->reviews;
        return view('admin.reviews.product',['reviews'=>$reviews]);
    }
}
