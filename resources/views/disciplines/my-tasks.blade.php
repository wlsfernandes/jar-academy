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
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $task->title ?? '' }}</td>
                                        <td>{{ $task->description ?? '' }}</td>
                                        <td>{{ $task->type ?? '' }}</td>
                                        <td class="text-center align-middle">
                                            @if ($task && $task->url)
                                                <a href="{{ $task->url }}" target="_blank" class="px-3 text-danger"
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
                                        <td> @if($task->studentTasks->isNotEmpty())
                                            <span class="badge bg-primary">✅ Concluded</span>
                                        @else
                                                <span class="badge bg-danger">Not Concluded</span>
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