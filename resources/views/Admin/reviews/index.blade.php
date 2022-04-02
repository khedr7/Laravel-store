@extends('layouts.app', ['page' => __('reviews'), 'pageSlug' => 'reviews'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Here you can manage Reviews</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{ route('admin.reviews.index') }}">
                                <div class="field">
                                    <label class="label tim-icons icon-zoom-split">{{ __(' Search') }}</label>
                                    <div class="control is-expanded">
                                        <input class="input" type="text" placeholder="Search ..." name="search"
                                            value="{{ request()->query('search', '') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Reviews table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    <th>
                                        Product
                                    </th>
                                    <th>
                                        User
                                    </th>
                                    <th class="text-right">
                                        Rate
                                    </th>
                                    <th class="text-right">
                                        Creation date
                                    </th>
                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.products.show', $review->product) }}">{{ $review->product->name }}</a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.users.show', $review->user) }}">{{ $review->user->name }}</a>
                                        </td>
                                        <td class="text-right">
                                            {{ $review->rate }}
                                        </td>
                                        <td class="text-right">
                                            {{ $review->created_at }}
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('admin.reviews.destroy', $review) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" rel="tooltip"
                                                    class="btn btn-danger btn-sm btn-round btn-icon" data-original-title=""
                                                    title="">
                                                    <i class="tim-icons icon-simple-remove"></i>
                                                    <div class="ripple-container"></div>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-3 text-center m-auto">
                            {{ $reviews->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
