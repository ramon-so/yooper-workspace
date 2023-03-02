@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Candidatos')
@section('pagina', 'Processo Seletivo')

@section('conteudo')
    <div class="main-content">
        <div class="container-fluid">
            @include('layouts.template-partials.alerts')
            <div class="row mt-5">
                <div class="col pl-3 pr-3 pl-lg-2 pr-lg-2 m-0">
                    <div class="card shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center justify-content-lg-start position-relative">
                                <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Informações do processo
                                    seletivo</h3>
                                @foreach ($processosSeletivo as $processoSeletivo)
                                    <ul class="btn-yoodash">
                                        <li id="btn-opcoes">
                                            <div class="icon-opcoes">
                                                +
                                            </div>
                                            <ul class="menu-opcoes">
                                                @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH' || Auth::user()->acesso == 'RH')
                                                    <li id="btn-dashboard"
                                                        onclick="adicionarCandidatoAbrir({{ $processoSeletivo->processo_id }})">
                                                        <span>Adicionar Candidato</span>
                                                    </li>
                                                    <li id="btn-usuarios"
                                                        onclick="vincularCandidatoAbrir({{ $processoSeletivo->processo_id }})">
                                                        <span>Vincular Candidato</span>
                                                    </li>
                                                @endif
                                                <li id="btn-parecer"
                                                    onclick="adicionarParecerAbrir({{ $processoSeletivo->processo_id }})">
                                                    <span>Adicionar Parecer</span>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                    @include('layouts.recrutamento.partials.vincular-candidato')
                                    @include('layouts.recrutamento.partials.adicionar-candidato')
                                    @include('layouts.recrutamento.partials.adicionar-parecer')
                                    @include('layouts.recrutamento.partials.parecer-processo')
                                @endforeach

                            </div>
                        </div>
                        <div class="card-body bg-secondary position-relative">
                            <div class="col-12 pl-2 pr-2">
                                @foreach ($processosSeletivo as $processoSeletivo)
                                    <h4 class="card-title text-uppercase text-primary mb-0 font-weight-bold">
                                        #{{ $processoSeletivo->processo_id }} - {{ $processoSeletivo->processo_titulo }}
                                    </h4>
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Deadline:</span>
                                        {{ \Carbon\Carbon::parse($processoSeletivo->data_vencimento)->format('d/m/Y') }}
                                    </p>
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Departamento:</span>
                                        {{ $processoSeletivo->departamento_nome }}
                                    </p>
                                    <p class="mt-1 mb-0 text-sm nome-departamento">
                                        <span class="font-weight-bold text-default">Subdepartamento:</span>
                                        @if ($processoSeletivo->subdepartamento_id == 0)
                                            --
                                        @else
                                            {{ $processoSeletivo->subdepartamento_nome }}
                                        @endif
                                    </p>
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Nível:</span>
                                        {{ $processoSeletivo->nivel_de }} - {{ $processoSeletivo->nivel_para }}
                                    </p>
                                    @if ($processoSeletivo->seguranca)
                                        <p class="mt-1 mb-0 text-sm">
                                            <span class="font-weight-bold text-default">Segurança:</span>
                                            {{ $processoSeletivo->seguranca }}
                                        </p>
                                    @endif
                                    @if ($processoSeletivo->motivo)
                                        <p class="mt-1 mb-0 text-sm">
                                            <span class="font-weight-bold text-default">Motivo:</span>
                                            {{ $processoSeletivo->motivo }}
                                        </p>
                                    @endif
                                    @if ($processoSeletivo->salario_de >= 0 && $processoSeletivo->salario_ate)
                                        <p class="mt-1 mb-0 text-sm">
                                            <span class="font-weight-bold text-default">Range Salarial:</span><br>
                                            R$ {{ number_format($processoSeletivo->salario_de, 2, ',', '.') }} até
                                            R$ {{ number_format($processoSeletivo->salario_ate, 2, ',', '.') }}
                                        </p>
                                    @endif
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Solicitante:</span>
                                        <span class="solicitante">{{ $processoSeletivo->usuario_nome }}</span>
                                    </p>
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Recrutador:</span>
                                        {{ $processoSeletivo->nome_recrutador }}
                                    </p>
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Urgência:</span>

                                        @if ($processoSeletivo->prioridade == 'Crítico')
                                            <span
                                                class="bg-danger label-prioridade">{{ $processoSeletivo->prioridade }}</span>
                                        @elseif($processoSeletivo->prioridade == 'Alta')
                                            <span
                                                class="bg-warning label-prioridade">{{ $processoSeletivo->prioridade }}</span>
                                        @elseif($processoSeletivo->prioridade == 'Médio')
                                            <span
                                                class="bg-primary label-prioridade">{{ $processoSeletivo->prioridade }}</span>
                                        @elseif($processoSeletivo->prioridade == 'Baixa')
                                            <span
                                                class="bg-success label-prioridade">{{ $processoSeletivo->prioridade }}</span>
                                        @endif
                                    </p>
                                    <p class="mt-1 mb-0">
                                        <span class="bg-primary label-parecer"
                                            onclick="parecerAbrir({{ $processoSeletivo->processo_id }})">Ver Parecer (<span
                                                class="contagem-parecer-{{ $processoSeletivo->processo_id }}"></span>)</span>
                                    </p>
                                    <script>
                                        var parecer{{ $processoSeletivo->id }} = $('.parecer-{{ $processoSeletivo->id }}').length;
                                        document.querySelector('.contagem-parecer-{{ $processoSeletivo->processo_id }}').innerHTML =
                                            parecer{{ $processoSeletivo->id }};
                                    </script>
                                @endforeach
                            </div>
                            <div class="bg-primary avaliacoes">
                                <span class="font-weight-bold text-default">Avaliações Padrão:</span>
                                @for ($i = 0; $i < count($avaliacoes); $i++)
                                    @if ($avaliacoes[$i][0]['tipo'] == 'Padrão')
                                        <ul>
                                            <li>
                                                {{ $avaliacoes[$i][0]['nome'] }}
                                            </li>
                                        </ul>
                                    @endif
                                @endfor
                                <span class="font-weight-bold text-default">Avaliações Técnico:</span>
                                @for ($i = 0; $i < count($avaliacoes); $i++)
                                    @if ($avaliacoes[$i][0]['tipo'] == 'Técnico')
                                        <ul>
                                            <li>
                                                {{ $avaliacoes[$i][0]['nome'] }}
                                            </li>
                                        </ul>
                                    @endif
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="row col-12 mt-1 mt-mb-2 mb-1 mb-md-2 d-flex ml-0 mr-0 pl-0 pr-0 justify-content-center justify-content-md-end align-items-center align-items-md-end">
                <form method="get" class="col-12 mb-3 p-0 mb-md-0 col-md-4 col-lg-3 mr-0 mr-lg-3">
                    <input type="text" name="searchCandidato" id="searchCandidato" class="form-control"
                        placeholder="Pesquisar Candidato">
                </form>
            </div>
            <div class="status-container" style="overflow:auto;">
                @include('layouts.recrutamento.partials.status-candidatos')
            </div>
        </div>
    </div>

    <script>
        // PROGRAMACAO MODAL
        function adicionarCandidatoAbrir(id) {
            document.getElementById(`adicionar-candidato-modal-${id}`).classList.add(
                "modal-visivel");
        }

        function adicionarCandidatoFechar(id) {
            document.getElementById(`adicionar-candidato-modal-${id}`).classList.remove(
                "modal-visivel");
        }

        function vincularCandidatoAbrir(id) {
            document.getElementById(`vincular-candidato-modal-${id}`).classList.add(
                "modal-visivel");
        }

        function vincularCandidatoFechar(id) {
            document.getElementById(`vincular-candidato-modal-${id}`).classList.remove(
                "modal-visivel");
        }

        function adicionarParecerAbrir(id) {
            document.getElementById(`adicionar-parecer-modal-${id}`).classList.add(
                "modal-visivel");
        }

        function adicionarParecerFechar(id) {
            document.getElementById(`adicionar-parecer-modal-${id}`).classList.remove(
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
