<div class="col-12 pl-1 pr-1">
    <div class="card shadow">
        <div class="card-header bg-white border-0 mt-2">
            <h3 class="mb-0 text-center text-lg-left mb-4">
                Contratos Ativos
            </h3>
            <div class="row align-items-center justify-content-center justify-content-lg-start">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        @foreach ($contratos_ativos as $contrato)
                            <?php $subcontratos = explode(',', $contrato->contrato_alocado); ?>
                            @if ($servico != null)
                                @if ($servico == $contrato->servico_nome)
                                    <?php $active = 'active'; ?>
                                @else
                                    <?php $active = ''; ?>
                                @endif
                            @elseif($loop->first)
                                <?php $active = 'active'; ?>
                            @else
                                <?php $active = ''; ?>
                            @endif

                            @if (
                                $infos_func[0]->departamento == $contrato->servico_nome ||
                                    $infos_func[0]->acesso == 'Master' ||
                                    $infos_func[0]->acesso == 'Head' ||
                                    $infos_func[0]->acesso == 'Financeiro')
                                <button class="nav-link {{ $active }} " id="nav-{{ $contrato->servico_nome }}-tab"
                                    data-bs-toggle="tab" data-bs-target="#nav-{{ $contrato->servico_nome.$contrato->contrato_id }}"
                                    type="button" role="tab" aria-controls="nav-{{ $contrato->servico_nome.$contrato->contrato_id }}"
                                    aria-selected="true">


                                    @if ($contrato->status == 'Cancelado')
                                        <span class="badge badge-dot mr-4 mb-2"
                                            style="margin: 0 auto;
                                        display: contents;">
                                            <i class="bg-danger"></i>
                                        </span>
                                        {{ $contrato->servico_nome }}
                                    @elseif($contrato->status == 'Ativo')
                                        <span class="badge badge-dot mr-4 mb-2"
                                            style="margin: 0 auto;
                                        display: contents;">
                                            <i class="bg-success"></i>
                                        </span>
                                        {{ $contrato->servico_nome }}
                                    @else
                                        <span class="badge badge-dot mr-4 mb-2"
                                            style="margin: 0 auto;
                                        display: contents;">
                                            <i class="bg-warning"></i>
                                        </span>
                                        {{ $contrato->servico_nome }}
                                    @endif


                                    <span class="bg-primary contagem ml-2">
                                        <?= $contrato->contrato_alocado != null ? count($subcontratos) + 1 : '1' ?>
                                    </span>
                                </button>
                            @endif
                        @endforeach
                        @if ($infos_func[0]->acesso == 'Master' || $infos_func[0]->acesso == 'Head' || $infos_func[0]->acesso == 'Financeiro')
                            <button class="nav-link " id="nav-fee-tab" data-bs-toggle="tab" data-bs-target="#nav-fee"
                                type="button" role="tab" aria-controls="nav-fee"
                                aria-selected="true">Financeiro</button>
                        @endif
                        @if ($contrato->projetos)
                            <button class="nav-link " id="nav-projetos-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-projetos" type="button" role="tab" aria-controls="nav-fee"
                                aria-selected="true">Projetos</button>
                        @endif
                        @if (str_contains(strtolower($contrato->contrato_alocado), 'criação') ||
                                str_contains(strtolower($contrato->contrato_alocado), 'criacao'))
                            <button class="nav-link " id="nav-criacao-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-criacao" type="button" role="tab" aria-controls="nav-fee"
                                aria-selected="true">Criação</button>
                        @endif
                    </div>
                </nav>
            </div>
        </div>

        <div class="card-body bg-secondary pl-0 pr-0 pl-lg-4 pr-lg-4">
            <div class="tab-content" id="nav-tabContent">
                @foreach ($contratos_ativos as $contrato)
                    @if ($servico != null)
                        @if ($servico == $contrato->servico_nome)
                            <?php $active = 'active'; ?>
                        @else
                            <?php $active = ''; ?>
                        @endif
                    @elseif($loop->first)
                        <?php $active = 'active'; ?>
                    @else
                        <?php $active = ''; ?>
                    @endif
                    <div class="tab-pane fade show {{ $active }}" id="nav-{{ $contrato->servico_nome.$contrato->contrato_id }}"
                        role="tabpanel" aria-labelledby="nav-{{ $contrato->servico_nome }}-tab">
                        <button type="button" style="float: right; width: fit-content"
                            onclick="abrir_modal_editar('{{ $contrato->servico_nome }}', '{{ $contrato->contrato_id }}', '{{ $contrato->fee }}')"
                            id="btn-editar-contrato" class="btn btn-primary"><i
                                class="fa-solid fa-pen-to-square"></i></button>
                        <h3 class="mb-0">Responsáveis:</h3>
                        <div class="row ml-1 mt-3">
                            @if (count($contrato['responsaveis']) > 0)
                                @foreach ($contrato['responsaveis'] as $responsavel)
                                    <p>{{ $responsavel->nome }}</p>
                                @endforeach
                            @else
                                <p>Não há responsáveis vinculados</p>
                            @endif
                            {{-- <div class="col-1 ml-1 foto-solicitante" data-toggle="tooltip" data-placement="top"
                                title="{{$responsavel->nome}}">
                                <p>{{$responsavel->nome}}</p>
                            </div> --}}

                        </div>

                        <br>
                        <h3 class="mb-0">Informações de Contrato:</h3>
                        <span class="badge badge-dot mr-4 mb-2">
                            @if ($contrato->status == 'Cancelado')
                                <i class="bg-danger"></i>
                                <span class="status">{{ $contrato->status }}</span>
                            @elseif($contrato->status == 'Ativo')
                                <i class="bg-success"></i>
                                <span class="status">{{ $contrato->status }}</span>
                            @else
                                <i class="bg-warning"></i>
                                <span class="status">{{ $contrato->status }}</span>
                            @endif
                        </span>
                        </br>
                        <p class="mb-1">Kickoff:
                            <b>{{ $contrato->data_kickoff ? date('d/m/Y', strtotime($contrato->data_kickoff)) : 'Kickoff não realizado' }}
                            </b>
                        </p>

                        @if ($contrato->data_ultimo_dia)
                            <p class="mb-1">Data último dia:
                                <b>{{ $contrato->data_ultimo_dia ? date('d/m/Y', strtotime($contrato->data_ultimo_dia)) : 'Erro data último dia' }}
                                </b>
                            </p>
                        @endif

                        <p class="mb-1">Tempo de contrato:
                            <b>{{ $contrato->data_kickoff ? $contrato['tempo_contrato'] : 'Kickoff não realizado' }}
                            </b>
                        </p>
                        @if ($contrato->servico_nome == 'CRM')
                            @if ($contrato->ferramentas_crm)
                                <p class="mb-1">Ferramentas de CRM: {{ $contrato->ferramentas_crm }}</p>
                            @endif
                            @if ($contrato->disparos_semana_crm)
                                <p class="mb-1">Disparos por semana: {{ $contrato->disparos_semana_crm }}</p>
                            @endif
                            @if ($contrato->disparos_semana_crm)
                                <p class="mb-1">Disparos por mês: {{ $contrato->disparos_semana_crm * 4 }}</p>
                            @endif
                        @endif

                        @if ($contrato->servico_nome == 'BLOG')
                            @if ($contrato->conteudos_mes_blog)
                                <p class="mb-1">Conteúdos do mês: {{ $contrato->conteudos_mes_blog }}</p>
                            @endif
                            @if ($contrato->link_conteudos_blog)
                                <p class="mb-1"><a href="{{ $contrato->link_conteudos_blog }}" target="_BLANK">Banco
                                        de
                                        Pautas</a></p>
                            @endif
                        @endif

                        @if ($contrato->servico_nome == 'SEO')
                            @if ($contrato->desenvolvimento_seo)
                                <p class="mb-1">Desenvolvimento: {{ $contrato->desenvolvimento_seo }}</p>
                            @endif
                            @if ($contrato->conteudos_mes_seo)
                                <p class="mb-1">Conteúdos por mês: {{ $contrato->conteudos_mes_seo }}</p>
                            @endif
                            @if ($contrato->conteudos_blog_seo)
                                <p class="mb-1">Conteúdos blog: {{ $contrato->conteudos_blog_seo }}</p>
                            @endif
                            @if ($contrato->total_conteudos_seo)
                                <p class="mb-1">Total de conteúdos: {{ $contrato->total_conteudos_seo }}</p>
                            @endif
                            @if ($contrato->implementacao_seo)
                                <p class="mb-1">Implementação: {{ $contrato->implementacao_seo }}</p>
                            @endif
                        @endif

                        @if ($contrato->servico_nome == 'INFLUENCERS')
                            @if ($contrato->tipo_contrato_influenciadores)
                                <p class="mb-1">Tipo de contrato: {{ $contrato->tipo_contrato_influenciadores }}</p>
                            @endif
                            @if ($contrato->escopo_influeniadores)
                                <p class="mb-1">Influenciados no Escopo: {{ $contrato->escopo_influeniadores }}</p>
                            @endif
                        @endif

                        @if ($contrato->servico_nome == 'SOCIAL')
                            @if ($contrato->gerenciamento_redes_sociais_social)
                                <p class="mb-1">Gerenciamento das redes sociais:
                                    {{ $contrato->gerenciamento_redes_sociais_social }}
                                </p>
                            @endif
                            @if ($contrato->posts_semana_social)
                                <p class="mb-1">Quantidade de posts por semana: {{ $contrato->posts_semana_social }}
                                </p>
                            @endif
                            @if ($contrato->posts_semana_social)
                                <p class="mb-1">Quantidade de posts por mês: {{ $contrato->posts_semana_social * 4 }}
                                </p>
                            @endif
                            @if ($contrato->budget_impulsionamento_social)
                                <p class="mb-1">Budget de impulsionamento:
                                    {{ $contrato->budget_impulsionamento_social }}
                                </p>
                            @endif
                        @endif

                        @if ($contrato->servico_nome == 'MÍDIA')
                            @if ($contrato->xml_midia)
                                <p class="mb-1">XML: <a href="{{ $contrato->xml_midia }}"
                                        target="_BLANK">{{ $contrato->xml_midia }}</a></p>
                            @endif
                            @if ($contrato->canais_ativos_midia)
                                <p class="mb-1">Canais ativos: {{ $contrato->canais_ativos_midia }}</p>
                            @endif
                            @if ($contrato->faixa_investimento_midia)
                                <p class="mb-1">Faixa de investimento: {{ $contrato->faixa_investimento_midia }}</p>
                            @endif
                            @if ($contrato->forma_pagamento_midia)
                                <p class="mb-1">Forma de pagamento: {{ $contrato->forma_pagamento_midia }}</p>
                            @endif
                        @endif

                        <h3 class="mb-0">Contratos Alocados:</h3>
                        @if ($contrato->contrato_alocado != null)
                            <?php $subcontratos = explode(',', $contrato->contrato_alocado); ?>
                            @foreach ($subcontratos as $sub)
                                <span>{{ $contrato->servico_nome }}<i
                                        class="fa-solid fa-arrow-right mx-2"></i>{{ $sub }}</span></br>
                            @endforeach
                        @else
                            <span>Não há contratos alocados</span>
                        @endif

                        </p>

                        @if ($contrato->briefing != null)
                            <p class="mb-1"> Briefing: <b><a
                                        href="{{ asset('storage/'.$contrato->briefing) }}"
                                        download>Acessar briefing</a></b></p>
                        @else
                            <p class="mb-1"> Briefing não cadastrado <button
                                    onclick="abrir_modal_briefing('<?php echo $contrato->contrato_id; ?>')"
                                    class="btn btn-primary btn-sm">+ Briefing</button></p>
                        @endif
                        @if ($contrato->escopo != null)
                            <p class="mb-1"> Escopo: <b><a
                                        href="{{ asset('storage/'.$contrato->escopo) }}"
                                        download>Acessar
                                        escopo</a></b></p>
                        @else
                            <p class="mb-1"> Escopo não cadastrado <button
                                    onclick="abrir_modal_escopo('<?php echo $contrato->contrato_id; ?>')"
                                    class="btn btn-primary btn-sm">+ Escopo</button></p>
                        @endif
                        <br>
                        @if ($contrato->servico_nome == 'CRM')
                            <h3>Acessos das ferramentas: <button type="button"
                                    class="btn btn-primary ativar-button btn-circle btn-sm"
                                    onclick="abrir_modal_ferramenta({{ $contrato->contrato_id }}, {{ $cliente->id }})"
                                    id="btn-excluir-contrato" title="Adicionar ferramenta" class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i></button></h3>
                            <table class="table">
                                <thead>
                                    <th>Plataforma</th>
                                    <th>Acesso</th>
                                    <th>Senha</th>
                                </thead>
                                <tbody>
                                    @foreach ($contrato->acessos as $acesso)
                                        <tr>
                                            <td>{{ $acesso->plataforma }}</td>
                                            <td>{{ $acesso->acesso_login }}</td>
                                            <td>{{ $acesso->acesso_senha }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if ($contrato->servico_nome == 'BLOG')
                            <h4>Acessos dos blogs: <button type="button"
                                    class="btn btn-primary ativar-button btn-circle btn-sm"
                                    onclick="abrir_modal_ferramenta_social({{ $contrato->contrato_id }}, {{ $cliente->id }})"
                                    id="btn-excluir-contrato" title="Adicionar ferramenta" class="btn btn-primary"><i
                                        class="fa-solid fa-plus"></i></button></h4>
                            <table class="table">
                                <thead>
                                    <th>Plataforma</th>
                                    <th>Acesso</th>
                                    <th>Senha</th>
                                </thead>
                                <tbody>
                                    @foreach ($contrato->acessos as $acesso)
                                        <tr>
                                            <td>{{ $acesso->plataforma }}</td>
                                            <td>{{ $acesso->acesso_login }}</td>
                                            <td>{{ $acesso->acesso_senha }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if ($contrato->servico_nome == 'SEO')
                            <h4>Acessos dos blogs: </h4>
                            <table class="table">
                                <thead>
                                    <th>Plataforma</th>
                                    <th>Acesso</th>
                                    <th>Senha</th>
                                </thead>
                                <tbody>
                                    @foreach ($contrato->acessos as $acesso)
                                        <tr>
                                            <td>{{ $acesso->plataforma }}</td>
                                            <td>{{ $acesso->acesso_login }}</td>
                                            <td>{{ $acesso->acesso_senha }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                        @if ($contrato->servico_nome == 'DEV')
                        @endif
                        @if ($contrato->servico_nome == 'SOCIAL')
                            <h4>Acessos das redes sociais: <h4>Acessos das ferramentas: <button type="button"
                                        class="btn btn-primary ativar-button btn-circle btn-sm"
                                        onclick="abrir_modal_ferramenta_social({{ $contrato->contrato_id }}, {{ $cliente->id }})"
                                        id="btn-excluir-contrato" title="Adicionar ferramenta"
                                        class="btn btn-primary"><i class="fa-solid fa-plus"></i></button></h4>
                            </h4>
                            <table class="table">
                                <thead>
                                    <th>Plataforma</th>
                                    <th>Acesso</th>
                                    <th>Senha</th>
                                </thead>
                                <tbody>
                                    @foreach ($contrato->acessos as $acesso)
                                        <tr>
                                            <td>{{ $acesso->plataforma }}</td>
                                            <td>{{ $acesso->acesso_login }}</td>
                                            <td>{{ $acesso->acesso_senha }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        @if ($contrato->servico_nome == 'MÍDIA')
                            <h4>Acessos das plataformas: </h4>
                            <table class="table">
                                <thead>
                                    <th>Plataforma</th>
                                    <th>Acesso</th>
                                    <th>Senha</th>
                                </thead>
                                <tbody>
                                    @foreach ($contrato->acessos as $acesso)
                                        <tr>
                                            <td>{{ $acesso->plataforma }}</td>
                                            <td>{{ $acesso->acesso_login }}</td>
                                            <td>{{ $acesso->acesso_senha }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                @endforeach
                <div class="tab-pane fade show" id="nav-fee" role="tabpanel" aria-labelledby="nav-fee-tab">
                    <p>Contratos</p>
                    <table class="table">
                        <thead>
                            <th>Serviço</th>
                            <th>FEE</th>
                            <th>Data do Kickoff</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php $fee = 0; ?>
                            @foreach ($contratos_ativos as $contrato)
                                @if ($contrato->status != 'Cancelado')
                                    <tr>
                                        <td>{{ $contrato->servico_nome }}</td>
                                        <td>R$ {{ number_format($contrato->fee, 2, ',', '.') }}</td>
                                        <td>{{ $contrato->data_kickoff ? date('d/m/Y', strtotime($contrato->data_kickoff)) : 'Kickoff não realizado' }}
                                        </td>
                                        <td>{{ $contrato->status }}</td>
                                    </tr>
                                    <?php $fee += $contrato->fee; ?>
                                @endif
                            @endforeach
                            <tr>
                                <td><b>Total </b></td>
                                <td><b>R$ {{ number_format($fee, 2, ',', '.') }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <p>Contratos Cancelados</p>
                    <table class="table">
                        <thead>
                            <th>Serviço</th>
                            <th>FEE</th>
                            <th>Data último dia</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            <?php $fee = 0; ?>
                            @foreach ($contratos_ativos as $contrato)
                                @if ($contrato->status == 'Cancelado')
                                    <tr>
                                        <td>{{ $contrato->servico_nome }}</td>
                                        <td>R$ {{ number_format($contrato->fee, 2, ',', '.') }}</td>
                                        <td>{{ $contrato->data_ultimo_dia }}</td>
                                        <td>{{ $contrato->status }}</td>
                                    </tr>
                                    <?php $fee += $contrato->fee; ?>
                                @endif
                            @endforeach
                            <tr>
                                <td><b>Total </b></td>
                                <td><b>R$ {{ number_format($fee, 2, ',', '.') }}</b></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <p>Tabela financeira</p>
                    <div class="container mt-1">
                        <div class="row">
                            <div class="col-sm-12 pt-1">

                                <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                                    data-target="#modal-tabela-financeira">
                                    Alterar tabelas
                                </button>
                                <img src="{{ asset('storage/tabelas_financeiras/tabela_cliente'.$cliente->id.'.jpeg') }}"
                                    class="img-fluid mx-auto d-block" alt="Tabela escalonada"
                                    style="width: 600px; float: left"
                                    onerror="this.src='{{ asset('storage/errors/imageNotFound.png') }}'; this.alt='Não existe nenhuma tabela de Fee escalonado nesse contrato'; this.onerror = null">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function abrir_modal_escopo(id) {
        document.getElementById('escopo_id_briefing').value = id;
        document.getElementById('modal-adicionar-escopo').classList.add(
            "modal-visivel");
    }

    function abrir_modal_briefing(id) {
        document.getElementById('contrato_id_briefing').value = id;
        document.getElementById('modal-adicionar-briefing').classList.add(
            "modal-visivel");
    }
    function fechar_modal_escopo() {
        document.getElementById('modal-adicionar-escopo').classList.remove(
            "modal-visivel");
    }

    function fechar_modal_briefing() {
        document.getElementById('modal-adicionar-briefing').classList.remove(
            "modal-visivel");
    }
</script>


<style>
    .contagem {
        padding: 4px 10px;
        border-radius: 15px;
        color: #FFF;
    }

    .ferramentas-box {
        background-color: #FFF;
    }

    .ferramentas-box a {
        border: 1px solid #5e72e4;
    }
</style>
