@extends('layouts.app', ['page' => __('Edit Category'), 'pageSlug' => 'categories'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Edit Category') }}</h5>
                </div>
                <form method="post" action="{{ route('admin.categories.update', $category) }}" autocomplete="off"
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
                                value="{{ $category->getTranslation('name', 'en') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "name['en']"])
                        </div>
                        <div class="form-group{{ $errors->has("name['ar']") ? ' has-danger' : '' }}">
                            <label>{{ __('Arabic Name') }}</label>
                            <input type="text" name="name[ar]" id="input-name_ar"
                                class="form-control{{ $errors->has("name['ar']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Arabic Name') }}"
                                value="{{ $category->getTranslation('name', 'ar') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "name['ar']"])
                        </div>

                        <label class=" col-form-label">{{ __('Images') }}</label>
                        <div class="custom-file {{ $errors->has('images') ? ' has-danger' : '' }}">
                            <input class="form-control file{{ $errors->has('images') ? ' is-invalid' : '' }}"
                                name="images[]" id="input-images" type="file" multiple="multiple"
                                placeholder="{{ __('Upload Images') }}" value="{{ $mediaItems }}" required="true"
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
