<table class="table align-items-center table-flush" id="dataTableContratosInciar">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="logo">Logo</th>
            <th scope="col" class="sort" data-sort="status">Tempo pendente</th>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Contrato</th>
            <th scope="col" class="sort" data-sort="data">Contratos Totais</th>
            <th scope="col" class="sort" data-sort="data">Fee</th>
            <th scope="col" class="sort" data-sort="data_cadastro">Data de cadastro</th>
            <th scope="col" class="sort" data-sort="data_inicio">Kickoff</th>
            <th scope="col" class="sort" data-sort="ativar">Ação</th>
            <th scope="col" class="sort" data-sort="ativar">Detalhes</th>
            <th scope="col" class="sort" data-sort="alocar">Alocar contrato</th>
            <th scope="col" class="sort" data-sort="ativar">Editar</th>
            @if($infos_func[0]->acesso == "Master" || $infos_func[0]->acesso == "Qualidade")
                <th scope="col" class="sort" data-sort="ativar">Excluir</th>
            @endif
        </tr>
    </thead>
    <tbody class="list">

        @for ($i = 0; $i < count($contratos_pendentes); $i++)
            <tr>
                <td class="budget">
                    <span class="badge badge-dot mr-4">
                        <i class="bg-warning"></i>
                        <span class="status">Pendente</span>
                    </span>

                </td>
                <td>
                    <img class="tamanho-imagem" class="tamanho-imagem" src="{{ asset('storage/clientes/cliente'.$contratos_pendentes[$i]['cliente_id'].'.jpeg') }}" alt="Cliente sem logo"

                    onerror="this.src='{{ asset('storage/errors/imageNotFound.png') }}'; this.onerror = null">

                </td>
                <td>{{$contratos_pendentes[$i]['tempo_contrato']}}</td>

                <td class="budget">
                    {{ $contratos_pendentes[$i]['empresa'] }}
                </td>
                <td class="budget">{{ $contratos_pendentes[$i]['contrato'] }}</td>

                <td class="budget" style="text-align: center" title="<?php foreach($contratos_pendentes[$i]['alocados'] AS $alocado){ echo $contratos_pendentes[$i]['contrato'] . " -> " . $alocado->servico . "\n";} ?>">
                    <p class="icon-opcoes" style="font-weight: 100; cursor: pointer; text-align: center">
                        {{count($contratos_pendentes[$i]['alocados'])+1}}
                    </p>
                </td>

                @if ($contratos_pendentes[$i]['fee'])
                    <input type="hidden" name="fee" class="form-control mt-4" value="{{$contratos_pendentes[$i]['fee']}}" id="fee{{ $contratos_pendentes[$i]['contrato_id'] }}" placeholder="Fee do contrato">
                    <td class="budget "><p class="hidden-fee">R$ {{ number_format($contratos_pendentes[$i]['fee'], 2, ',', '.') }}</p><p class="display-fee">R$ *******</p></td>
                @else
                    <td class="budget">
                        <div class="form-group" style="width: 150px;">
                            <input type="text" name="fee" class="form-control mt-4" id="fee{{ $contratos_pendentes[$i]['contrato_id'] }}"
                                placeholder="Fee do contrato">
                        </div>
                    </td>
                @endif

                <td class="budget">{{ $contratos_pendentes[$i]['created_at']->format('d/m/Y') }}</td>

                @if ($contratos_pendentes[$i]['data_kickoff'])
                    <td class="budget">{{ $contratos_pendentes[$i]['data_kickoff']->format('d/m/Y') }}</td>
                @else
                    <td class="budget">
                        <div class="form-group">
                            <input type="date" name="datakickoff" class="form-control mt-4" id="datakickoff{{ $contratos_pendentes[$i]['contrato_id'] }}"
                                placeholder="__/__/____">
                        </div>
                    </td>
                @endif

                <td> <button
                        onclick="ativar_contrato({{ $contratos_pendentes[$i]['contrato_id'] }}, {{ $contratos_pendentes[$i]['fee'] }})"
                        class="btn btn-success ativar-button btn-circle btn-sm"><i class="fa-solid fa-circle-check"></i>
                        Ativar</button></td>
                        <td>
                            <button onclick="navegate_cliente({{ $contratos_pendentes[$i]['cliente_id'] }})"
                    class="btn btn-primary ativar-button btn-circle btn-sm">
                    <i class="fa-solid fa-circle-info"></i> Detalhes
                    </button>
                        </td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-primary ativar-button btn-circle btn-sm" onclick="abrir_modal_alocar_servico('{{ $contratos_pendentes[$i]['contrato'] }}', '{{ $contratos_pendentes[$i]['contrato_id'] }}', '{{json_encode($contratos_pendentes[$i]['possiveis_alocacoes'])}}')" id="btn-editar-contrato" class="btn btn-primary" title="Alocar serviço"><i
                                class="fa-solid fa-file-circle-plus"></i></button>
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary ativar-button btn-circle btn-sm" onclick="abrir_modal_editar('{{ $contratos_pendentes[$i]['contrato'] }}', '{{ $contratos_pendentes[$i]['contrato_id'] }}', false, 'pendente', 
                            '{{ date('d/m/Y', strtotime($contratos_pendentes[$i]['data_kickoff'])) }}', null, null, '{{$contratos_pendentes[$i]['fee']}}')" id="btn-editar-contrato" class="btn btn-primary" title="Editar contrato"><i
                                class="fa-solid fa-pen-to-square"></i></button>
                        </td>
                        @if($infos_func[0]->acesso == "Master" || $infos_func[0]->acesso == "Qualidade")
                        <td>
                            <button type="button" class="btn btn-danger ativar-button btn-circle btn-sm" onclick="abrir_modal_excluir('{{ $contratos_pendentes[$i]['contrato_id'] }}')" id="btn-excluir-contrato" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                        </td>
                        @endif
            </tr>
        @endfor

    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTableContratosInciar').DataTable({
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

<script>
    function ativar_contrato(contrato_id, fee) {
        const data_kickoff = document.getElementById(`datakickoff` + contrato_id).value;
        let fee_input = document.getElementById(`fee` + contrato_id).value;
        fee_input = fee_input.replace(".", "").replace(",", ".");

        if (data_kickoff) {
            if (fee) {
                let Data = new FormData();
                const token = document
                    .querySelector(`input[name="_token"]`)
                    .value;
                Data.append('data_kickoff', data_kickoff);
                Data.append('_token', token);

                const url = `/contrato/${contrato_id}/ativar`;
                fetch(url, {
                    method: 'POST',
                    body: Data
                }).then(() => {
                    alert("Contrato ativado com sucesso");
                    window.location.href = "/net-contratos";
                });

            } else if (fee_input) {

                let Data = new FormData();
                const token = document
                    .querySelector(`input[name="_token"]`)
                    .value;
                Data.append('data_kickoff', data_kickoff);
                Data.append('fee', fee_input);
                Data.append('_token', token);

                const url = `/contrato/${contrato_id}/ativar`;

                fetch(url, {
                    method: 'POST',
                    body: Data
                }).then(() => {
                    alert("Contrato ativado com sucesso");
                    window.location.href = "/net-contratos";
                });
            } else {
                alert('Por favor, inserir o valor do Fee');
            }
        } else {
            console.log(data_kickoff);
            alert('Por favor, inserir a Data do Kickoff');
        }


    }

    $(document).ready(function() {
        $('#fee').mask('000.000.000.000.000,00', {
            reverse: true
        });
    });
    $("#fee").focusout(function() {
        if ($(this).val().length <= 2) {
            temp = $(this).val()
            var newNum = temp + ",00"
            $(this).val(newNum)
        }
    })
</script>
