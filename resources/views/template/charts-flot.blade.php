@extends('layouts.master')
@section('title')
    @lang('translation.Flot_Charts')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Charts @endslot
        @slot('title') Flot Charts @endslot
    @endcomponent

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Multiple Statistics</h4>

                    <div id="website-stats" data-colors='["--bs-light","--bs-primary", "--bs-warning"]' class="flot-charts flot-charts-height"></div>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Realtime Statistics</h4>

                    <div id="flotRealTime" data-colors='["--bs-success"]' class="flot-charts flot-charts-height"></div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Donut Pie</h4>

                    <div id="donut-chart">
                        <div id="donut-chart-container" data-colors='["--bs-light","--bs-primary", "--bs-success"]' class="flot-charts flot-charts-height">
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">Pie Chart</h4>

                    <div id="pie-chart">
                        <div id="pie-chart-container" data-colors='["--bs-primary","--bs-warning", "--bs-light"]' class="flot-charts flot-charts-height">
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection
@section('script')
    <script src="{{ asset('/assets/libs/flot-charts/flot-charts.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/flot.init.js') }}"></script>
@endsection
