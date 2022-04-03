@extends('layouts.app', ['page' => __('newsletters'), 'pageSlug' => 'newsletters'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header mb-5">
                    <h3 class="card-title">Newsletter Info</h3>
                </div>
                <div class="card-body">
                    <div class="typography-line">
                        <span>English title</span>
                        <p class="text-primary">
                            {{ $newsletter->getTranslation('title', 'en') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Arabic title</span>
                        <p class="text-primary">
                            {{ $newsletter->getTranslation('title', 'ar') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>English content</span>
                        <p class="text-primary">
                            {{ $newsletter->getTranslation('content', 'en') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Arabic content</span>
                        <p class="text-primary">
                            {{ $newsletter->getTranslation('content', 'ar') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Created at</span>
                        <p class="text-primary">
                            {{ $newsletter->created_at }}</p>
                    </div>
                    <div class="row">
                        <div class="col-1 text-left">
                            <a href="{{ route('admin.mail', $newsletter->id) }}" class="btn btn-sm btn-primary"> Send
                            </a>
                        </div>
                        <div class="col-1.5 text-left">
                            <form action="{{ route('admin.newsletters.destroy', $newsletter) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-primary" data-original-title="" title="">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach ($mediaItems as $mediaItem)
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <img class="card-img" src="{{ $mediaItem->getUrl() }}" alt="newsletter image">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
