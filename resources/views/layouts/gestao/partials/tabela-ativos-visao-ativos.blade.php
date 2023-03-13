<h3>Clientes</h3>
<table class="table align-items-center table-flush" id="dataTableClientesAtivos">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Logo</th>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Contratos</th>
            <th scope="col" class="sort" data-sort="data">Contratos Alocados</th>
            <th scope="col" class="sort" data-sort="data">Contratos totais</th>
            <th scope="col" class="sort" data-sort="data">Fee total</th>
            <th>Cancelar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($clientes as $cliente)
            <?php
                $i = 0; 
                $fee = 0;
            ?>
            <tr>
                <td>
                    <a href="/cliente/{{ $cliente['cliente_id'] }}"><img style="width: 50px;"
                        src="{{ asset('storage/clientes/cliente'.$cliente['cliente_id'].'.jpeg') }}"
                        alt="Logo não encontrada"
                        onerror="this.src='{{ asset('storage/errors/imageNotFound.png') }}' this.onerror = null">
                </td>
                <td>{{$cliente['empresa']}}</td>
                <td>
                    @foreach ($cliente['contratos'] as $contrato)
                        <?php
                            $i++; 
                            $fee += $contrato['fee'];
                        ?>
                        <span class="badge 
                        @if(\Carbon\Carbon::parse($contrato['data_ultimo_dia'])->lt(\Carbon\Carbon::now()) && $contrato['data_ultimo_dia'] != null)
                        text-bg-danger
                        @else
                        text-bg-success
                        @endif
                        ">
                            {{$contrato['servico']}}
                        </span>
                    @endforeach
                </td>
                <td>
                    @foreach ($cliente['contratos'] as $contrato)
                        @foreach ($contrato['contrato_alocado'] as $contrato_alocado)
                            <?php
                                $i++; 
                            ?>
                            <span class="badge 
                                @if(\Carbon\Carbon::parse($contrato['data_ultimo_dia'])->lt(\Carbon\Carbon::now()) && $contrato['data_ultimo_dia'] != null)
                                text-bg-danger
                                @else
                                text-bg-success
                                @endif
                                ">
                                {{$contrato_alocado['servico']}}
                            </span>
                        @endforeach
                    @endforeach
                </td>
                <td>{{$i}}</td>
                <td>{{$fee}}</td>
                <td>
                    <button class="btn btn-danger btn-sm"
                    onclick="abrir_modal_cancelar_contrato({{ json_encode($cliente['contratos']) }})">Cancelar
                    contratos</button>
                </td>
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
