@extends('layouts.app', ['page' => __('Edit Product'), 'pageSlug' => 'products'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Product') }}</h5>
                </div>
                <form method="post" action="{{ route('admin.products.update', $product) }}" autocomplete="off"
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
                                value="{{ $product->getTranslation('name', 'en') }}" required="true" aria-required="true">
                            @include('alerts.feedback', ['field' => "name['en']"])
                        </div>

                        <div class="form-group{{ $errors->has("name['ar']") ? ' has-danger' : '' }}">
                            <label>{{ __('Arabic Name') }}</label>
                            <input type="text" name="name[ar]" id="input-name_ar"
                                class="form-control{{ $errors->has("name['ar']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Arabic Name') }}"
                                value="{{ $product->getTranslation('name', 'ar') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "name['ar']"])
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-danger' : '' }}">
                            <label>{{ __('Price') }}</label>
                            <input type="number" name="price" id="input-price"
                                class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Price') }}" value="{{ $product->price }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => 'price'])
                        </div>

                        <div class="form-group{{ $errors->has('category_id') ? ' has-danger' : '' }}">
                            <label>{{ __('Category') }}</label>
                            <select class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                                name="category_id" id="input-category_id" required="true" aria-required="true"
                                value="{{ $product->category_id }}">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category->id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}/{{ $category->getTranslation('name', 'ar') }}
                                    </option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'category_id'])
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has("status['en']") ? ' has-danger' : '' }}">
                                    <label>{{ __('English Status') }}</label>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input
                                                class="form-check-input{{ $errors->has("status['en']") ? ' is-invalid' : '' }}"
                                                type="radio" name="status[en]" id="input-status_en" value="Available"
                                                {{ 'Available' == $product->getTranslation('status', 'en') ? 'checked' : '' }}>
                                            Available
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input
                                                class="form-check-input{{ $errors->has("status['en']") ? ' is-invalid' : '' }}"
                                                type="radio" name="status[en]" id="input-status_en" value="Unavailable"
                                                {{ 'Unavailable' == $product->getTranslation('status', 'en') ? 'checked' : '' }}>
                                            Unavailable
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has("status['ar']") ? ' has-danger' : '' }}">
                                    <label>{{ __('Arabic Status') }}</label>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input
                                                class="form-check-input{{ $errors->has("status['ar']") ? ' is-invalid' : '' }}"
                                                type="radio" name="status[ar]" id="input-status_ar" value="متوفر"
                                                {{ 'متوفر' == $product->getTranslation('status', 'ar') ? 'checked' : '' }}>
                                            متوفر
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input
                                                class="form-check-input{{ $errors->has("status['ar']") ? ' is-invalid' : '' }}"
                                                type="radio" name="status[ar]" id="input-status_ar" value="غير متوفر"
                                                {{ 'غير متوفر' == $product->getTranslation('status', 'ar') ? 'checked' : '' }}>
                                            غير متوفر
                                            <span class="form-check-sign"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has("description['en']") ? ' has-danger' : '' }}">
                            <label>{{ __('English Description') }}</label>
                            <input type="text" name="description[en]" id="input-description_en"
                                class="form-control{{ $errors->has("description['en']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('English Description') }}"
                                value="{{ $product->getTranslation('description', 'en') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "description['en']"])
                        </div>

                        <div class="form-group{{ $errors->has("description['ar']") ? ' has-danger' : '' }}">
                            <label>{{ __('Arabic Description') }}</label>
                            <input type="text" name="Description[ar]" id="input-description_ar"
                                class="form-control{{ $errors->has("description['ar']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Arabic description') }}"
                                value="{{ $product->getTranslation('description', 'ar') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "description['ar']"])
                        </div>

                        <label class=" col-form-label">{{ __('Images') }}</label>
                        <div class="custom-file {{ $errors->has('images') ? ' has-danger' : '' }}">
                            <input class="form-control file{{ $errors->has('images') ? ' is-invalid' : '' }}"
                                name="images[]" id="input-images" type="file" multiple="multiple"
                                placeholder="{{ __('Upload Images') }}" value="{{ old('images[]') }}" required="true"
                                aria-required="true" />
                            @include('alerts.feedback', ['field' => 'images'])
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
