@extends('layouts.master')

@section('title')
    AMID
@endsection

@section('css')
    <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') @lang('app.disciplines') @endslot
    @slot('title') @lang('app.disciplines') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-between m-3">
                    <a href="{{ url('/certifications') }}" class="btn btn-secondary waves-effect">
                        <i class="bx bx-arrow-back"></i> @lang('app.go_back')
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle"></i> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><i class="bx bx-error"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('storeBook') }}" method="POST">
                        @csrf
                        <input type="hidden" name="certification_id" value="{{ $certification->id }}">

                        <div class="mb-3 row">
                            <label for="title" class="col-md-2 col-form-label">@lang('app.title'):</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="{{ old('title') }}" id="title" name="title">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="author" class="col-md-2 col-form-label">@lang('app.author'):</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="{{ old('author') }}" id="author"
                                    name="author">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="book_url" class="col-md-2 col-form-label">@lang('app.book_url'):</label>
                            <div class="col-md-6">
                                <input class="form-control" type="url" value="{{ old('book_url') }}" id="book_url"
                                    name="book_url" required placeholder="https://example.com/book.pdf">
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3">
                            <a href="{{ url('/certifications') }}" class="btn btn-secondary waves-effect">
                                <i class="bx bx-arrow-back"></i> @lang('app.go_back')
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                <i class="uil uil-plus"></i> @lang('app.save')
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- BOOKS TABLE --}}
    @if ($certification->books->count())
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>@lang('app.books') @lang('app.for') "{{ $certification->name }}"</h4>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>@lang('app.title')</th>
                                    <th>@lang('app.author')</th>
                                    <th>@lang('app.book_url')</th>
                                    <th class="text-center">@lang('app.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($certification->books as $book)
                                    <tr>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td><a href="{{ $book->book_url }}" target="_blank">View</a></td>
                                        <td class="text-center">
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this book?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i> @lang('app.delete')
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection