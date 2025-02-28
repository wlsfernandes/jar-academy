@extends('layouts.master')
@section('title')
@lang('translation.Form_Repeater')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Forms @endslot
@slot('title') Form Repeater @endslot
@endcomponent

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Example</h4>
                <form class="repeater" enctype="multipart/form-data">
                    <div data-repeater-list="group-a">
                        <div data-repeater-item class="row">
                            <div class="mb-3 col-lg-2">
                                <label class="form-label" for="name">Full Name:</label>
                                <input type="text" id="name" name="untyped-input" class="form-control" placeholder="Enter your full name" />
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label class="form-label" for="email">Email:</label>
                                <input type="email" id="email" class="form-control" placeholder="Enter your email address" />
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label class="form-label" for="subject">Subject:</label>
                                <input type="text" id="subject" class="form-control" placeholder="Enter your subject" />
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label class="form-label" for="resume">Resume:</label>
                                <input class="form-control" type="file" id="formFile" />
                            </div>

                            <div class="mb-3 col-lg-2">
                                <label class="form-label" for="message">Message:</label>
                                <textarea id="message" class="form-control" placeholder="Enter your message"></textarea>
                            </div>

                            <div class="col-lg-2 align-self-center">
                                <div class="d-grid">
                                    <input data-repeater-delete type="button" class="btn btn-primary" value="Delete" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <input data-repeater-create type="button" class="btn btn-success mt-3 mt-lg-0" value="Add" />
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Nested</h4>
                <form class="outer-repeater">
                    <div data-repeater-list="outer-group" class="outer">
                        <div data-repeater-item class="outer">
                            <div class="mb-3">
                                <label class="form-label" for="formname">Name :</label>
                                <input type="text" class="form-control" id="formname" placeholder="Enter your Name...">
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="formemail">Email :</label>
                                <input type="email" class="form-control" id="formemail" placeholder="Enter your Email...">
                            </div>

                            <div class="inner-repeater mb-4">
                                <div data-repeater-list="inner-group" class="inner form-group">
                                    <label class="form-label">Phone no :</label>
                                    <div data-repeater-item class="inner mb-3 row">
                                        <div class="col-md-10 col-8">
                                            <input type="text" class="inner form-control" placeholder="Enter your phone no..." />
                                        </div>
                                        <div class="col-md-2 col-4">
                                            <div class="d-grid">
                                                <input data-repeater-delete type="button" class="btn btn-primary inner" value="Delete" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input data-repeater-create type="button" class="btn btn-success inner" value="Add Number" />
                            </div>

                            <div class="mb-2">
                                <label class="form-label d-block mb-3">Gender :</label>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1" class="form-check-input">
                                    <label class="form-check-label" for="customRadioInline1">Male</label>
                                </div>
                                <div class="custom-radio form-check form-check-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1" class="form-check-input">
                                    <label class="form-check-label" for="customRadioInline2">Female</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="formmessage">Message :</label>
                                <textarea id="formmessage" class="form-control" rows="3" placeholder="Enter your message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection
@section('script')
<!-- Plugins js -->
<script src="{{ asset('/assets/libs/jquery-repeater/jquery-repeater.min.js') }}"></script>
<script src="{{ asset('/assets/js/pages/form-repeater.int.js') }}"></script>
@endsection
