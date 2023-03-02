<table class="table align-items-center table-flush" id="dataTableContratosAtivos">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="logo">Logo</th>
            <th scope="col" class="sort" data-sort="status">Tempo de contrato</th>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Contrato</th>
            <th scope="col" class="sort" data-sort="data">Contratos Totais</th>
            <th scope="col" class="sort" data-sort="escopo">Fee</th>
            <th scope="col" class="sort" data-sort="data_cadastro">Data de cadastro</th>
            <th scope="col" class="sort" data-sort="data_inicio">Kickoff</th>
            <th scope="col" class="sort" data-sort="data_cancelamento">Solicitação cancelamento</th>
            <th scope="col" class="sort" data-sort="data_ultimo_dia">Último dia de contrato</th>
            <th scope="col" class="sort" data-sort="ativar">Cancelar</th>
            <th scope="col" class="sort" data-sort="detalhes">Detalhes</th>
            <th scope="col" class="sort" data-sort="alocar">Alocar contrato</th>
            <th scope="col" class="sort" data-sort="editar">Editar</th>
            @if($infos_func[0]->acesso == "Master" || $infos_func[0]->acesso == "Qualidade")
                <th scope="col" class="sort" data-sort="ativar">Excluir</th>
            @endif
        </tr>
    </thead>
    <tbody class="list">
        @for ($i = 0; $i < count($contratos_ativos); $i++)
            <tr>
                <td class="budget">
                    <span class="badge badge-dot mr-4">
                        <i class="bg-success"></i>
                        <span class="status">Ativo</span>
                    </span>
                </td>
                <td>
                    <img class="tamanho-imagem" src="./../app/storage/app/app/public/clientes/cliente<?php echo $contratos_ativos[$i]['cliente_id'] ?>.jpeg" alt="Logo não encontrada"

                    onerror="this.src='./../app/storage/app/app/public/errors/imageNotFound.png'; this.onerror = null">

                </td>
                <td>{{ $contratos_ativos[$i]['tempo_contrato'] }}</td>

                <td class="budget">
                    {{ $contratos_ativos[$i]['empresa'] }}
                </td>

                <td class="budget">{{ $contratos_ativos[$i]['contrato'] }}</td>

                <td class="budget" style="text-align: center" title="<?php foreach ($contratos_ativos[$i]['alocados'] as $alocado) {
                    echo $contratos_ativos[$i]['contrato'] . ' -> ' . $alocado->servico . "\n";
                } ?>">
                    <p class="icon-opcoes" style="font-weight: 100; cursor: pointer; text-align: center">
                        {{ count($contratos_ativos[$i]['alocados']) + 1 }}
                    </p>
                </td>

                <td class="budget "><p class="hidden-fee">R$ {{ number_format($contratos_ativos[$i]['fee'], 2, ',', '.') }}</p><p class="display-fee">R$ *******</p></td>



                <td class="budget">{{ date('d/m/Y', strtotime($contratos_ativos[$i]['created_at'])) }}</td>

                <td class="budget">{{ date('d/m/Y', strtotime($contratos_ativos[$i]['data_kickoff'])) }}</td>


                <td class="budget">
                    <div class="form-group">
                        <input required type="date" name="datacancelamento" class="form-control mt-4"
                            id="datacancelamento{{ $contratos_ativos[$i]['contrato_id'] }}" placeholder="__/__/____">
                    </div>
                </td>


                <td class="budget">
                    <div class="form-group">
                        <input required type="date" name="data_ultimo_dia" class="form-control mt-4"
                            id="data_ultimo_dia{{ $contratos_ativos[$i]['contrato_id'] }}" placeholder="">
                    </div>
                </td>

                </td>
                <td> <button onclick="cancelar_contrato('{{ $contratos_ativos[$i]['contrato_id'] }}', '{{$contratos_ativos[$i]['data_kickoff']}}')"
                        class="btn btn-danger ativar-button btn-circle btn-sm"><i class="fa-solid fa-circle-xmark"></i>
                        Cancelar</button></td>
                <td>
                    <button
                        onclick="navegate_cliente({{ $contratos_ativos[$i]['cliente_id'] }}, '{{ $contratos_ativos[$i]['contrato'] }}')"
                        class="btn btn-primary ativar-button btn-circle btn-sm">
                        <i class="fa-solid fa-circle-info"></i> Detalhes
                    </button>
                </td>
                <td style="text-align: center">
                    <button type="button" class="btn btn-primary ativar-button btn-circle btn-sm"
                        onclick="abrir_modal_alocar_servico('{{ $contratos_ativos[$i]['contrato'] }}', '{{ $contratos_ativos[$i]['contrato_id'] }}', '{{ json_encode($contratos_ativos[$i]['possiveis_alocacoes']) }}')"
                        id="btn-editar-contrato" class="btn btn-primary" title="Alocar Contrato"><i
                            class="fa-solid fa-file-circle-plus"></i></button>
                </td>
                <td>
                    <button type="button" class="btn btn-primary ativar-button btn-circle btn-sm"
                        onclick="abrir_modal_editar('{{ $contratos_ativos[$i]['contrato'] }}', '{{ $contratos_ativos[$i]['contrato_id'] }}', true, 'ativo', 
                        '{{ date('d/m/Y', strtotime($contratos_ativos[$i]['data_kickoff'])) }}', null, null, '{{$contratos_ativos[$i]['fee']}}')"
                        id="btn-editar-contrato" class="btn btn-primary" title="Editar contrato"><i
                            class="fa-solid fa-pen-to-square"></i></button>
                </td>
                @if($infos_func[0]->acesso == "Master" || $infos_func[0]->acesso == "Qualidade")
                    <td>
                        <button type="button" class="btn btn-danger ativar-button btn-circle btn-sm" onclick="abrir_modal_excluir('{{ $contratos_ativos[$i]['contrato_id'] }}')" id="btn-excluir-contrato" class="btn btn-primary"><i class="fa-solid fa-trash"></i></button>
                    </td>
                @endif

            </tr>
        @endfor
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTableContratosAtivos').DataTable({
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
    function cancelar_contrato(contrato_id, data_kickoff) {
        var data_cancelar = new Date(document.getElementById(`datacancelamento` + contrato_id).value);
        var data_ultimo_dia = new Date(document.getElementById(`data_ultimo_dia` + contrato_id).value);
        var data_kickoff = Date.parse(data_kickoff);
        
        if (data_cancelar) {
            if (data_ultimo_dia) {


                data_cancelar = Date.parse(data_cancelar);
                data_ultimo_dia = Date.parse(data_ultimo_dia);
                console.log(data_kickoff);
                console.log(data_cancelar);
                console.log(data_ultimo_dia);

                if(data_kickoff < data_ultimo_dia || data_kickoff < data_cancelar){

                let Data = new FormData();
                const token = document
                    .querySelector(`input[name="_token"]`)
                    .value;
                Data.append('data_cancelar', data_cancelar);
                Data.append('data_ultimo_dia', data_ultimo_dia);
                Data.append('_token', token);

                const url = `/contrato/${contrato_id}/cancelar`;
                fetch(url, {
                    method: 'POST',
                    body: Data
                }).then((response) => {
                    if(response){
                        alert("Contrato cancelado com sucesso");
                    }else{
                        alert("Data de cancelamento menor que data de kickoff");
                    }
                    
                    // window.location.href = "/net-contratos";
                });
            }else{
                alert('A data de solicitação de cancelamento ou a data de último dia, não podem ser menores que a Data de Kickoff.');
            }
            } else {
                alert('Por favor, inserir a quantidade de dias de aviso prévio que ele irá cumprir');
            }
        } else {
            alert('Por favor, inserir a Data de solicitação do cancelamento');
        }
    }
</script>
