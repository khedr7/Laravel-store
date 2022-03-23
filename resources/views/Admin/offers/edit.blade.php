@extends('layouts.app', ['page' => __('Edit Offer'), 'pageSlug' => 'offers'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create Offer') }}</h5>
                </div>
                <form method="post" action="{{ route('admin.offers.update', $offer) }}" autocomplete="off"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf
                        @method('PUT')

                        @include('alerts.success')

                        <div class="form-group{{ $errors->has("name['en']") ? ' has-danger' : '' }}">
                            <label>{{ __('English Name') }}</label>
                            <input type="text" name="name[en]" id="input-name_en"
                                class="form-control{{ $errors->has("name['en']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('English Name') }}"
                                value="{{ $offer->getTranslation('name', 'en') }}" required="true" aria-required="true">
                            @include('alerts.feedback', ['field' => "name['en']"])
                        </div>
                        <div class="form-group{{ $errors->has("name['ar']") ? ' has-danger' : '' }}">
                            <label>{{ __('Arabic Name') }}</label>
                            <input type="text" name="name[ar]" id="input-name_ar"
                                class="form-control{{ $errors->has("name['ar']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Arabic Name') }}"
                                value="{{ $offer->getTranslation('name', 'ar') }}" required="true" aria-required="true">
                            @include('alerts.feedback', ['field' => "name['ar']"])
                        </div>

                        <div class="form-group{{ $errors->has('discount') ? ' has-danger' : '' }}">
                            <label>{{ __('Discount') }}</label>
                            <input type="text" name="discount" id="input-discount"
                                class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Discount') }}" value="{{ $offer->discount }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => 'discount'])
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                            <label>{{ __('Type of discount') }}</label>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        type="radio" name="type" id="input-type" value="Constant"
                                        {{ 'Constant' == $offer->type ? 'checked' : '' }}>
                                    Constant
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        type="radio" name="type" id="input-type" value="Percentage"
                                        {{ 'Percentage' == $offer->type ? 'checked' : '' }}>
                                    Percentage
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            @include('alerts.feedback', ['field' => 'type'])
                        </div>

                        <div class="form-group{{ $errors->has('started_at') ? ' has-danger' : '' }}">
                            <label>{{ __('Start Date') }}</label>
                            <input type="date" name="started_at" id="input-started_at"
                                class="form-control{{ $errors->has('started_at') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Start Date') }}" value="{{ $offer->started_at }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => 'started_at'])
                        </div>
                        <div class="form-group{{ $errors->has('ended_at') ? ' has-danger' : '' }}">
                            <label>{{ __('End Date') }}</label>
                            <input type="date" name="ended_at" id="input-ended_at"
                                class="form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('End Date') }}" value="{{ $offer->ended_at }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => 'ended_at'])
                        </div>

                        <div class="form-group{{ $errors->has('categories') ? ' has-danger' : '' }}">
                            <label>{{ __('Categories') }} <small>(Fill if you want to apply offer on
                                    categories)</small></label>
                            <select multiple class="form-control{{ $errors->has('categories') ? ' is-invalid' : '' }}"
                                name="categories[]" id="input-categories" value="{{ $offer->category_id }} ">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->offers->contains($category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}/{{ $category->getTranslation('name', 'ar') }}
                                    </option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'categories'])
                        </div>

                        <div class="form-group{{ $errors->has('products') ? ' has-danger' : '' }}">
                            <label>{{ __('Products') }} <small>(Fill if you want to apply offer on
                                    products)</small></label>
                            <select multiple class="form-control{{ $errors->has('products') ? ' is-invalid' : '' }}"
                                name="products[]" id="input-products" value="{{ $offer->product_id }}">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ $product->offers->contains($product->id) ? 'selected' : '' }}>
                                        {{ $product->name }}/{{ $product->getTranslation('name', 'ar') }}
                                    </option>
                                @endforeach
                            </select>
                            <small>You can fill both categories and products</small>
                            @include('alerts.feedback', ['field' => 'products'])
                        </div>

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-fill btn-primary">{{ __('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
