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
                        <span>Rate</span>
                        @if ($product->rate)
                            <p class="text-primary">
                                {{ $product->rate }}</p>
                        @else
                            <p class="text-primary">
                                There is no rate yet</p>
                        @endif
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
                        @if (count($product->offers) !== 0)
                            @foreach ($product->offers as $offer)
                                <a href="{{ route('admin.offers.show', $offer) }}">({{ $offer->name }}) </a>
                            @endforeach
                        @endif
                        @if (count($product->offers) == 0)
                            <p class="text-primary">
                                There is no offers </p>
                        @endif
                    </div>
                    <div class="typography-line">
                        <span>Reviews</span>
                        <p class="text-primary">
                            <a href="{{ route('admin.productReviews', $product->id) }}">Reviews</a>
                        </p>
                    </div>
                    <div class="typography-line">
                        <span>Created at</span>
                        <p class="text-primary">
                            {{ $product->created_at }}</p>
                    </div>
                    <div class="row">
                        <div class="col-1 text-left">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-primary"> Edit
                            </a>
                        </div>
                        <div class="col-1.5 text-left">
                            <form action="{{ route('admin.products.destroy', $product) }}" method="post">
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
                        <img class="card-img" src="{{ $mediaItem->getUrl() }}" alt="product image">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
