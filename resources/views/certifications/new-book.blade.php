@extends('layouts.master')
@section('title')
    AMID
@endsection

@section('css')
    <!-- plugin css -->
    <link href="{{ asset('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/assets/libs/spectrum-colorpicker/spectrum-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/assets/libs/bootstrap-touchspin/bootstrap-touchspin.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/libs/datepicker/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/libs/flatpickr/flatpickr.min.css') }}">
@endsection


@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle')
    @lang('app.disciplines')
    @endslot
    @slot('title')
    @lang('app.disciplines')
    @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="d-flex justify-content-between" style="margin:15px">
                    <a href="{{ url('/certifications') }}" class="btn btn-secondary waves-effect">
                        <i class="bx bx-arrow-back"></i> @lang('app.go_back')
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="fas fa-check-circle"></i> <!-- Success icon -->
                            {{ session('success') }}
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

                    <form action="{{ route('storeBook') }}" method="post">
                        @csrf
                        <input type="hidden" name="certification_id" value="{{ $certification->id }}">
                        <div class="mb-3 row">
                            <label for="title" class="col-md-2 col-form-label">@lang('app.title'):</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="{{ old('title') }}" id="title" name="title"
                                    required>
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
                                    name="book_url" placeholder="https://example.com/book.pdf">
                            </div>
                        </div>




                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-secondary waves-effect">
                                <a href="{{ url('/certifications') }}" class="btn btn-secondary waves-effect">
                                    <i class="bx bx-arrow-back"></i> @lang('app.go_back')
                                </a>
                            </button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                    class="ui-plus"></i>@lang('app.save')</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection