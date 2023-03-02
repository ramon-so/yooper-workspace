<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="departamento">Departamento</th>
            <th scope="col" class="sort" data-sort="funcionario">Sub Departamento</th>
            <th scope="col" class="sort" data-sort="depto">Status</th>
            <th scope="col" class="sort" data-sort="status">Editar/Inativar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($subdepartamentos as $subdepartamento)

        @if($subdepartamento->ativo == 'Sim')
        <tr id="status-subdepartamento-cadastro-id-{{$subdepartamento->id}}" class="ativo">
            @else
        <tr id="status-subdepartamento-cadastro-id-{{$subdepartamento->id}}" class="inativo">
            @endif
            <td id="departamento-nome-{{$subdepartamento->id}}">{{ $subdepartamento->departamento_nome }}</td>
            <td id="subdepartamento-nome-{{$subdepartamento->id}}" class="nome-sd">{{ $subdepartamento->nome }}</td>
            @if ($subdepartamento->ativo == 'Sim')
            <td><i id="dp_status_ativo-{{ $subdepartamento->id }}" class="fas fa-check-circle text-success"></i>
                <span id="dp_status_label_ativo-{{ $subdepartamento->id }}">Ativo</span>
            </td>

            <td>
                <button id="btn-edit-dp-{{ $subdepartamento->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSd({{$subdepartamento->id}}, '{{$subdepartamento->departamento_id}}')"><i class="fas fa-pen"></i></button>
                <button id="btn-inativar-dp-{{ $subdepartamento->id }}"
                    class="btn btn-danger inativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sd({{ $subdepartamento->id}}, 'inativar')"><i
                        class="fas fa-minus-circle"></i></button>
            </td>
            @else
            <td><i id="dp_status_inativo-{{ $subdepartamento->id }}" class="fas fa-times-circle text-danger"></i>
                <span id="dp_status_label_inativo-{{ $subdepartamento->id }}">Inativo</span>
            </td>
            <td>
                <button id="btn-edit-dp-{{ $subdepartamento->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSd({{$subdepartamento->id}}, '{{$subdepartamento->departamento_id}}')"><i class="fas fa-pen"></i></button>
                <button id="btn-ativar-dp-{{ $subdepartamento->id }}"
                    class="btn btn-success ativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sd({{ $subdepartamento->id }}, 'ativar')"><i
                        class="fas fa-undo-alt"></i></button>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
