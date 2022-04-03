@extends('layouts.app', ['page' => __('newsletters'), 'pageSlug' => 'newsletters'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Here you can manage newsletters</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <form action="{{ route('admin.newsletters.index') }}">
                                <div class="field">
                                    <label class="label tim-icons icon-zoom-split">{{ __(' Search') }}</label>
                                    <div class="control is-expanded">
                                        <input class="input" type="text" placeholder="Search ..." name="search"
                                            value="{{ request()->query('search', '') }}">
                                    </div>
                                </div>
                        </div>
                        <div class="field col-md-12">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                            <button type="reset" class="btn btn-sm btn-primary">Reset</button>
                            <a href="{{ route('admin.newsletters.create') }}" class="btn btn-sm btn-primary">Add
                                newsletter </a>
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
                    <h4 class="card-title">Newsletters table</h4>
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
                                        English title
                                    </th>
                                    <th>
                                        Arabic title
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
                                @foreach ($newsletters as $newsletter)
                                    <tr>
                                        <td>
                                            <a
                                                href="{{ route('admin.newsletters.show', $newsletter) }}">{{ $newsletter->title }}</a>
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('admin.newsletters.show', $newsletter) }}">{{ $newsletter->getTranslation('title', 'ar') }}</a>
                                        </td>
                                        <td>
                                            {{ $newsletter->created_at }}
                                        </td>
                                        <td class="td-actions text-right">
                                            <form action="{{ route('admin.newsletters.destroy', $newsletter) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <a rel="tooltip" class="btn btn-success btn-sm btn-round btn-icon"
                                                    href="{{ route('admin.mail', $newsletter->id) }}"
                                                    data-original-title="" title="">
                                                    <i class="tim-icons icon-send"></i>
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
                            {{ $newsletters->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
