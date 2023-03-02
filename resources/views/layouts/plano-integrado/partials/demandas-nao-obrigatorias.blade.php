<table class="table align-items-center table-flush" id="dataTable">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="demanda">Demanda</th>
            <th scope="col" class="sort" data-sort="servico">Serviço</th>
            <th scope="col" class="sort" data-sort="tipodeacao">Tipo de Ação</th>
            <th scope="col" class="sort" data-sort="selecionar">Selecionar</th>
        </tr>
    </thead>
    <tbody class="list">
        <?php $di = 0; ?>
        @while ($di < count($demandas)) <tr>
            <td class="td-demandas">{{ $demandas[$di]->nome }}</td>
            <td>{{ $demandas[$di]->servico }}</td>
            <td class="td-demandas">{{ $demandas[$di]->tipo_acao}}</td>
            <td><a class="btn btn-info btn-selecionar" href="#"
                    onclick="campoCadastro('{{ $demandas[$di]->nome }}', '{{$demandas[$di]->servico }}', '{{$demandas[$di]->tipo_acao}}')">Selecionar
            </td>
            </tr>

            <?php $di++; ?>
            @endwhile
    </tbody>
</table>
