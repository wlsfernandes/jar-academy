@extends('layouts.master')

@section('title')
    Task
@endsection

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') AMID @endslot
    @slot('title') Create Task @endslot
    @endcomponent

    <!-- add Resource -->
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
                    <h4 class="card-title">Create a Task
                    </h4>
                    <p class="card-title-desc"></p>

                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('disciplines.addTask', $discipline->id) }}" accept-charset="UTF-8"
                        style="display:inline">
                        @csrf

                        <div class="mb-3 row">
                            <label for="title" class="col-md-2 col-form-label">@lang('app.title'):</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="{{ old('title') }}" id="title" name="title"
                                    required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="description" class="col-md-2 col-form-label">@lang('app.small_description'):</label>
                            <div class="col-md-6">
                                <input class="form-control" type="text" value="{{ old('description') }}" id="description"
                                    name="description" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="media_type" class="col-md-2 col-form-label">@lang('app.media_type'):</label>
                            <div class="col-md-6">
                                <select class="form-select" id="media_type" name="type" required>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}" {{ old('type', 'pdf') === $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row" id="file-input-container">
                            <div class="col-md-10">
                                <input class="form-control" type="file" id="document" name="document">
                            </div>
                        </div>

                        <div class="mb-3 row" id="url-input-container" style="display: none;">
                            <div class="col-md-10">
                                <input class="form-control" type="url" id="resource_url" name="resource_url"
                                    placeholder="Enter resource URL">
                            </div>
                        </div>


                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-secondary waves-effect waves-light">
                                <a href="{{ route('certifications.index') }}" style="color:white">
                                    <i class="bx bx-arrow-back"></i> Go Back
                                </a>
                            </button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Create Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- end row -->

    <!-- display resources -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary"><i class="uil uil-file-plus"></i> Tasks</b></h5>
                </div>
                @if ($tasks->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        @lang('app.there_no_resource')
                    </div>
                @else
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('app.resource')</th>
                                    <th>@lang('app.title')</th>
                                    <th>@lang('app.description')</th>
                                    <th class="text-center align-middle">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td> <a href="{{ $task->url }}" target="_blank" class="me-2"
                                                style="font-size: 18px; text-decoration: none;">
                                                <i class="uil uil-file-plus"></i>
                                            </a></td>
                                        <td>{{ $task->title ?? ''}}</td>
                                        <td>{{ $task->description ?? ''}}</td>


                                        <td class="text-center align-middle">

                                            <a href="javascript:void(0);" class="px-3 text-danger"
                                                onclick="event.preventDefault(); if(confirm('Confirm delete?')) { document.getElementById('delete-form-{{ $task->id }}').submit(); }">
                                                <i class="uil uil-trash-alt font-size-18"></i>
                                            </a>

                                            <form id="delete-form-{{ $task->id }}" action="{{ url('/tasks/' . $task->id) }}"
                                                method="POST" style="display: none;">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>
                @endif
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mediaTypeSelect = document.getElementById("media_type");

            function toggleFileUrlInput() {
                const mediaType = mediaTypeSelect.value.toLowerCase();
                const fileInputContainer = document.getElementById("file-input-container");
                const urlInputContainer = document.getElementById("url-input-container");

                if (mediaType === "video" || mediaType === "audio") {
                    fileInputContainer.style.display = "none";
                    urlInputContainer.style.display = "block";
                } else {
                    fileInputContainer.style.display = "block";
                    urlInputContainer.style.display = "none";
                }
            }

            // Run on page load
            toggleFileUrlInput();

            // Attach event listener
            mediaTypeSelect.addEventListener("change", toggleFileUrlInput);
        });
    </script>
@endsection