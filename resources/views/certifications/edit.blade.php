@extends('layouts.master')
@section('title')
    Certifications
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
    AMID
    @endslot
    @slot('title')
    Certifications
    @endslot
    @endcomponent


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
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('certifications.update', $certification->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="name" class="col-md-2 col-form-label">Name:</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="{{ $certification->name ?? ''}}" id="name"
                                    name="name" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="amount" class="col-md-2 col-form-label">@lang('app.price'):</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input class="form-control" type="number" step="0.01" min="0"
                                        value="{{ old('amount', $certification->amount ?? 0.00) }}" id="amount"
                                        name="amount" placeholder="Enter amount" required>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3 row">
                            <label for="order" class="col-md-2 col-form-label">@lang('app.order'):</label>
                            <div class="col-md-6">
                                <div class="input-group">
                                                                     <input class="form-control" type="number" step="1" min="0"
                                        value="{{ old('order', $certification->order) }}" id="order" name="order" placeholder="Enter order of the discipline">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
    <label for="parent_id" class="col-md-2 col-form-label">Prerequisite:</label>
    <div class="col-md-6">
        <select name="parent_id" id="parent_id" class="form-control select2">
            <option value="">-- None --</option>
            @foreach($certifications as $cert)
                @if ($cert->id !== $certification->id) {{-- Prevent self-selection --}}
                    <option value="{{ $cert->id }}"
                        {{ (old('parent_id', $certification->parent_id) == $cert->id) ? 'selected' : '' }}>
                        #{{ $cert->order }} - {{ $cert->name }}
                    </option>
                @endif
            @endforeach
        </select>
    </div>
    <small class="col-md-10 offset-md-2 text-muted">Select another certification this one depends on (optional).</small>
</div>

                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Gratuíto?:</label>
                            <div class="col-md-6 d-flex align-items-center">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="isFree" name="isFree" value="1" {{ old('isFree', $certification->isFree) ? 'checked' : '' }}>
                                </div>
                            </div>
                            <small>Se o curso é gratuíto o valor cadastrado deve ser igual a 0</small>
                        </div>
                        <div class="d-flex flex-wrap gap-3">
                            <button type="submit" class="btn btn-secondary waves-effect">
                                <a href="{{ url('/certifications') }}" class="btn btn-secondary waves-effect">
                                    <i class="bx bx-arrow-back"></i> Go Back
                                </a>
                            </button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light"><i
                                    class="ui-plus"></i>Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection
