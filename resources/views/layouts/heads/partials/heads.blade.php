<table class="table align-items-center table-flush barra">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="foto">Foto</th>
            <th scope="col" class="sort" data-sort="funcionario">Funcionário</th>
            <th scope="col" class="sort" data-sort="departamento">Departamento</th>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="edit">Editar/Inativar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($vinculados as $vinculado)

        @if($vinculado->ativo == 'Sim')
        <tr id="head-cadastro-id-{{$vinculado->funcionario_id}}" class="ativo">
            @else
        <tr id="head-cadastro-id-{{$vinculado->funcionario_id}}" class="inativo">
            @endif
             @if($vinculado->ativo == 'Sim')
                <td>
                <p id="head-foto-{{$vinculado->id}}" style="display: none;"></p>
                    <div class="foto-solicitante">
                        <img src='{{ asset("storage/usuarios/$vinculado->usuario_foto") }}'>
                    </div>
                </td>
            @else
                <td>
            <p id="head-foto-{{$vinculado->id}}" style="display: none;"></p>
                <div class="foto-solicitante">
                    <img style="filter: grayscale(1);" src='{{ asset("storage/usuarios/$vinculado->usuario_foto") }}'>
                </div>
            </td>
            @endif
            <td id="head-nome-{{$vinculado->id}}" class="nome-head">{{ $vinculado->funcionario_nome }}</td>
            <td id="departamento-nome-{{$vinculado->id}}" class="departamento-head">{{ $vinculado->departamento_nome }}
            </td>
            @if ($vinculado->ativo == 'Sim')
            <td><i id="dp_status_ativo-{{ $vinculado->funcionario_id }}" class="fas fa-check-circle text-success"></i>
                <span id="dp_status_label_ativo-{{ $vinculado->funcionario_id }}">Ativo</span>
            </td>

            <td>
                <button id="btn-edit-dp-{{ $vinculado->funcionario_id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputHd('{{$vinculado->funcionario_id}}', '{{$vinculado->departamento_id}}', '{{$vinculado->id}}')"><i class="fas fa-pen"></i></button>
                <button id="btn-inativar-dp-{{ $vinculado->funcionario_id }}"
                    class="btn btn-danger inativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_hd('{{ $vinculado->id}}', 'inativar')"><i
                        class="fas fa-minus-circle"></i></button>
            </td>
            @else
            <td><i id="dp_status_inativo-{{ $vinculado->funcionario_id }}" class="fas fa-times-circle text-danger"></i>
                <span id="dp_status_label_inativo-{{ $vinculado->funcionario_id }}">Inativo</span>
            </td>
            <td>
                <button id="btn-edit-dp-{{ $vinculado->funcionario_id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputHd('{{$vinculado->funcionario_id}}', '{{$vinculado->departamento_id}}', '{{$vinculado->id}}')"><i class="fas fa-pen"></i></button>
                <button id="btn-ativar-dp-{{ $vinculado->funcionario_id }}" class="btn btn-success ativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_hd('{{ $vinculado->id }}', 'ativar')"><i
                        class="fas fa-undo-alt"></i></button>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
