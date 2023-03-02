@foreach ($listaStc as $stc)
<div class="coluna-candidato p-0">
    <div class="card shadow">
        <div class="card-header bg-white border-0">
            <div class="row align-items-center justify-content-lg-start titulo-coluna">
                <h5 class="mt-1 mb-1 ml-2 text-left">{{ $stc->nome }}</h5>
                <div class="qnt-processos bg-primary contagem">
                    <span class="contagem-{{ $stc->id }}"></span>
                </div>
            </div>
        </div>
        <div class="card-body bg-secondary pl-3 pr-3">
             @foreach ($processosSeletivo as $processoSeletivo)
            @foreach ($processoCandidatos as $candidato)
            @if ($candidato->processo_id == $processoSeletivo->processo_id)
            @if ($candidato->status_id == $stc->id)
            <div class="card bg-white pt-3 card-{{$stc->id}} pb-3 pl-3 pr-3 card-processo">
                @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH' || Auth::user()->acesso == 'RH')
                    <div class="editar-processo bg-danger" data-toogle="tooltip" data-placement="top" onclick="candidatoEditarAbrir({{$candidato->candidato_id}})" title="Editar">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <div class="aprovar-candidato bg-success" data-toogle="tooltip" data-placement="top" onclick="candidatoAprovarAbrir({{$candidato->candidato_id}})" title="Aprovar">
                        <i class="fa-solid fa-check"></i>
                    </div>
                @endif
                <div class="row">
                    <div class="col">
                        <a href="/processo-seletivo/{{$processoSeletivo->processo_id}}/candidato/{{$candidato->candidato_id}}" class="nome-link">
                            <h5 class="card-title text-uppercase text-primary mb-2 font-weight-bold nome-candidato">{{$candidato->candidato_nome}}</h5>
                        </a>
                        <p class="mt-1 mb-0 texto-candidato">
                            <span class="font-weight-bold text-default">E-mail:</span>
                            {{$candidato->candidato_email}}
                        </p>
                        <p class="mt-1 mb-0 texto-candidato">
                            <span class="font-weight-bold text-default">Telefone:</span> {{$candidato->candidato_telefone}}
                        {{-- </p>
                        <p class="mt-1 mb-0 texto-candidato">
                            <span class="font-weight-bold text-default">Solicitante:</span> <span class="solicitante">{{$candidato->usuario_nome}}</span>
                        </p> --}}
                        <p class="mt-1 mb-0 texto-candidato">
                            <span class="font-weight-bold text-default">Fonte de Captação:</span> <span class="solicitante">
                                {{$candidato->captacao_nome}}
                            </span>
                        </p>
                        <p class="candidato-icones">
                            <a href="{{$candidato->candidato_linkedin}}" target="_blank" class="linkedin" data-toogle="tooltip" data-placement="top" title="Ver Linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
                            <a href="https://calendar.google.com/calendar/" target="_blank" class="calendario" data-toogle="tooltip" data-placement="top" title="Agendar reunião"><i class="fa-solid fa-calendar-days"></i></a>
                            <span class="ver-pdf" data-toogle="tooltip" data-placement="top" title="Ver currículo" onclick="curriculoAbrir({{$candidato->candidato_id}})"><i class="fa-solid fa-file-lines"></i></span>
                        </p>

                        @include('layouts.recrutamento.partials.editar-candidato-processo')


                        <div class="solicitacoes-cadastradas-modal" id="aprovar-modal-{{$candidato->candidato_id}}">
                            <div class="col-lg-5 solicitacao-processo-seletivo-box">
                                <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal"
                                    id="close-modal-{{$candidato->candidato_id}}"
                                    onclick="candidatoAprovarFechar({{$candidato->candidato_id}})">
                                <div class="card shadow col-12 p-0 m-0">
                                    <div class="card-header bg-white border-0">
                                        <div
                                            class="row align-items-center justify-content-center justify-content-lg-start">
                                            <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Aprovar candidato</h4>
                                        </div>
                                    </div>
                                    <div class="card-body bg-secondary">

                                        @include('layouts.recrutamento.partials.aprovar-candidatos')

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            // PROGRAMACAO MODAL
                            function candidatoEditarAbrir(id) {
                                document.getElementById(`editar-modal-${id}`).classList.add(
                                    "modal-visivel");
                            }

                            function candidatoEditarFechar(id) {
                                document.getElementById(`editar-modal-${id}`).classList.remove(
                                    "modal-visivel");
                            }

                              function candidatoAprovarAbrir(id) {
                                document.getElementById(`aprovar-modal-${id}`).classList.add(
                                    "modal-visivel");
                            }

                            function candidatoAprovarFechar(id) {
                                document.getElementById(`aprovar-modal-${id}`).classList.remove(
                                    "modal-visivel");
                            }
                        </script>
                         @include('layouts.recrutamento.partials.curriculo-modal')
                    </div>
                </div>
            </div>
            @endif
            @endif
            @endforeach
            @endforeach
        </div>
    </div>
</div>
<script>
    var cards{{$stc->id}} = $('.card-{{ $stc->id }}').length;
    document.querySelector('.contagem-{{ $stc->id }}').innerHTML = cards{{$stc->id}};
</script>
@endforeach
