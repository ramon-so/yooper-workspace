<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="nome">Fonte de Captação</th>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="edit">Editar/Inativar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($captacoes as $captacao)

        @if($captacao->ativo == 'Sim')
        <tr id="captacao-cadastro-id-{{$captacao->id}}" class="ativo">
            @else
        <tr id="captacao-cadastro-id-{{$captacao->id}}" class="inativo">
            @endif
            <td id="captacao-name-{{$captacao->id}}" class="nome-captacao">{{ $captacao->nome }}</td>
            @if ($captacao->ativo == 'Sim')
            <td><i id="cp_status_ativo-{{ $captacao->id }}" class="fas fa-check-circle text-success"></i>
                <span id="cp_status_label_ativo-{{ $captacao->id }}">Ativo</span>
            </td>

            <td>
                <button id="btn-edit-cp-{{ $captacao->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputCp({{$captacao->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-inativar-cp-{{ $captacao->id }}"
                    class="btn btn-danger inativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_cp({{ $captacao->id}}, 'inativar')"><i
                        class="fas fa-minus-circle"></i></button>
            </td>
            @else
            <td><i id="cp_status_inativo-{{ $captacao->id }}" class="fas fa-times-circle text-danger"></i>
                <span id="cp_status_label_inativo-{{ $captacao->id }}">Inativo</span>
            </td>
            <td>
                <button id="btn-edit-cp-{{ $captacao->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputCp({{$captacao->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-ativar-cp-{{ $captacao->id }}"
                    class="btn btn-success ativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_cp({{ $captacao->id }}, 'ativar')"><i
                        class="fas fa-undo-alt"></i></button>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
