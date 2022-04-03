@extends('layouts.app', ['page' => __('New newsletter'), 'pageSlug' => 'newsletters'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create newsletter') }}</h5>
                </div>
                <form method="post" action="{{ route('admin.newsletters.store') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf

                        @include('alerts.success')

                        <div class="form-group{{ $errors->has("title['en']") ? ' has-danger' : '' }}">
                            <label>{{ __('English title') }}</label>
                            <input type="text" name="title[en]" id="input-title_en"
                                class="form-control{{ $errors->has("title['en']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('English title') }}" value="{{ old("title['en']") }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "title['en']"])
                        </div>

                        <div class="form-group{{ $errors->has("title['ar']") ? ' has-danger' : '' }}">
                            <label>{{ __('Arabic title') }}</label>
                            <input type="text" name="title[ar]" id="input-title_ar"
                                class="form-control{{ $errors->has("title['ar']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Arabic title') }}" value="{{ old("title['ar']") }}"
                                required="true" aria-required="true">
                            @include('alerts.feedback', ['field' => "title['ar']"])
                        </div>

                        <div class="form-group{{ $errors->has("content['en']") ? ' has-danger' : '' }}">
                            <label>{{ __('English content') }}</label>
                            <textarea type="text" name="content[en]" id="input-content_en"
                                class="form-control{{ $errors->has("content['en']") ? ' is-invalid' : '' }}"
                                value="{{ old("content['en']") }}" required="true" aria-required="true">
                            </textarea>
                            @include('alerts.feedback', ['field' => "content['en']"])
                        </div>

                        <div class="form-group{{ $errors->has("content['ar']") ? ' has-danger' : '' }}">
                            <label>{{ __('Arabic content') }}</label>
                            <textarea type="text" name="content[ar]" id="input-content_ar"
                                class="form-control{{ $errors->has("content['ar']") ? ' is-invalid' : '' }}"
                                value="{{ old("content['ar']") }}" required="true" aria-required="true">
                            </textarea>
                            @include('alerts.feedback', ['field' => "content['ar']"])
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
