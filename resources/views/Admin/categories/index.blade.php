@extends('layouts.app', ['page' => __('categories'), 'pageSlug' => 'categories'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Here you can manage categories</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-right">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">Add
                                category </a>
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
                                    <th class="text-right">
                                        Creation date
                                    </th>
                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.categories.show', $category) }}">{{ $category->getTranslation('name', 'ar') }}</a>
                                        </td>
                                        <td>
                                            {{ $category->created_at }}
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                    href="{{ route('admin.categories.edit', $category) }}"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <button type="submit" rel="tooltip" class="btn btn-danger btn-link"
                                                    data-original-title="" title="">
                                                    <i class="material-icons">delete</i>
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
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
