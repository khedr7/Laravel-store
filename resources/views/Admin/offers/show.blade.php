@extends('layouts.app', ['page' => __('offers'), 'pageSlug' => 'offers'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header mb-5">
                    <h3 class="card-title">Offer Info</h3>
                </div>
                <div class="card-body">
                    <div class="typography-line">
                        <span>English name</span>
                        <p class="text-primary">
                            {{ $offer->getTranslation('name', 'en') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Arabic name</span>
                        <p class="text-primary">
                            {{ $offer->getTranslation('name', 'ar') }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Discount</span>
                        <p class="text-primary">
                            {{ $offer->discount }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Type of discount</span>
                        <p class="text-primary">
                            {{ $offer->type }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Start Date</span>
                        <p class="text-primary">
                            {{ $offer->started_at }}</p>
                    </div>
                    <div class="typography-line">
                        <span>End Date</span>
                        <p class="text-primary">
                            {{ $offer->ended_at }}</p>
                    </div>
                    <div class="typography-line">
                        <span>Created at</span>
                        <p class="text-primary">
                            {{ $offer->created_at }}</p>
                    </div>
                    <div class="text-left">
                        <a href="{{ route('admin.offers.edit', $offer) }}" class="btn btn-sm btn-primary"> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
