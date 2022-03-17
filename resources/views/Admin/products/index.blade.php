@extends('layouts.app', ['page' => __('products'), 'pageSlug' => 'products'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Here you can manage products</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">Add
                                Product </a>
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
                                        Category
                                    </th>
                                    <th>
                                        Price
                                    </th>
                                    <th class="text-right">
                                        Status
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
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.products.show', $product) }}">{{ $product->name }}</a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.products.show', $product) }}">{{ $product->getTranslation('name', 'ar') }}</a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.categories.show', $product->category) }}">{{ $product->category->name }}</a>


                                        </td>
                                        <td>
                                            {{ $product->price }}
                                        </td>
                                        <td class="text-right">
                                            {{ $product->status }}
                                        </td>
                                        <td class="text-right">
                                            {{ $product->created_at }}
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon"
                                                    href="{{ route('admin.products.edit', $product) }}"
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
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
