@extends('layouts.app', ['page' => __('categories'), 'pageSlug' => 'categories'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Here you can manage categories</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{ route('admin.categories.index') }}">
                                <div class="field">
                                    <label class="label tim-icons icon-zoom-split">{{ __(' Search') }}</label>
                                    <div class="control is-expanded">
                                        <input class="input" type="text" placeholder="Search ..." name="search"
                                            value="{{ request()->query('search', '') }}">
                                    </div>
                                </div>
                        </div>
                        <div class="col-md-2">
                            <div class="subtitle is-4">
                                Sort By :
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input type="radio" name="sort" id="input-sort" value="name_en"
                                            {{ 'name_en' == request()->query('sort') ? 'checked' : '' }}>
                                        English name
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input type="radio" name="sort" id="input-sort" value="name_ar"
                                            {{ 'name_ar' == request()->query('sort') ? 'checked' : '' }}>
                                        Arabic name
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input type="radio" name="sort" id="input-sort" value="creation_date"
                                            {{ 'creation_date' == request()->query('sort') ? 'checked' : '' }}>
                                        Creation Date
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="subtitle is-4">
                                Order By :
                            </div>
                            <div class="form-group">
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input type="radio" name="order" id="input-order" value="ascending"
                                            {{ 'ascending' == request()->query('order') ? 'checked' : '' }}>
                                        Ascending
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input type="radio" name="order" id="input-order" value="descending"
                                            {{ 'descending' == request()->query('order') ? 'checked' : '' }}>
                                        Descending
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="field col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <button type="reset" class="btn btn-sm btn-primary">Reset</button>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">Add
                                category </a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title"> Categories table</h4>
                </div>
                <div class="card-body">
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
                                                <a rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon"
                                                    href="{{ route('admin.categories.edit', $category) }}"
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
                            {{ $categories->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
