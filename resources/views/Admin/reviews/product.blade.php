@extends('layouts.app', ['page' => __('reviews'), 'pageSlug' => 'reviews'])

@section('content')
    @foreach ($reviews as $review)
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header mb-5">
                        <h3 class="card-title">
                            <p class="text-primary">
                                {{ $review->user->name }}
                            </p>
                        </h3>
                    </div>
                    <div class="card-body">
                        {{-- <div class="typography-line">
                            <span>User</span>
                            <p class="text-primary">
                                {{ $review->user->name }}
                            </p>
                        </div> --}}
                        <div class="typography-line">
                            <span>Rate</span>
                            <p class="text-primary">
                                {{ $review->rate }}</p>
                        </div>
                        <div class="typography-line">
                            <span>Content</span>
                            <p class="text-primary">
                                {{ $review->content }}</p>
                        </div>
                        <div class="typography-line">
                            <span>Created at</span>
                            <p class="text-primary">
                                {{ $review->created_at }}</p>
                        </div>
                        <div class="row">
                            <div class="col-1 text-left">
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="post">
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
    @endforeach
@endsection
