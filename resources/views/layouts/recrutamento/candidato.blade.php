@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Candidato')
@section('pagina', 'Perfil Candidato')

@section('conteudo')
<div class="main-content">
    <div class="container-fluid">
        @include('layouts.template-partials.alerts')
        <div class="row mt-5 row-info-candidato">
            <div class="col-12 col-lg-4 coluna-info-candidato">
                <div class="card shadow card-info-candidato">
                    <div class="card-header bg-white border-0">
                        <div
                            class="row align-items-center position-relative">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Informações do candidato
                            </h3>
                            @foreach ($candidatos as $candidato)
                            <span class="editar-processo bg-danger"
                                onclick="candidatoEditarAbrir({{$candidato->candidato_id}})" id="abrir-candidato"
                                data-toogle="tooltip" data-placement="top" title="Editar"><i
                                    class="fa-solid fa-pen-to-square"></i></span>
                            @include('layouts.recrutamento.partials.editar-candidato-perfil')
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body bg-secondary pl-3 pr-3">
                        @foreach ($candidatos as $candidato)
                        <div class="col pl-2 pr-2">
                            <h4 class="card-title text-uppercase text-primary mb-3 font-weight-bold">
                                {{$candidato->candidato_nome}}</h4>
                            <p class="mt-1 mb-0 texto-candidato">
                                <span class="font-weight-bold text-default">E-mail:</span>
                                {{$candidato->candidato_email}}
                            </p>
                            <p class="mt-1 mb-0 texto-candidato">
                                <span class="font-weight-bold text-default">Telefone:</span>
                                {{$candidato->candidato_telefone}}
                            </p>
                            <p class="mt-1 mb-0 texto-candidato">
                                <span class="font-weight-bold text-default">Solicitante:</span>
                                <span class="solicitante">{{$candidato->solicitante}}</span>
                            </p>
                            <p class="mt-1 mb-0 texto-candidato">
                                <span class="font-weight-bold text-default">Fonte de Captação:</span> <span class="solicitante">{{$candidato->captacao_nome}}</span>
                            </p>
                            <p class="candidato-icones">
                                <a href="{{$candidato->candidato_linkedin}}" target="_blank" class="linkedin"
                                    data-toogle="tooltip" data-placement="top" title="Ver Linkedin"><i
                                        class="fa-brands fa-linkedin-in"></i></a>
                                <a href="https://calendar.google.com/calendar/" target="_blank" class="calendario"
                                    data-toogle="tooltip" data-placement="top" title="Agendar reunião"><i
                                        class="fa-solid fa-calendar-days"></i></a>
                                <span class="ver-pdf" onclick="curriculoAbrir({{$candidato->candidato_id}})"
                                    id="abrir-curriculo" data-toogle="tooltip" data-placement="top"
                                    title="Ver currículo"><i class="fa-solid fa-file-lines"></i></span>
                            </p>
                        </div>
                        @include('layouts.recrutamento.partials.curriculo-modal')
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-8 coluna-timeline-candidato">
                <div class="card shadow card-info-candidato">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Histórico</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary pl-3 pr-3 timeline">
                        @include('layouts.recrutamento.partials.historico-candidato')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function candidatoEditarAbrir(id) {
        document.getElementById(`editar-modal-${id}`).classList.add(
            "modal-visivel");
    }

    function candidatoEditarFechar(id) {
        document.getElementById(`editar-modal-${id}`).classList.remove(
            "modal-visivel");
    }
</script>
@endsection
