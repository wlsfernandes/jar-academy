@extends('layouts.master')
@section('title')
    @lang('translation.Google_maps')
@endsection

@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle') Maps @endslot
        @slot('title') Google Maps @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Markers</h4>
                    <p class="card-title-dsec">Example of google maps.</p>

                    <div id="gmaps-markers" class="gmaps"></div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Overlays</h4>
                    <p class="card-title-desc">Example of google maps.</p>

                    <div id="gmaps-overlay" class="gmaps"></div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Street View Panoramas</h4>
                    <p class="card-title-desc">Example of google maps.</p>

                    <div id="panorama" class="gmaps-panaroma"></div>
                </div>
            </div>
        </div> <!-- end col -->

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Map Types</h4>
                    <p class="card-title-desc">Example of google maps.</p>

                    <div id="gmaps-types" class="gmaps"></div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
@section('script')
    <script src="https://maps.google.com/maps/api/js?key=AIzaSyCtSAR45TFgZjOs4nBFFZnII-6mMHLfSYI"></script>
    <script src="{{ asset('/assets/libs/gmaps/gmaps.min.js') }}"></script>
    <script src="{{ asset('/assets/js/pages/gmaps.init.js') }}"></script>
@endsection
