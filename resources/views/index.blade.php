@extends('layouts.master')
@section('title') @lang('translation.Dashboard') @endsection

@section('content')
    @component('common-components.breadcrumb')
    @slot('pagetitle') Minible @endslot
    @slot('title') Dashboard @endslot
    @endcomponent

    <div class="container">
        <h1 class="display-3">@lang('welcome.dashboard.welcome')</h1>
    </div>

    <div class="accordion" id="accordionExample">

        <!-- Accordion Item 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    <p><strong>@lang('dashboard.step1.title')</strong></p>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>@lang('dashboard.step1.p1') <img src="assets/images/small/certificacoes.png"></p>
                    <p>@lang('dashboard.step1.p2') <img src="assets/images/small/paypal.png"></p>
                    <p>@lang('dashboard.step1.p3') <img src="assets/images/small/minhas_certificacoes.png"></p>
                </div>
            </div>
        </div>

        <!-- Accordion Item 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <b>@lang('dashboard.step2.title')</b>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>@lang('dashboard.step2.p1') <img src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>@lang('dashboard.step2.p2') <img src="assets/images/small/listCertificacoes.png"
                            style="max-width: 100%; height: auto;"></p>
                </div>
            </div>
        </div>

        <!-- Accordion Item 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <b>@lang('dashboard.step3.title')</b>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>@lang('dashboard.step3.p1') <img src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>@lang('dashboard.step3.p2') <img src="assets/images/small/listCertificacoes.png"
                            style="max-width: 100%; height: auto;"></p>
                    <p>@lang('dashboard.step3.p3') <img src="assets/images/small/doc.png"
                            style="max-width: 100%; height: auto;"></p>
                    <p>@lang('dashboard.step3.p4') <img src="assets/images/small/listDocs.png"
                            style="max-width: 100%; height: auto;"></p>
                </div>
            </div>
        </div>

        <!-- Accordion Item 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <b>@lang('dashboard.step4.title')</b>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>@lang('dashboard.step4.p1') <img src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>@lang('dashboard.step4.p2') <img src="assets/images/small/listCertificacoes.png"
                            style="max-width: 100%; height: auto;"></p>
                    <p>@lang('dashboard.step4.p3') <img src="assets/images/small/tarefas.png"
                            style="max-width: 100%; height: auto;"></p>
                    <p>@lang('dashboard.step4.p4') <img src="assets/images/small/concluaTarefa.png"
                            style="max-width: 50%; height: auto;"></p>
                    <p>@lang('dashboard.step4.p5')</p>
                    <p><img src="assets/images/small/tarefa2.png" style="max-width: 100%; height: auto;"></p>
                </div>
            </div>
        </div>

        <!-- Accordion Item 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    <b>@lang('dashboard.step5.title')</b>
                </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>@lang('dashboard.step5.p1') <img src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>@lang('dashboard.step5.p2') <img src="assets/images/small/listCertificacoes.png"
                            style="max-width: 100%; height: auto;"></p>
                    <p>@lang('dashboard.step5.p3') <img src="assets/images/small/test.png"
                            style="max-width: 100%; height: auto;"></p>
                    <p>@lang('dashboard.step5.warning1')</p>
                    <p>@lang('dashboard.step5.warning2')</p>
                    <p>@lang('dashboard.step5.warning3')</p>
                    <p>@lang('dashboard.step5.warning4') <img src="assets/images/small/testPage.png"
                            style="max-width: 100%; height: auto;"></p>
                    <p><b>@lang('dashboard.step5.detailsTitle')</b></p>
                    <p>@lang('dashboard.step5.detail1')</p>
                    <p>@lang('dashboard.step5.detail2')</p>
                </div>
            </div>
        </div>
    </div>
@endsection