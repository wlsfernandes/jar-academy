@extends('layouts.master')
@section('title')
@lang('translation.FAQs')
@endsection

@section('content')
@component('common-components.breadcrumb')
@slot('pagetitle') Utility @endslot
@slot('title') FAQS @endslot
@endcomponent

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-5">
                        <div class="text-center">
                            <h5>Can't find what you are looking for?</h5>
                            <p class="text-muted">If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual</p>

                            <div>
                                <button type="button" class="btn btn-primary mt-2 me-2 waves-effect waves-light">Email Us</button>
                                <button type="button" class="btn btn-success mt-2 waves-effect waves-light">Send us a tweet</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-xl-3 col-sm-5 mx-auto">
                        <div>
                            <img src="{{asset('assets/images/faqs-img.png')}}" alt="" class="img-fluid mx-auto d-block">
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div id="faqs-accordion" class="custom-accordion mt-5 mt-xl-0">
                            <div class="card border shadow-none">
                                <a href="#faqs-gen-ques-collapse" class="text-dark" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="true" aria-controls="faqs-gen-ques-collapse">
                                    <div class="bg-light p-3">

                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle font-size-22">
                                                        <i class="uil uil-question-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">General Questions</h5>
                                                <p class="text-muted text-truncate mb-0">General Questions</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-16"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <div id="faqs-gen-ques-collapse" class="collapse show" data-bs-parent="#faqs-accordion">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">What is Lorem Ipsum ?</h5>
                                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting language is more simple</p>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">Where does it come from ?</h5>
                                                            <p class="text-muted">Everyone realizes why a new common language would be desirable one could refuse to pay expensive translators.</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div>
                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">Why do we use it ?</h5>
                                                            <p class="text-muted">Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border shadow-none">
                                <a href="#faqs-privacy-policy-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-controls="faqs-privacy-policy-collapse">
                                    <div class="bg-light p-3">

                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle font-size-22">
                                                        <i class="uil uil-shield-check"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Privacy Policy</h5>
                                                <p class="text-muted text-truncate mb-0">Privacy Policy Questions</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-16"></i>
                                            </div>
                                        </div>

                                    </div>
                                </a>

                                <div id="faqs-privacy-policy-collapse" class="collapse" data-bs-parent="#faqs-accordion">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">Where can I get some ?</h5>
                                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting language is more simple</p>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">Why do we use it ?</h5>
                                                            <p class="text-muted">Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div>
                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">Where does it come from ?</h5>
                                                            <p class="text-muted">Everyone realizes why a new common language would be desirable one could refuse to pay expensive translators.</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card border shadow-none">
                                <a href="#faqs-pricing-plans-collapse" class="text-dark collapsed" data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-controls="faqs-pricing-plans-collapse">
                                    <div class="bg-light p-3">

                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle font-size-22">
                                                        <i class="uil uil-pricetag-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Pricing & Plans</h5>
                                                <p class="text-muted text-truncate mb-0">Pricing & Plans Questions</p>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <i class="mdi mdi-chevron-up accor-down-icon font-size-16"></i>
                                            </div>
                                        </div>

                                    </div>
                                </a>

                                <div id="faqs-pricing-plans-collapse" class="collapse" data-bs-parent="#faqs-accordion">
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div>
                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">Where does it come from ?</h5>
                                                            <p class="text-muted">Everyone realizes why a new common language would be desirable one could refuse to pay expensive translators.</p>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">What is Lorem Ipsum ?</h5>
                                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting language is more simple</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div>
                                                    <div class="d-flex align-items-start mt-4">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title rounded-circle bg-primary-subtle text-primary font-size-22">
                                                                    <i class="uil uil-question-circle"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="flex-grow-1">
                                                            <h5 class="font-size-16 mt-1">Why do we use it ?</h5>
                                                            <p class="text-muted">Their separate existence is a myth. For science, music, sport, etc, Europe uses the same vocabulary. </p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection
