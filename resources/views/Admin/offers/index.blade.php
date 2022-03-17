@extends('layouts.app', ['page' => __('offers'), 'pageSlug' => 'offers'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Here you can manage Offers</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('admin.offers.create') }}" class="btn btn-sm btn-primary">Add
                                Offer </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table tablesorter " id="">
                            <thead class=" text-primary">
                                <tr>
                                    {{-- <th class="text-center">
                                        #
                                    </th> --}}
                                    <th>
                                        English name
                                    </th>
                                    <th>
                                        Arabic name
                                    </th>
                                    <th>
                                        Type
                                    </th>
                                    <th>
                                        discount
                                    </th>
                                    <th class="text-right">
                                        Start date
                                    </th>
                                    <th class="text-right">
                                        End date
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
                                @foreach ($offers as $offer)
                                    <tr>
                                        <td>
                                            <a href="{{ route('admin.offers.show', $offer) }}">{{ $offer->name }}</a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.offers.show', $offer) }}">{{ $offer->getTranslation('name', 'ar') }}</a>
                                        </td>
                                        <td>
                                            {{ $offer->type }}
                                        </td>
                                        <td>
                                            {{ $offer->discount }}
                                        </td>
                                        <td>
                                            {{ $offer->stated_at }}
                                        </td>
                                        <td>
                                            {{ $offer->ended_at }}
                                        </td>
                                        <td>
                                            {{ $offer->created_at }}
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('admin.offers.destroy', $offer) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon"
                                                    href="{{ route('admin.offers.edit', $offer) }}"
                                                    data-original-title="" title="">
                                                    <i class="tim-icons icon-settings"></i>
                                                    <div class="ripple-container"></div>
                                                </a>
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
                            {{ $offers->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
