<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::all();
        return response()->json([
            'reviews' => $reviews,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reviews = Review::all();
        if ($reviews->where('user_id', 'like', Auth::id())) {
            return response()->json([
                'message' => 'You already have a review',
            ], 400);
        }
        $validation = $request->validate([
            'rate'       => 'required|numeric',
            'content'    => 'required|string',
            'product_id' => 'required|numeric|exists:products,id',
        ]);
        $review = Review::create($validation);
        if ($review) {
            $review->user_id = Auth::id();
            $review->save();
            return response()->json([
                'message' => 'The review created successfully',
            ], 201);
        }
        return response()->json([
            'message' => 'Error',
        ], 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return response()->json([
            'review' => $review,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        if ( $review->user_id == Auth::id() ) {
            $validation = $request->validate([
                'rate'    => 'required|numeric',
                'content' => 'required|string',
            ]);

            $review->rate    =  $validation['rate'];
            $review->content =  $validation['content'];
            $review->save();
            return response()->json([
                'message' => 'The review edited successfully',
            ], 200);
        }
        return response()->json([
            'message' => 'This review is not yours',
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        if ($review->user_id == Auth::id()) {
            $review->delete();
            return response()->json([
                'message' => 'The review deleted successfully',
            ], 200);
        }
        return response()->json([
            'message' => 'This review is not yours',
        ], 401);
    }
}
