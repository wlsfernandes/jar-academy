@extends('layouts.master')
@section('title')
@lang('translation.Form_wizard')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Forms @endslot
@slot('title') Form wizard @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Basic Wizard</h4>

                <div id="basic-example">
                    <!-- Seller Details -->
                    <h3>Seller Details</h3>
                    <section>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-firstname-input">First Name</label>
                                        <input type="text" class="form-control" id="basicpill-firstname-input" placeholder="Enter your First name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-lastname-input">Last Name</label>
                                        <input type="text" class="form-control" id="basicpill-lastname-input" placeholder="Enter your Last Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-phoneno-input">Phone</label>
                                        <input type="text" class="form-control" id="basicpill-phoneno-input" placeholder="Enter your Phone Number">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-email-input">Email</label>
                                        <input type="email" class="form-control" id="basicpill-email-input" placeholder="Enter your email address">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="basicpill-address-input">Address</label>
                                        <textarea id="basicpill-address-input" class="form-control" rows="2" placeholder="Enter your Address"></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>

                    <!-- Company Document -->
                    <h3>Company Document</h3>
                    <section>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-pancard-input">PAN Card</label>
                                        <input type="text" class="form-control" id="basicpill-pancard-input" placeholder="Enter your Pancard Number" />
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-vatno-input">VAT/TIN No.</label>
                                        <input type="text" class="form-control" id="basicpill-vatno-input" placeholder="Enter your VAT/TIN number.">
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-cstno-input">CST No.</label>
                                        <input type="text" class="form-control" id="basicpill-cstno-input" placeholder="Enter your CST number">
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-servicetax-input">Service Tax No.</label>
                                        <input type="text" class="form-control" id="basicpill-servicetax-input" placeholder="Enter your Service Tax number">
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-companyuin-input">Company UIN</label>
                                        <input type="text" class="form-control" id="basicpill-companyuin-input" placeholder="Enter your Company UIN number">
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="basicpill-declaration-input">Declaration</label>
                                        <input type="text" class="form-control" id="basicpill-Declaration-input" placeholder="Enter your Declaration">
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                        </form>
                    </section>

                    <!-- Bank Details -->
                    <h3>Bank Details</h3>
                    <section>
                        <div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-namecard-input">Name on Card</label>
                                            <input type="text" class="form-control" id="basicpill-namecard-input" placeholder="Enter your Name on Card">
                                        </div>
                                    </div><!-- end col-lg-6 -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Credit Card Type</label>
                                            <select class="form-select">
                                                <option selected>Select Card Type</option>
                                                <option value="AE">American Express</option>
                                                <option value="VI">Visa</option>
                                                <option value="MC">MasterCard</option>
                                                <option value="DI">Discover</option>
                                            </select>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-cardno-input">Credit Card Number</label>
                                            <input type="text" class="form-control" id="basicpill-cardno-input" placeholder="Enter your Enter your Credit Card Number">
                                        </div>
                                    </div><!-- end col-lg-6 -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-card-verification-input">Card Verification Number</label>
                                            <input type="text" class="form-control" id="basicpill-card-verification-input" placeholder="Enter your Card Verification Number">
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="basicpill-expiration-input">Expiration Date</label>
                                            <input type="text" class="form-control" id="basicpill-expiration-input" placeholder="Enter your Expiration Date">
                                        </div>
                                    </div><!-- end col-lg-6 -->

                                </div><!-- end row -->
                            </form>
                        </div>
                    </section>

                    <!-- Confirm Details -->
                    <h3>Confirm Detail</h3>
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                    </div>
                                    <div>
                                        <h5>Confirm Detail</h5>
                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                    </div>
                                </div>
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->
                    </section>
                </div>

            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Vertical Wizard</h4>

                <div id="vertical-example" class="vertical-wizard">
                    <!-- Seller Details -->
                    <h3>Seller Details</h3>
                    <section>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-firstname-input">First Name</label>
                                        <input type="text" class="form-control" id="verticalnav-firstname-input" placeholder="Enter your First Name">
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-lastname-input">Last name</label>
                                        <input type="text" class="form-control" id="verticalnav-lastname-input" placeholder="Enter your Last Name">
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-phoneno-input">Phone</label>
                                        <input type="text" class="form-control" id="verticalnav-phoneno-input" placeholder="Enter your Phone">
                                    </div>
                                </div><!-- end col-lg-6 -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-email-input">Email</label>
                                        <input type="email" class="form-control" id="verticalnav-email-input" placeholder="Enter your Email address">
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="verticalnav-address-input">Address</label>
                                        <textarea id="verticalnav-address-input" class="form-control" rows="2" placeholder="Enter your Address"></textarea>
                                    </div>
                                </div><!-- end col-lg-12 -->
                            </div><!-- end row -->
                        </form>
                    </section>

                    <!-- Company Document -->
                    <h3>Company Document</h3>
                    <section>
                        <form>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-pancard-input">PAN Card</label>
                                        <input type="text" class="form-control" id="verticalnav-pancard-input" placeholder="Enter your PAN Card number">
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-vatno-input">VAT/TIN No.</label>
                                        <input type="text" class="form-control" id="verticalnav-vatno-input" placeholder="Enter your VAT/TIN number" />
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-cstno-input">CST No.</label>
                                        <input type="text" class="form-control" id="verticalnav-cstno-input" placeholder="Enter your CST number">
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-servicetax-input">Service Tax No.</label>
                                        <input type="text" class="form-control" id="verticalnav-servicetax-input" placeholder="Enter your Service Tax number">
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-companyuin-input">Company UIN</label>
                                        <input type="text" class="form-control" id="verticalnav-companyuin-input" placeholder="Enter your Company UIN number">
                                    </div>
                                </div><!-- end col-lg-6 -->

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="verticalnav-declaration-input">Declaration</label>
                                        <input type="text" class="form-control" id="verticalnav-Declaration-input" placeholder="Enter your Declaration">
                                    </div>
                                </div><!-- end col-lg-6 -->
                            </div><!-- end row -->
                        </form>
                    </section>

                    <!-- Bank Details -->
                    <h3>Bank Details</h3>
                    <section>
                        <div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="verticalnav-namecard-input">Name on Card</label>
                                            <input type="text" class="form-control" id="verticalnav-namecard-input" placeholder="Enter your Name on Card">
                                        </div>
                                    </div><!-- end col-lg-6 -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label>Credit Card Type</label>
                                            <select class="form-select">
                                                <option selected>Select Card Type</option>
                                                <option value="AE">American Express</option>
                                                <option value="VI">Visa</option>
                                                <option value="MC">MasterCard</option>
                                                <option value="DI">Discover</option>
                                            </select>
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                </div><!-- end row -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="verticalnav-cardno-input">Credit Card Number</label>
                                            <input type="text" class="form-control" id="verticalnav-cardno-input" placeholder="Enter your Enter Credit Card Number">
                                        </div>
                                    </div><!-- end col-lg-6 -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="verticalnav-card-verification-input">Card Verification Number</label>
                                            <input type="text" class="form-control" id="verticalnav-card-verification-input" placeholder="Enter your Card Verification Number">
                                        </div>
                                    </div><!-- end col-lg-6 -->
                                </div><!-- End row -->
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="verticalnav-expiration-input">Expiration Date</label>
                                            <input type="text" class="form-control" id="verticalnav-expiration-input" placeholder="Enter your Expiration Date">
                                        </div>
                                    </div><!-- end col-lg-6 -->

                                </div><!-- end row -->
                            </form>
                        </div>
                    </section>

                    <!-- Confirm Details -->
                    <h3>Confirm Detail</h3>
                    <section>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="text-center">
                                    <div class="mb-4">
                                        <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                    </div>
                                    <div>
                                        <h5>Confirm Detail</h5>
                                        <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                    </div>
                                </div>
                            </div><!-- end col-lg-6 -->
                        </div><!-- end row -->
                    </section>
                </div>
            </div>
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

@endsection
@section('script')
<!-- jquery-steps js -->
<script src="{{ asset('/assets/libs/jquery-steps/jquery-steps.min.js') }}"></script>
<script src="{{ asset('/assets/js/pages/form-wizard.init.js') }}"></script>
@endsection
