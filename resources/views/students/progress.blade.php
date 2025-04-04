@extends('layouts.master')

@section('title')
    AMID
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Students @endslot
        @slot('title') @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary">
                        <i class="dripicons-graduation"></i> Student Progress
                    </h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><i class="bx bx-error"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h4 class="card-title">Student: <strong>{{ $student->user->name ?? '' }}</strong></h4>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th>Certification / Direct</th>
                                    <th>Discipline</th>
                                    <th>Resource</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Views</th>
                                    <th>Last Viewed</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- From certifications --}}
                                @foreach ($student->certifications as $cert)
                                    @foreach ($cert->disciplines as $discipline)
                                        @foreach ($discipline->resources as $resource)
                                            @php
                                                $pivot = $resources->firstWhere('id', $resource->id)?->pivot;
                                            @endphp
                                            <tr>
                                                <td>{{ $cert->name }}</td>
                                                <td>{{ $discipline->title }}</td>
                                                <td><strong>{{ $resource->title }}</strong></td>
                                                <td>{{ ucfirst($resource->resource_type ?? '') }}</td>
                                                <td>
                                                    @if ($pivot?->views > 0)
                                                        <span class="badge bg-success">Completed</span>
                                                    @else
                                                        <span class="badge bg-warning">Pending</span>
                                                    @endif
                                                </td>
                                                <td>{{ $pivot?->views ?? 0 }}</td>
                                                <td>{{ $pivot?->last_viewed_at ? \Carbon\Carbon::parse($pivot->last_viewed_at)->format('Y-m-d H:i') : '' }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach

                                {{-- Direct disciplines --}}
                                @php
                                    $certDisciplineIds = $student->certifications->flatMap->disciplines->pluck('id')->unique();
                                    $directs = $student->disciplines->filter(fn($d) => !$certDisciplineIds->contains($d->id));
                                @endphp

                                @foreach ($directs as $discipline)
                                    @foreach ($discipline->resources as $resource)
                                        @php
                                            $pivot = $resources->firstWhere('id', $resource->id)?->pivot;
                                        @endphp
                                        <tr>
                                            <td>Direct</td>
                                            <td>{{ $discipline->title }}</td>
                                            <td><strong>{{ $resource->title }}</strong></td>
                                            <td>{{ ucfirst($resource->resource_type ?? '') }}</td>
                                            <td>
                                                @if ($pivot?->views > 0)
                                                    <span class="badge bg-success">Completed</span>
                                                @else
                                                    <span class="badge bg-warning">Pending</span>
                                                @endif
                                            </td>
                                            <td>{{ $pivot?->views ?? 0 }}</td>
                                            <td>{{ $pivot?->last_viewed_at ? \Carbon\Carbon::parse($pivot->last_viewed_at)->format('Y-m-d H:i') : '' }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
