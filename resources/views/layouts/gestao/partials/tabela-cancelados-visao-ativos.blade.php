<h3>Cancelados</h3>
<table class="table align-items-center table-flush" id="dataTableClientesCancelados">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Logo</th>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Contratos</th>
            <th scope="col" class="sort" data-sort="data">Contratos Alocados</th>
            <th scope="col" class="sort" data-sort="data">Contratos totais</th>
            <th scope="col" class="sort" data-sort="data">Fee total</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($clientes_cancelados as $cliente)
        <tr>
            <td><img  style="width: 50px;" src="{{ asset('storage/clientes/cliente'.$cliente->cliente_id.'.jpeg') }}" alt="Logo não encontrada"
                onerror="this.src='{{ asset('storage/errors/imageNotFound.png') }}'; this.onerror = null"></td>
             <td>{{$cliente->empresa}}</td>
             <td>
                @foreach ($cliente->contratos as $contratos)
                        <span 
                            class="badge text-bg-secondary"
                            title="@foreach ($contratos->alocados as $alocado){{$alocado['servico'] . "\n"}}@endforeach"
                            >
                            {{$contratos->servico}}
                        </span>
                    @endforeach
             </td>
             <td>
                @foreach ($cliente->contratos as $contratos)
                    @foreach ($contratos->alocados as $alocado)
                        <span class="badge text-bg-secondary">
                            {{ $contratos->servico }} <i class="fa-solid fa-arrow-right"></i> {{ $alocado['servico'] }}
                        </span>
                    @endforeach
                @endforeach
            </td>
             <td>
                <span class="badge text-bg-primary">{{count($cliente->contratos) + $cliente->total_alocados}}</span>
            </td>
             <td><p class="hidden-fee">R$ {{$cliente->fee}}</p> <p class="display-fee">R$ *******</p></td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTableClientesCancelados').DataTable({
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