@foreach ($listaSt as $st)
    <div class="coluna-processo p-0">
        <div class="card shadow">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-lg-start titulo-coluna">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left" style="font-size: 16px !important;">
                        {{ $st->nome }}
                    </h3>
                    <div class="qnt-processos bg-primary contagem">
                        <span class="contagem-{{ $st->id }}"></span>
                    </div>
                </div>
            </div>
            <div class="card-body bg-secondary pl-3 pr-3">
                @foreach ($processosSeletivo as $processoSeletivo)
                    @if ($processoSeletivo->status_id == $st->id)
                        <div class="card bg-white card-{{ $st->id }} pt-3 pb-3 pl-4 pr-4 card-processo recrutador-{{ $processoSeletivo->recrutador_funcionario_id }}"
                            id="card-{{ $processoSeletivo->id }}">

                            {{-- @include('layouts.recrutamento.partials.editar-processo') --}}
                            @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH')
                                <div class="editar-processo bg-danger"
                                    onclick="processoEditarAbrir({{ $processoSeletivo->id }})" data-toogle="tooltip"
                                    data-placement="top" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </div>
                                @if ($processoSeletivo->status_id != 5)
                                    <div class="finalizar-processo bg-primary"
                                        onclick="processoFechamento({{ $processoSeletivo->id }})" data-toogle="tooltip"
                                        data-placement="top" title="Finalizar Processo">
                                        <i class="fa-solid fa-flag-checkered"></i>
                                    </div>
                                @endif
                            @endif
                            <div class="aprovar-candidato bg-success" data-toogle="tooltip" data-placement="top"
                                onclick="processoAprovarAbrir({{ $processoSeletivo->id }})" title="Aprovar">
                                <i class="fa-solid fa-check"></i>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <a href="/processo-seletivo/{{ $processoSeletivo->id }}" class="nome-link">
                                        <h4 class="card-title text-uppercase text-primary mb-0 font-weight-bold">
                                            #{{ $processoSeletivo->id }} -
                                            {{ $processoSeletivo->titulo }}</h4>
                                    </a>
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Data solicitação:</span>
                                        {{ $processoSeletivo->created_at->format('d/m/Y') }}
                                    </p>
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Deadline:</span>
                                        {{ \Carbon\Carbon::parse($processoSeletivo->data_vencimento)->format('d/m/Y') }}
                                    </p>
                                    <p class="mt-1 mb-0 text-sm nome-departamento">
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
                                        {{ $processoSeletivo->nivel_de }} -
                                        {{ $processoSeletivo->nivel_para }}
                                    </p>
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
                                    <p class="mt-1 mb-0 text-sm nome-recrutador">
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

                                    @if ($processoSeletivo->salario_de >= 0 && $processoSeletivo->salario_ate)
                                        <p class="mt-1 mb-0 text-sm">
                                            <span class="font-weight-bold text-default">Status de Fechamento:</span><br>

                                            @if ($processoSeletivo->status_fechamento === 'Fechada Antes do Prazo')
                                                <span
                                                    class="bg-success label-prioridade">{{ $processoSeletivo->status_fechamento }}</span>
                                            @elseif($processoSeletivo->status_fechamento === 'Fechada no Prazo')
                                                <span
                                                    class="bg-primary label-prioridade">{{ $processoSeletivo->status_fechamento }}</span>
                                            @elseif($processoSeletivo->status_fechamento === 'Fechada depois do Prazo')
                                                <span
                                                    class="bg-danger label-prioridade">{{ $processoSeletivo->status_fechamento }}</span>
                                            @else
                                                <span
                                                    class="bg-warning label-prioridade">{{ $processoSeletivo->status_fechamento }}</span>
                                            @endif
                                        </p>
                                    @endif

                                    @if ($processoSeletivo->data_fechamento)
                                    <p class="mt-1 mb-0 text-sm">
                                        <span class="font-weight-bold text-default">Conclusão:</span>
                                        {{  Carbon\Carbon::parse($processoSeletivo->data_fechamento)->format('d/m/Y') }}
                                    </p>
                                @endif

                                    
                                    @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH')
                                        <div class="solicitacoes-cadastradas-modal"
                                            id="editar-modal-{{ $processoSeletivo->id }}">
                                            <div class="col-lg-5 solicitacao-processo-seletivo-box">
                                                <img src="{{ asset('assets') }}/img/icons/close.webp"
                                                    class="close-modal" id="close-modal-{{ $processoSeletivo->id }}"
                                                    onclick="processoEditarFechar({{ $processoSeletivo->id }})">
                                                <div class="card shadow col-12 p-0 m-0">
                                                    <div class="card-header bg-white border-0">
                                                        <div
                                                            class="row align-items-center justify-content-center justify-content-lg-start">
                                                            <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar
                                                                processo
                                                                seletivo</h4>
                                                        </div>
                                                    </div>
                                                    <div class="card-body bg-secondary">

                                                        @include('layouts.recrutamento.partials.editar-processos-seletivos')

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="solicitacoes-cadastradas-modal"
                                        id="aprovar-modal-{{ $processoSeletivo->id }}">
                                        <div class="col-lg-5 solicitacao-processo-seletivo-box">
                                            <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal"
                                                id="close-modal-{{ $processoSeletivo->id }}"
                                                onclick="processoAprovarFechar({{ $processoSeletivo->id }})">
                                            <div class="card shadow col-12 p-0 m-0">
                                                <div class="card-header bg-white border-0">
                                                    <div
                                                        class="row align-items-center justify-content-center justify-content-lg-start">
                                                        <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Aprovar
                                                            candidato</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-secondary">

                                                    @include('layouts.recrutamento.partials.aprovar-processos-seletivos')

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="solicitacoes-cadastradas-modal"
                                        id="fechamento-modal-{{ $processoSeletivo->id }}">
                                        <div class="col-lg-5 solicitacao-processo-seletivo-box">
                                            <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal"
                                                id="close-modal-{{ $processoSeletivo->id }}"
                                                onclick="processoFechamentoClose({{ $processoSeletivo->id }})">
                                            <div class="card shadow col-12 p-0 m-0">
                                                <div class="card-header bg-white border-0">
                                                    <div
                                                        class="row align-items-center justify-content-center justify-content-lg-start">
                                                        <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Fechamento
                                                            da vaga</h4>
                                                    </div>
                                                </div>
                                                <div class="card-body bg-secondary">

                                                    @include('layouts.recrutamento.partials.fechamento-processos-seletivos')

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <script>
                                        // PROGRAMACAO MODAL
                                        function processoEditarAbrir(id) {
                                            document.getElementById(`editar-modal-${id}`).classList.add(
                                                "modal-visivel");
                                        }

                                        function processoEditarFechar(id) {
                                            document.getElementById(`editar-modal-${id}`).classList.remove(
                                                "modal-visivel");
                                        }

                                        function processoAprovarAbrir(id) {
                                            document.getElementById(`aprovar-modal-${id}`).classList.add(
                                                "modal-visivel");
                                        }

                                        function processoAprovarFechar(id) {
                                            document.getElementById(`aprovar-modal-${id}`).classList.remove(
                                                "modal-visivel");
                                        }

                                        function processoFechamento(id) {
                                            document.getElementById(`fechamento-modal-${id}`).classList.add(
                                                "modal-visivel");
                                        }

                                        function processoFechamentoClose(id) {
                                            document.getElementById(`fechamento-modal-${id}`).classList.remove(
                                                "modal-visivel");
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <script>
        var cards{{ $st->id }} = $('.card-{{ $st->id }}').length;
        document.querySelector('.contagem-{{ $st->id }}').innerHTML = cards{{ $st->id }};
    </script>
@endforeach
