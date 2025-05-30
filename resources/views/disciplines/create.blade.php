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
                <a href="{{ url('/disciplines') }}" class="btn btn-secondary waves-effect">
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

                <form action="{{ url('/disciplines') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="certification" class="col-md-2 col-form-label">@lang('app.certification'):</label>
                        <div class="col-md-6">
                            <select class="form-control" id="certification" name="certification" required>
                                <option value="">@lang('app.select')</option>
                                @foreach($certifications as $certification)
                                    <option value="{{ $certification->id }}" {{ old('certification') == $certification->id ? 'selected' : '' }}>
                                        {{ $certification->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="module" class="col-md-2 col-form-label">@lang('app.modules'):</label>
                        <div class="col-md-6">
                            <select class="form-control" id="module" name="module" required>
                                <option value="">@lang('app.select')</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}" {{ old('module') == $module->id ? 'selected' : '' }}>
                                        {{ $module->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="title" class="col-md-2 col-form-label">@lang('app.title'):</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" value="{{ old('title') }}" id="title" name="title"
                                required>
                        </div>
                    </div>
                        <div class="mb-3 row">
                        <label for="amount" class="col-md-2 col-form-label">@lang('app.price'):</label>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input class="form-control" type="number" step="0.01" min="0"
                                    value="{{ old('amount') }}" id="amount" name="amount" placeholder="Enter amount"
                                    required>
                            </div>
                        </div>

                    </div> 

                    <div class="mb-3 row">
                        <label for="small_description"
                            class="col-md-2 col-form-label">@lang('app.small_description'):</label>
                        <div class="col-md-6">
                            <input class="form-control" type="text" value="{{ old('small_description') }}"
                                id="small_description" name="small_description" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="description" class="col-md-2 col-form-label">@lang('app.description'):</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="small_description" name="description" rows="4"
                                required>{{ old('description', $course->description ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                            <label for="amount" class="col-md-2 col-form-label">@lang('app.price'):</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input class="form-control" type="number" step="0.01" min="0"
                                        value="{{ old('amount') }}" id="amount" name="amount" placeholder="Enter amount">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="order" class="col-md-2 col-form-label">@lang('app.order'):</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                                                     <input class="form-control" type="number" step="1" min="0"
                                        value="{{ old('order') }}" id="order" name="order" placeholder="Enter order of the discipline">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Gratuíto?:</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="isFree" name="isFree" value="1" {{ old('isFree') ? 'checked' : '' }}>
                                </div>
                               
                            </div>
                            <small>Se o curso é gratuíto o valor cadastrado deve ser igual a 0</small>
                        </div>


                    <div class="d-flex flex-wrap gap-3">
                        <button type="submit" class="btn btn-secondary waves-effect">
                            <a href="{{ url('/disciplines') }}" class="btn btn-secondary waves-effect">
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
