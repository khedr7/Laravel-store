@extends('layouts.app', ['page' => __('categories'), 'pageSlug' => 'categories'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header mb-5">
                    <h3 class="card-title">Category Info</h3>
                </div>
                <div class="card-body">
                    <div class="typography-line">
                        <span>English name</span>
                        <p class="text-primary">
                            {{ $category->getTranslation('name', 'en') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Arabic name</span>
                        <p class="text-primary">
                            {{ $category->getTranslation('name', 'ar') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Created at</span>
                        <p class="text-primary">
                            {{ $category->created_at }}</p>
                    </div>
                    <div class="text-left">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-primary"> Edit
                        </a>
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
                        <img class="card-img" src="{{ $mediaItem->getUrl() }}" alt="Category image">
                    </div>
                </div>
                {{-- <div class="card bg-dark text-white">
                    <img class="card-img" src="{{ $mediaItem->getUrl() }}" alt="Card image">
                </div> --}}
            </div>
        @endforeach
    </div>
@endsection
