@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Candidato do Processo')
@section('pagina', 'Perfil Candidato do Processo')

@section('conteudo')
    <div class="main-content">
        <div class="container-fluid">
            @include('layouts.template-partials.alerts')
            <div class="row mt-5 row-info-candidato">
                <div class="col-12 col-lg-4 coluna-info-candidato">
                    <div class="card shadow card-info-candidato">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center position-relative">
                                <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Informações do candidato
                                </h3>
                                @foreach ($candidatos as $candidato)
                                    <span class="editar-processo bg-danger"
                                        onclick="candidatoEditarAbrir({{ $candidato->candidato_id }})" id="abrir-candidato"
                                        data-toogle="tooltip" data-placement="top" title="Editar"><i
                                            class="fa-solid fa-pen-to-square"></i></span>
                                    @include('layouts.recrutamento.partials.editar-candidato')
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body bg-secondary pl-3 pr-3">
                            @foreach ($candidatos as $candidato)
                                <div class="col pl-2 pr-2">
                                    <h4 class="card-title text-uppercase text-primary mb-3 font-weight-bold">
                                        {{ $candidato->candidato_nome }}</h4>
                                    <p class="mt-1 mb-0 texto-candidato">
                                        <span class="font-weight-bold text-default">E-mail:</span>
                                        {{ $candidato->candidato_email }}
                                    </p>
                                    <p class="mt-1 mb-0 texto-candidato">
                                        <span class="font-weight-bold text-default">Telefone:</span>
                                        {{ $candidato->candidato_telefone }}
                                    </p>
                                    {{-- <p class="mt-1 mb-0 texto-candidato">
                                        <span class="font-weight-bold text-default">Solicitante:</span> <span
                                            class="solicitante">{{ $candidato->solicitante }}</span>
                                    </p> --}}
                                    <p class="mt-1 mb-0 texto-candidato">
                                        <span class="font-weight-bold text-default">Fonte de Captação:</span> <span
                                            class="solicitante">{{ $candidato->captacao_nome }}</span>
                                    </p>
                                    <p class="candidato-icones">
                                        <a href="{{ $candidato->candidato_linkedin }}" target="_blank" class="linkedin"
                                            data-toogle="tooltip" data-placement="top" title="Ver Linkedin"><i
                                                class="fa-brands fa-linkedin-in"></i></a>
                                        <a href="https://calendar.google.com/calendar/" target="_blank" class="calendario"
                                            data-toogle="tooltip" data-placement="top" title="Agendar reunião"><i
                                                class="fa-solid fa-calendar-days"></i></a>
                                        <span class="ver-pdf" onclick="curriculoAbrir({{ $candidato->candidato_id }})"
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
                            <div class="row align-items-center position-relative">
                                <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Parecer</h3>
                                @foreach ($candidatos as $candidato)
                                    @foreach ($processosSeletivo as $processo)
                                        <ul class="btn-yoodash">
                                            <li id="btn-opcoes">
                                                <div class="icon-opcoes">
                                                    +
                                                </div>
                                                <ul class="menu-opcoes">
                                                    <li id="btn-dashboard"
                                                        onclick="parecerAbrir({{ $candidato->candidato_id }})">
                                                        <span>Adicionar Parecer</span>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>

                                        @include('layouts.recrutamento.partials.adicionar-parecer-candidato')
                                    @endforeach
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body bg-secondary pl-3 pr-3 timeline">
                            @include('layouts.recrutamento.partials.timeline')
                        </div>
                    </div>
                </div>
            </div>
            @if (count($respostas) == 0)
                <div class="card-body bg-secondary mt-2 timeline">
                    Nenhum teste foi realizado pelo candidato.
                </div>
            @else
                <div class="row mt-3">
                    <div class="col-12 pl-1 pr-1">
                        <div class="card shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center justify-content-center justify-content-lg-start">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            @for ($i = 0; $i < count($respostas); $i++)
                                                <button class="nav-link" id="nav-{{ $respostas[$i]->avaliacao_nome }}-tab"
                                                    data-bs-toggle="tab"
                                                    data-bs-target="#nav-{{ $respostas[$i]->avaliacao_id }}" type="button"
                                                    role="tab" aria-controls="nav-{{ $respostas[$i]->avaliacao_id }}"
                                                    aria-selected="true">{{ $respostas[$i]->avaliacao_nome }}

                                                </button>
                                            @endfor
                                        </div>
                                    </nav>
                                </div>
                            </div>
                            <div class="card-body bg-secondary pl-0 pr-0 pl-lg-4 pr-lg-4">
                                @for ($a = 0; $a < count($respostas); $a++)
                                    <div class="tab-content" id="nav-tabContent">
                                        <div class="tab-pane fade" id="nav-{{ $respostas[$a]->avaliacao_id }}"
                                            role="tabpanel" aria-labelledby="nav-{{ $respostas[$a]->avaliacao_id }}-tab">
                                            <div class="col-12 pl-1 pr-1 m-0">
                                                <div class="card shadow">
                                                    <div class="card-body bg-secondary pl-2 pr-2 pl-lg-4 pr-lg-4">
                                                        <div class="row justify-content-center align-items-center">

                                                            @include('layouts.recrutamento.partials.avaliar-teste')

                                                        </div>
                                                        <div class="row justify-content-center align-items-center mt-4">
                                                            <div class="col-12 justify-content-center align-items-center">

                                                                @if ($respostas_array[$a]['respostas'])
                                                                    @if ($respostas_array[$a]['questoes']->questaoDissertativa)
                                                                        @for ($c = 0; $c < count($respostas_array[$a]['questoes']->questaoDissertativa); $c++)
                                                                            <div
                                                                                class="card bg-secondary pt-4 pb-2 pl-4 pr-4 mb-4">
                                                                                {{-- {{dd($respostas_array[$a]['questoes'])}} --}}
                                                                                {!! nl2br($respostas_array[$a]['questoes']->questaoDissertativa[$c]->questao) !!}
                                                                                @if (isset($avaliacao['json']->questaoDissertativa[$i]->imagem))
                                                                                    @for ($d = 0; $d < count($avaliacao['json']->questaoDissertativa[$i]->imagem); $d++)
                                                                                        <img width="100%"
                                                                                            src="{{ asset($avaliacao['json']->questaoDissertativa[$i]->imagem[$d]) }}">
                                                                                    @endfor
                                                                                @endif
                                                                            </div>
                                                                            <div
                                                                                class="card bg-white pt-4 pb-2 pl-4 pr-4 mb-4">
                                                                                <h4
                                                                                    class="card-title text-uppercase text-primary mb-0 font-weight-bold mb-3">
                                                                                    Resposta:</h4>
                                                                                <p>{!! $respostas_array[$a]['respostas'] != null
                                                                                    ? nl2br($respostas_array[$a]['respostas']->respostas_dissertativas[$c])
                                                                                    : 'Candidato ainda não respondeu!' !!}
                                                                                </p>
                                                                            </div>
                                                                        @endfor
                                                                    @endif

                                                                    @if ($respostas_array[$a]['questoes']->questoesMistas)
                                                                    <?php $count_resp = 0?>
                                                                        @for ($m = 0; $m < count($respostas_array[$a]['questoes']->questoesMistas); $m++)
                                                                            <div
                                                                                class="card bg-secondary pt-4 pb-2 pl-4 pr-4 mb-4">
                                                                                Objetivo: {!! nl2br($respostas_array[$a]['questoes']->questoesMistas[$m]->objetivo) !!}
                                                                            </div>
                                                                            @for ($rm = 0; $rm < count($respostas_array[$a]['questoes']->questoesMistas[$m]->questoes); $rm++)
                                                                                <div
                                                                                    class="card bg-secondary pt-4 pb-2 pl-4 pr-4 mb-4">

                                                                                    {!! nl2br($respostas_array[$a]['questoes']->questoesMistas[$m]->questoes[$rm]) !!}
                                                                                </div>
                                                                                <div
                                                                                    class="card bg-white pt-4 pb-2 pl-4 pr-4 mb-4">
                                                                                    <h4
                                                                                        class="card-title text-uppercase text-primary mb-0 font-weight-bold mb-3">
                                                                                        Resposta:</h4>
                                                                                    <p>{!! $respostas_array[$a]['respostas'] != null
                                                                                        ? nl2br($respostas_array[$a]['respostas']->respostas_mistas[$count_resp])
                                                                                        : 'Candidato ainda não respondeu!' !!}
                                                                                    </p>
                                                                                </div>
                                                                                <?php $count_resp++; ?>
                                                                                @endfor

                                                                        @endfor
                                                                    @endif

                                                                    @for ($d = 0; $d < count($respostas_array[$a]['questoes']->alternativas); $d++)
                                                                        <div
                                                                            class="card bg-secondary pt-4 pb-2 pl-4 pr-4 mb-4">
                                                                            {!! nl2br($respostas_array[$a]['questoes']->alternativas[$d]->questao) !!}
                                                                            <ol class="lista-resposta">
                                                                                @for ($e = 0; $e < count($respostas_array[$a]['questoes']->alternativas[$d]->alternativa); $e++)
                                                                                    <li>{!! nl2br($respostas_array[$a]['questoes']->alternativas[$d]->alternativa[$e]) !!}
                                                                                    </li>
                                                                                @endfor
                                                                            </ol>
                                                                        </div>
                                                                        <div
                                                                            class="card bg-white pt-4 pb-2 pl-4 pr-4 mb-4">
                                                                            <h4
                                                                                class="card-title text-uppercase text-primary mb-0 font-weight-bold mb-3">
                                                                                Resposta:</h4>

                                                                            @if ($respostas_array[$a]['respostas'] != null)
                                                                                @if (
                                                                                    $respostas_array[$a]['questoes']->alternativas[$d]->alternativa_correta[0] ==
                                                                                        $respostas_array[$a]['respostas']->respostas_alternativas[$d]
                                                                                )
                                                                                    <p class="text-success text-bold">
                                                                                        @if ($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 0)
                                                                                            A
                                                                                        @elseif($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 1)
                                                                                            B
                                                                                        @elseif($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 2)
                                                                                            C
                                                                                        @elseif($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 3)
                                                                                            D
                                                                                        @else
                                                                                            "Prefiro não responder"
                                                                                        @endif
                                                                                    </p>
                                                                                @else
                                                                                    <p class="text-danger text-bold">
                                                                                        @if ($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 0)
                                                                                            A
                                                                                        @elseif($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 1)
                                                                                            B
                                                                                        @elseif($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 2)
                                                                                            C
                                                                                        @elseif($respostas_array[$a]['respostas']->respostas_alternativas[$d] == 3)
                                                                                            D
                                                                                        @else
                                                                                            "Prefiro não responder"
                                                                                        @endif
                                                                                    </p>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                    @endfor
                                                                @else
                                                                    Candidato ainda não respondeu!
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
            @endif
        </div>
        <div class="row mt-3">

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

        function parecerAbrir(id) {
            document.getElementById(`parecer-modal-${id}`).classList.add(
                "modal-visivel");
        }

        function parecerFechar(id) {
            document.getElementById(`parecer-modal-${id}`).classList.remove(
                "modal-visivel");
        }
    </script>
@endsection
