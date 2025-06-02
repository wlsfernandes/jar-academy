@extends('layouts.master')

@section('title')
    Resources
@endsection

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') AMID @endslot
    @slot('title') Resources @endslot
    @endcomponent

    <!-- Add Resource Form -->
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

                    <h4 class="card-title">Upload a Resource</h4>

                    <form method="POST" enctype="multipart/form-data"
                        action="{{ route('disciplines.addResource', $discipline->id) }}" style="display:inline">
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
                            <label for="resource_type" class="col-md-2 col-form-label">@lang('app.resource_type'):</label>
                            <div class="col-md-6">
                                <select class="form-select" id="resource_type" name="resource_type" required
                                    onchange="toggleFileUrlInput()">
                                    @foreach ($resource_types as $resource_type)
                                        <option value="{{ $resource_type }}" {{ old('resource_type', 'documento') === $resource_type ? 'selected' : '' }}>
                                            {{ ucfirst($resource_type) }}
                                        </option>
                                    @endforeach
                                </select>
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
                            <a href="{{ url('/course') }}" class="btn btn-secondary waves-effect waves-light">
                                <i class="bx bx-arrow-back"></i> Go Back
                            </a>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Create Resource</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Resource List -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary"><i class="uil uil-file-plus"></i> @lang('app.resources')</h5>
                </div>
                @if ($resources->isEmpty())
                    <div class="alert alert-warning" role="alert">@lang('app.there_no_resource')</div>
                @else
                    <div class="card-body">
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('app.resource')</th>
                                    <th>@lang('app.title')</th>
                                    <th>@lang('app.description')</th>
                                    <th>@lang('app.resource_type')</th>
                                    <th>@lang('app.media_type')</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($resources as $resource)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ $resource->url }}" target="_blank" class="me-2 text-decoration-none">
                                                <i class="uil uil-file-plus"></i>
                                            </a>
                                        </td>
                                        <td>{{ $resource->title ?? '' }}</td>
                                        <td>{{ $resource->description ?? '' }}</td>
                                        <td>{{ $resource->resource_type ?? '' }}</td>
                                        <td>{{ $resource->type ?? '' }}</td>
                                        <td class="text-center">
                                            <a href="{{ url('/resources/' . $resource->id . '/edit') }}" class="px-2 text-primary">
                                                <i class="uil uil-pen font-size-18"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="px-2 text-danger"
                                                onclick="event.preventDefault(); if(confirm('Confirm delete?')) { document.getElementById('delete-form-{{ $resource->id }}').submit(); }">
                                                <i class="uil uil-trash-alt font-size-18"></i>
                                            </a>
                                            <form id="delete-form-{{ $resource->id }}"
                                                action="{{ url('/resources/' . $resource->id) }}" method="POST"
                                                style="display: none;">
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
        </div>
    </div>

    <!-- Task List -->
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card border border-info">
                <div class="card-header bg-transparent border-info">
                    <h5 class="my-0 text-info">
                        <i class="uil uil-tasks"></i> @lang('app.tasks')
                    </h5>
                </div>

                @if ($tasks->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        @lang('app.no_tasks_found')
                    </div>
                @else
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('app.task')</th>
                                    <th>@lang('app.resource_title')</th>
                                    <th>@lang('app.resource_description')</th>
                                    <th>@lang('app.media_type')</th>
                                    <th class="text-center">@lang('app.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>Task #{{ $task->id }}</td>
                                        <td>{{ $task->resource->title ?? '-' }}</td>
                                        <td>{{ $task->resource->description ?? '-' }}</td>
                                        <td>{{ $task->resource->type ?? '-' }}</td>
                                        <td class="text-center">
                                            @if ($task->resource)
                                                <a href="{{ $task->resource->url }}" class="btn btn-sm btn-info" target="_blank">
                                                    <i class="uil uil-eye"></i> @lang('app.view')
                                                </a>
                                            @else
                                                <span class="text-muted">No resource</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
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

            toggleFileUrlInput();
            mediaTypeSelect.addEventListener("change", toggleFileUrlInput);
        });
    </script>
@endsection