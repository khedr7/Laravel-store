@extends('layouts.app', ['page' => __('New Offer'), 'pageSlug' => 'offers'])

@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{ __('Create Offer') }}</h5>
                </div>
                <form method="post" action="{{ route('admin.offers.store') }}" autocomplete="off"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        @csrf

                        @include('alerts.success')

                        <div class="form-group{{ $errors->has("name['en']") ? ' has-danger' : '' }}">
                            <label>{{ __('English Name') }}</label>
                            <input type="text" name="name[en]" id="input-name_en"
                                class="form-control{{ $errors->has("name['en']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('English Name') }}" value="{{ old("name['en']") }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "name['en']"])
                        </div>
                        <div class="form-group{{ $errors->has("name['ar']") ? ' has-danger' : '' }}">
                            <label>{{ __('Arabic Name') }}</label>
                            <input type="text" name="name[ar]" id="input-name_ar"
                                class="form-control{{ $errors->has("name['ar']") ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Arabic Name') }}" value="{{ old("name['ar']") }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => "name['ar']"])
                        </div>

                        <div class="form-group{{ $errors->has('discount') ? ' has-danger' : '' }}">
                            <label>{{ __('Discount') }}</label>
                            <input type="text" name="discount" id="input-discount"
                                class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('Discount') }}" value="{{ old('discount') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => 'discount'])
                        </div>

                        <div class="form-group{{ $errors->has('type') ? ' has-danger' : '' }}">
                            <label>{{ __('Type of discount') }}</label>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        type="radio" name="type" id="input-type" value="Constant"
                                        {{ 'Constant' == request()->query('type') ? 'checked' : '' }}>
                                    Constant
                                    <span class="form-check-sign"></span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input{{ $errors->has('type') ? ' is-invalid' : '' }}"
                                        type="radio" name="type" id="input-type" value="Percentage"
                                        {{ 'Percentage' == request()->query('type') ? 'checked' : '' }}>
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
                                placeholder="{{ __('Start Date') }}" value="{{ old('started_at') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => 'started_at'])
                        </div>
                        <div class="form-group{{ $errors->has('ended_at') ? ' has-danger' : '' }}">
                            <label>{{ __('End Date') }}</label>
                            <input type="date" name="ended_at" id="input-ended_at"
                                class="form-control{{ $errors->has('ended_at') ? ' is-invalid' : '' }}"
                                placeholder="{{ __('End Date') }}" value="{{ old('ended_at') }}" required="true"
                                aria-required="true">
                            @include('alerts.feedback', ['field' => 'ended_at'])
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
