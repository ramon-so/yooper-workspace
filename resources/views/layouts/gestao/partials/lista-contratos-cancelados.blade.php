<table class="table align-items-center table-flush" id="dataTableContratosCancelados">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="logo">Logo</th>
            <td scope="col" class="sort" data-sort="status">Tempo de contrato</td>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Contrato</th>
            <th scope="col" class="sort" data-sort="data">Contratos Totais</th>
            <th scope="col" class="sort" data-sort="data">Fee</th>
            <th scope="col" class="sort" data-sort="data_cadastro">Data de cadastro</th>
            <th scope="col" class="sort" data-sort="data_inicio">Kickoff</th>
            <th scope="col" class="sort" data-sort="data_cancelamento">Solicitação cancelamento</th>
            <th scope="col" class="sort" data-sort="data_ultimo_dia">Último dia de contrato</th>
            <th scope="col" class="sort" data-sort="acessar">Detalhes</th>
            <th scope="col" class="sort" data-sort="acessar">Editar</th>
            @if($infos_func[0]->acesso == "Master" || $infos_func[0]->acesso == "Qualidade")
                <th scope="col" class="sort" data-sort="ativar">Excluir</th>
            @endif
        </tr>
    </thead>
    <tbody class="list">
        @for ($i = 0; $i < count($contratos_cancelados); $i++)
            <tr>
                <td class="budget">
                    <span class="badge badge-dot mr-4">
                        <i class="bg-danger"></i>
                        <span class="status">Cancelado</span>
                    </span>
                </td>
                <td>
                    <img class="tamanho-imagem" src="{{ asset('storage/clientes/cliente'.$contratos_cancelados[$i]['cliente_id'].'.jpeg') }}" alt="Logo não encontrada"
                    onerror="this.src='{{ asset('storage/errors/imageNotFound.png') }}'; this.onerror = null">
                </td>
                <td>{{$contratos_cancelados[$i]['tempo_contrato']}}</td>

                <td class="budget">
                    {{ $contratos_cancelados[$i]['empresa'] }}
                </td>

                <td class="budget">{{ $contratos_cancelados[$i]['contrato'] }}</td>

                <td class="budget" style="text-align: center" title="<?php foreach($contratos_cancelados[$i]['alocados'] AS $alocado){ echo $contratos_cancelados[$i]['contrato'] . " -> " . $alocado->servico . "\n";} ?>">
                    <p class="icon-opcoes" style="font-weight: 100; cursor: pointer; text-align: center">
                        {{count($contratos_cancelados[$i]['alocados'])+1}}
                    </p>
                </td>

                <td class="budget "><p class="hidden-fee">R$ {{ number_format($contratos_cancelados[$i]['fee'], 2, ',', '.') }}</p><p class="display-fee">R$ *******</p></td>


                <td class="budget">{{ $contratos_cancelados[$i]['created_at']->format('d/m/Y') }}</td>

                <td class="budget">{{ date('d/m/Y', strtotime($contratos_cancelados[$i]['data_kickoff'])) }}</td>

                @if ($contratos_cancelados[$i]['data_solicitacao_cancelamento'])
                    <td class="budget">
                        {{ date('d/m/Y', strtotime($contratos_cancelados[$i]['data_solicitacao_cancelamento'])) }}</td>
                @else
                    <td class="budget">-</td>
                @endif

                @if ($contratos_cancelados[$i]['data_ultimo_dia'])
                    <td class="budget">{{ date('d/m/Y', strtotime($contratos_cancelados[$i]['data_ultimo_dia'])) }}</td>
                @else
                    <td class="budget">-</td><i
                            class="fa-solid fa-pen-to-square"></i>
                @endif
                <td class="budget">
                    <button onclick="navegate_cliente({{ $contratos_cancelados[$i]['cliente_id'] }})"
                    class="btn btn-primary ativar-button btn-circle btn-sm">
                        Detalhes
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary ativar-button btn-circle btn-sm" onclick="abrir_modal_editar('{{ $contratos_cancelados[$i]['contrato'] }}', '{{ $contratos_cancelados[$i]['contrato_id'] }}', false, 'cancelado', 
                    '{{ date('d/m/Y', strtotime($contratos_cancelados[$i]['data_kickoff'])) }}', '{{ date('d/m/Y', strtotime($contratos_cancelados[$i]['data_solicitacao_cancelamento'])) }}',
                    '{{ date('d/m/Y', strtotime($contratos_cancelados[$i]['data_ultimo_dia'])) }}', '{{$contratos_cancelados[$i]['fee']}}')" id="btn-editar-contrato" class="btn btn-primary" title="Editar contrato"><i
                        class="fa-solid fa-pen-to-square"></i></button>
                </td>
                @if($infos_func[0]->acesso == "Master" || $infos_func[0]->acesso == "Qualidade")
                    <td>
                        <button type="button" class="btn btn-danger ativar-button btn-circle btn-sm" onclick="abrir_modal_excluir('{{ $contratos_cancelados[$i]['contrato_id'] }}')" id="btn-excluir-contrato" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                    </td>
                @endif
            </tr>
        @endfor
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTableContratosCancelados').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ contratos por página",
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum resultado encontrado",
                "infoFiltered": "(Filtrado from _MAX_ total de contratos)",
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "paging": true,
            "bSort": true,
            'pagingType': 'full',
        });
    });
</script>
