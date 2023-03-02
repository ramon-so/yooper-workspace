<h3>Clientes</h3>
<table class="table align-items-center table-flush" id="dataTableClientesAtivos">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Logo</th>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Status</th>
            <th scope="col" class="sort" data-sort="data">Contratos</th>
            <th scope="col" class="sort" data-sort="data">Contratos Alocados</th>
            <th scope="col" class="sort" data-sort="data">Contratos totais</th>
            <th scope="col" class="sort" data-sort="data">Fee total</th>
            <th>Cancelar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($clientes_ativos as $cliente)
            <tr>
               
                    <td> <a href="/cliente/{{ $cliente->id }}"><img style="width: 50px;"
                            src="{{ asset('storage/clientes/cliente'.$cliente->cliente_id.'.jpeg') }}"
                            alt="Logo não encontrada"
                            onerror="this.src='{{ asset('storage/errors/imageNotFound.png') }}' this.onerror = null">
                        </td>
                    </a>
                    <td><a href="/cliente/{{ $cliente->id }}">{{ $cliente->empresa }}</a></td>
                    <td>Contratos ativos</td>
                <td>
                    @foreach ($cliente->contratos as $contratos)
                        <span class="badge text-bg-success"
                            title="@foreach ($contratos->alocados as $alocado){{ $alocado['servico'] . "\n" }} @endforeach">
                            {{ $contratos->servico }}
                        </span>
                    @endforeach
                </td>
                
                <td>
                    @foreach ($cliente->contratos as $contratos)
                        @foreach ($contratos->alocados as $alocado)
                            <span class="badge text-bg-success">
                                {{ $contratos->servico }} <i class="fa-solid fa-arrow-right"></i> {{ $alocado['servico'] }}
                            </span>
                        @endforeach
                    @endforeach
                </td>
                <td>
                    <span
                        class="badge text-bg-primary">{{ count($cliente->contratos) + $cliente->total_alocados }}</span>
                </td>
                <td><p class="hidden-fee">R$ {{$cliente->fee}}</p> <p class="display-fee">R$ *******</p></td>
                <td><button class="btn btn-danger btn-sm"
                        onclick="abrir_modal_cancelar_contrato({{ json_encode($cliente->contratos) }})">Cancelar
                        contratos</button></td>
            </tr>
        @endforeach
        @foreach ($clientes_cancelados as $cliente)
        <tr>
            <td><img  style="width: 50px;" src="{{ asset('storage/clientes/cliente'.$cliente->cliente_id.'.jpeg') }}" alt="Logo não encontrada"
                onerror="this.src='{{ asset('storage/errors/imageNotFound.png') }}'; this.onerror = null"></td>
             <td>{{$cliente->empresa}}</td>
             <td>Contratos Cancelados</td>
             <td>
                @foreach ($cliente->contratos as $contratos)
                        <span 
                            class="badge text-bg-danger"
                            title="@foreach ($contratos->alocados as $alocado){{$alocado['servico'] . "\n"}}@endforeach"
                            >
                            {{$contratos->servico}}
                        </span>
                    @endforeach
             </td>
             
             <td>
                @foreach ($cliente->contratos as $contratos)
                    @foreach ($contratos->alocados as $alocado)
                        <span class="badge text-bg-danger">
                            {{ $contratos->servico }} <i class="fa-solid fa-arrow-right"></i> {{ $alocado['servico'] }}
                        </span>
                    @endforeach
                @endforeach
            </td>
            
             <td>
                <span class="badge text-bg-primary">{{count($cliente->contratos) + $cliente->total_alocados}}</span>
            </td>
             <td colspan=""><p class="hidden-fee">R$ {{$cliente->fee}}</p> <p class="display-fee">R$ *******</p></td>
             <td></td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(document).ready(function() {
        $('#dataTableClientesAtivos').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ contratos por página",
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum resultado encontrado",
                "infoFiltered": "(Filtrado from _MAX_ total de contratos)",
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "paging": false,
            "bSort": true,
            'pagingType': 'full',
        });
    });
</script>
