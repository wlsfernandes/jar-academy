@extends('layouts.master')
@section('title')
    AMID
@endsection
@section('css')
    <!-- DataTables -->
    <link href="{{ asset('/assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle')
    Students
    @endslot
    @slot('title')
    @endslot
    @endcomponent


    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary"><i class="dripicons-graduation"></i> Students</b></h5>
                </div>
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

                    <h4 class="card-title">Student: <b>{{$student->user->name ?? ''}}</b></h4>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Last Viewed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($student->certifications as $certification)
                                            <tr>
                                                <td><strong>{{ $certification->name }}</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                            @foreach ($certification->disciplines as $discipline)
                                                            <tr>
                                                                <td style="padding-left: 30px;">{{ $discipline->title }}</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>

                                                            @foreach ($discipline->resources as $resource)
                                                                            @php
                                                                                $resourcePivot = $resources->firstWhere('id', $resource->id);
                                                                            @endphp
                                                                            <tr>

                                                                                <td style="padding-left: 60px;"><strong>{{ $resource->title }}</strong></td>
                                                                                <td>
                                                                                    {{ $resource->resource_type ?? '' }}
                                                                                </td>
                                                                                <td>
                                                                                    @if ($resourcePivot && $resourcePivot->pivot && $resourcePivot->pivot->views > 0)
                                                                                        <span class="badge bg-success">Completed</span>
                                                                                    @else
                                                                                        <span class="badge bg-warning">Pending</span>
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ $resourcePivot && $resourcePivot->pivot ? $resourcePivot->pivot->views : 0 }}</td>
                                                                                <td>
                                                                                    @if ($resourcePivot && $resourcePivot->pivot && $resourcePivot->pivot->last_viewed_at)
                                                                                        {{ \Carbon\Carbon::parse($resourcePivot->pivot->last_viewed_at)->format('Y-m-d H:i:s') }}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                            @endforeach
                                            @endforeach
                            @endforeach

                        </tbody>
                    </table>


                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection
@section('script')
    <script src="{{ asset('/assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('/assets/libs/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/datatables.init.js') }}"></script>

@endsection
