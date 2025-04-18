@extends('layouts.master')

@section('title')
@lang('app.test')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') AMID @endslot
@slot('title') Test @endslot
@endcomponent



<!-- display tests -->
<div class="row">
    <div class="col-lg-12">
        <div class="card border border-primary">
            <div class="card-header bg-transparent border-primary">
                <h5 class="my-0 text-primary"><i class="uil uil-stopwatch font-size-24"></i> @lang('app.test')</b></h5>
                <p>@lang('app.test_desc')</p>
            </div>
            @if ($tests->isEmpty())
                <div class="alert alert-warning" role="alert">
                    @lang('app.there_no_test')
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
                                <th class="text-center align-middle">@lang('app.start_test')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tests as $test)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $test->title ?? ''}}</td>
                                    <td>{{ $test->description ?? ''}}</td>
                                    <td class="text-center align-middle"> <a
                                            href="{{ url('/test/' . $test->id . '/edit') }}" class="px-3 text-primary"><i
                                                class="uil uil-stopwatch font-size-24"></i></a>

                                        </a></td>

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
