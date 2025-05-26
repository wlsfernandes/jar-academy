@extends('layouts.master')

@section('title')
    Task
@endsection

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') AMID @endslot
    @slot('title') Resources @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary">
                        <i class="uil uil-file-plus"></i> @lang('app.tasks')
                    </h5>
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
                                    <th>@lang('app.title')</th>
                                    <th>@lang('app.description')</th>
                                    <th>@lang('app.media_type')</th>
                                    <th class="text-center align-middle">@lang('app.download')</th>
                                    <th class="text-center align-middle">@lang('app.upload_task')</th>
                                    <th class="text-center align-middle">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $task)
                                    @php
                                        $resource = $task->resource;
                                        $answered = $task->studentTasks->isNotEmpty();
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $resource->title ?? '' }}</td>
                                        <td>{{ $resource->description ?? '' }}</td>
                                        <td>{{ $resource->type ?? '' }}</td>
                                        <td class="text-center align-middle">
                                            @if ($resource && $resource->url)
                                                <a href="{{ $resource->url }}" target="_blank" class="px-3 text-danger"
                                                    style="font-size: 22px;">
                                                    <i class="uil uil-file-plus"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center align-middle">
                                            <a href="{{ url('/task/' . $task->id . '/edit') }}" class="px-3 text-primary">
                                                <i class="uil uil-upload font-size-18"></i>
                                            </a>
                                        </td>
                                        <td class="text-center align-middle">
                                            @if ($answered)
                                                <span class="badge bg-success">Answered</span>
                                            @else
                                                <span class="badge bg-secondary">Not answered</span>
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