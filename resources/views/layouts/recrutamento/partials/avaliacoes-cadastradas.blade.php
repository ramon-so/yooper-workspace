<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="nome">Nome</th>
            <th scope="col" class="sort" data-sort="tipo">Tipo</th>
            <th scope="col" class="sort" data-sort="departamento">Departamento</th>
            <th scope="col" class="sort" data-sort="qtd_dissertativa">Qtd Dissertativa</th>
            <th scope="col" class="sort" data-sort="qtd_alternativa">Qtd Alternativa</th>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="data_cadastro">Data de Cadastro</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($avaliacoes as $avaliacao)
        <tr scope="row">
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$avaliacao->nome_avaliacao}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$avaliacao->tipo_avaliacao}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$avaliacao->departamento}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$avaliacao->qtd_dissertativa}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$avaliacao->qtd_alternativa}}</span>
                </span>
            </td>
             <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$avaliacao->status}}</span>
                </span>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$avaliacao->created_at ? $avaliacao->created_at->format('d/m/Y') : $avaliacao->created_at}}</span>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
