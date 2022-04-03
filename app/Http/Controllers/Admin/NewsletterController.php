<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NewsletterMail;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $newsletters = Newsletter::latest();

        if ($request->filled('search')) {
            $newsletters->where('title', 'like', "%$request->search%");
            $newsletters->orWhere('content', 'like', "%$request->search%");
        }

        $newsletters  = $newsletters->paginate(10);
        return view('admin.newsletters.index', ['newsletters' => $newsletters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.newsletters.create');
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
            'title'     => 'required',
            'title.*'   => 'required|min:3',
            'content'     => 'required',
            'content.*'   => 'required|string',
            'images'   => 'required|array',
            'images.*' => 'required|file|image',
        ]);
        $newsletter = Newsletter::create($validation);
        if ($request->hasFile('images')) {
            $fileAdders = $newsletter->addMultipleMediaFromRequest(['images'])
            ->each(function ($fileAdder) {
                $fileAdder->preservingOriginal()->toMediaCollection('images');
            });
        }
        $subscribers = User::all();
        $subscribers = $subscribers->where('subscribed',1);
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($subscriber->name, $newsletter));
        }
        return redirect()->route('admin.newsletters.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        $mediaItems = $newsletter->getMedia('images');
        return view('admin.newsletters.show', ['newsletter' => $newsletter, 'mediaItems' => $mediaItems]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->clearMediaCollection('images');
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index');
    }

    public function mail($newsletter_id)
    {
        $newsletter = Newsletter::findOrFail($newsletter_id);
        $subscribers = User::all();
        $subscribers = $subscribers->where('subscribed',1);
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($subscriber->name, $newsletter));
        }
        return redirect()->route('admin.newsletters.index');
    }
}

