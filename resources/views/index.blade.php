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
                    <p><strong> 1 - Aprenda aqui como se matricular e acessar nossos recursos</strong></p>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>Clique no menu Certificacões e veja a lista de todas as ceritifacoes fornecidas: <span></span><img
                            src="assets/images/small/certificacoes.png"></p>
                    <p>Escolha a certificacao que deseja fazer e clique em Paypal para fazer o pagamento: <span></span><img
                            src="assets/images/small/paypal.png"></p>
                    </p>
                    <p>Após realizar o pagamento sua certificacão estará disponível no menu esquerda Minhas Certificacões:
                        <span></span><img src="assets/images/small/minhas_certificacoes.png">
                    </p>
                </div>
            </div>
        </div>

        <!-- Accordion Item 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <b>2 - Como cursar e ter acesso aos recursos da minha certificação</b>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>a. Clique no menu Minhas Certificacões <span></span><img
                            src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>b. Você terá acesso a todas as suas certificacões. <span></span><img
                            src="assets/images/small/listCertificacoes.png" style="max-width: 100%; height: auto;"></p>
                </div>
            </div>
        </div>

        <!-- Accordion Item 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <b>3 - Como cursar e acessar recursos das certificações</b>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>a. Clique no menu Minhas Certificacões <span></span><img
                            src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>b. Você terá acesso a todas as suas certificacões. <span></span><img
                            src="assets/images/small/listCertificacoes.png" style="max-width: 100%; height: auto;"></p>
                    <p>c. Clique no Icone de Documentos e tenha acesso a todos os videos e aulas <span></span><img
                            src="assets/images/small/doc.png" style="max-width: 100%; height: auto;"></p>
                    <p>d. Clique no Icone Ver e tenha acesso a todos os videos e aulas <span></span><img
                            src="assets/images/small/listDocs.png" style="max-width: 100%; height: auto;"></p>
                </div>
            </div>
        </div>
        <!-- Accordion Item 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <b>4 - Como concluir as tarefas do meu curso</b>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>a. Clique no menu Minhas Certificacões <span></span><img
                            src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>b. Você terá acesso a todas as suas certificacões. <span></span><img
                            src="assets/images/small/listCertificacoes.png" style="max-width: 100%; height: auto;"></p>
                    <p>c. Clique no Icone de Tarefas e tenha acesso a todos as suas tarefas <span></span><img
                            src="assets/images/small/tarefas.png" style="max-width: 100%; height: auto;"></p>
                    <p>d. Para concluir sua tarefa clique no ícone <span></span><img
                            src="assets/images/small/concluaTarefa.png" style="max-width: 50%; height: auto;"></p>
                    <p>e. Para concluir sua tarefa responda a(s) pergunta(s) solicitada(s)</p>
                    <p> <span></span><img src="assets/images/small/tarefa2.png" style="max-width: 100%; height: auto;"></p>
                </div>
            </div>
        </div>
        <!-- Accordion Item 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    <b>5 - Como acessar e realizar sua prova com sucesso</b>
                </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <p>a. Clique no menu Minhas Certificacões <span></span><img
                            src="assets/images/small/minhas_certificacoes.png"></p>
                    <p>b. Você terá acesso a todas as suas certificacões. <span></span><img
                            src="assets/images/small/listCertificacoes.png" style="max-width: 100%; height: auto;"></p>
                    <p>c. Clique no Icone de Prova e tenha acesso a a prova do curso <span></span><img
                            src="assets/images/small/test.png" style="max-width: 100%; height: auto;"></p>
                    <p>d. Importante! Atenção! Você tem 50 minutos para concluir o teste. Assim que iniciar, o sistema
                        começará a contagem regressiva automaticamente. Por favor, note:</p>

                    <p>O cronômetro continuará rodando mesmo que você atualize a página ou saia do sistema.</p>
                    <p>
                        Não enviar as respostas antes que o cronômetro expire resultará em um teste incompleto, que será
                        marcado como reprovado.
                    </p>
                    <p>Certifique-se de permanecer focado e enviar suas respostas a tempo.</p> <span></span><img
                        src="assets/images/small/testPage.png" style="max-width: 100%; height: auto;"></p>
                    <p><b>Detalhes Importantes</b>:</p>

                    <p>
                        1. Limite de Tempo: A duração do teste é de 50 minutos. Assim que iniciar, o cronômetro começará a
                        contagem regressiva, então planeje seu tempo com sabedoria.
                    </p>

                    <p>
                        2. Envio: Após revisar o arquivo, utilize a área de texto abaixo para fornecer suas respostas.
                        Certifique-se de que todas as respostas sejam claras e completas.
                    </p>
                </div>
            </div>
        </div>

    </div>




@endsection
