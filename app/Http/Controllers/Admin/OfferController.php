<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
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
        return view('admin.offers.create');
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
            'name'       => 'required',
            'name.*'     => 'required|min:3',
            'discount'   =>  'required|numeric',
            'type'       =>  'required',
            'started_at' => 'required|before:ended_at',
            'ended_at'   => 'required|after:started_at',
        ]);

        $offer = Offer::create($validation);
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
        return view('admin.offers.edit',['offer'=>$offer]);
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
            'name'       => 'required',
            'name.*'     => 'required|min:3',
            'discount'   =>  'required|numeric',
            'type'       =>  'required',
            'started_at' => 'required|before:ended_at',
            'ended_at'   => 'required|after:started_at',
        ]);

        foreach ($validation['name'] as $lang => $name) {
            $offer->setTranslation('name', $lang, $name);
        }
        $offer->discount =  $validation['discount'];
        $offer->type =  $validation['type'];
        $offer->started_at = $validation['started_at'];
        $offer->ended_at = $validation['ended_at'];
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
        $offer->delete();
        return redirect()->route('admin.offers.index');
    }
}
