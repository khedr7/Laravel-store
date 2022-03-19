@extends('layouts.app', ['page' => __('products'), 'pageSlug' => 'products'])


@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header mb-5">
                    <h3 class="card-title">Product Info</h3>
                </div>
                <div class="card-body">
                    <div class="typography-line">
                        <span>English name</span>
                        <p class="text-primary">
                            {{ $product->getTranslation('name', 'en') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Arabic name</span>
                        <p class="text-primary">
                            {{ $product->getTranslation('name', 'ar') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Category</span>
                        <p class="text-primary">
                            <a
                                href="{{ route('admin.categories.show', $product->category) }}">{{ $product->category->name }}</a>
                        </p>
                    </div>
                    <div class="typography-line">
                        <span>Price</span>
                        <p class="text-primary">
                            {{ $product->price }}</p>
                    </div>
                    <div class="typography-line">
                        <span>current_price</span>
                        <p class="text-primary">
                            {{ $product->current_price }}</p>
                    </div>
                    <div class="typography-line">
                        <span>English Status</span>
                        <p class="text-primary">
                            {{ $product->getTranslation('status', 'en') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Arabic Status</span>
                        <p class="text-primary">
                            {{ $product->getTranslation('status', 'ar') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>English description</span>
                        <p class="text-primary">
                            {{ $product->getTranslation('description', 'en') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Arabic description</span>
                        <p class="text-primary">
                            {{ $product->getTranslation('description', 'ar') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Offers</span>
                        @foreach ($product->offers as $offer)
                            <a href="{{ route('admin.offers.show', $offer) }}">({{ $offer->name }}) </a>
                        @endforeach
                    </div>
                    <div class="typography-line">
                        <span>Created at</span>
                        <p class="text-primary">
                            {{ $product->created_at }}</p>
                    </div>
                    <div class="text-left">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary"> Edit
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
                        <img class="card-img" src="{{ $mediaItem->getUrl() }}" alt="product image">
                    </div>
                </div>
                {{-- <div class="card bg-dark text-white">
                    <img class="card-img" src="{{ $mediaItem->getUrl() }}" alt="Card image">
                </div> --}}
            </div>
        @endforeach
    </div>
@endsection
