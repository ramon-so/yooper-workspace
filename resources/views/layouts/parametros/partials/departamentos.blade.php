<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="nome">Departamento</th>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="edit">Editar/Inativar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($departamentos as $departamento)

        @if($departamento->ativo == 'Sim')
        <tr id="departamento-cadastro-id-{{$departamento->id}}" class="ativo">
            @else
        <tr id="departamento-cadastro-id-{{$departamento->id}}" class="inativo">
            @endif
            <td id="departamento-name-{{$departamento->id}}" class="nome-depto">{{ $departamento->departamento }}</td>
            @if ($departamento->ativo == 'Sim')
            <td><i id="dp_status_ativo-{{ $departamento->id }}" class="fas fa-check-circle text-success"></i>
                <span id="dp_status_label_ativo-{{ $departamento->id }}">Ativo</span>
            </td>

            <td>
                <button id="btn-edit-dp-{{ $departamento->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputDp({{$departamento->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-inativar-dp-{{ $departamento->id }}"
                    class="btn btn-danger inativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_dp({{ $departamento->id}}, 'inativar')"><i
                        class="fas fa-minus-circle"></i></button>
            </td>
            @else
            <td><i id="dp_status_inativo-{{ $departamento->id }}" class="fas fa-times-circle text-danger"></i>
                <span id="dp_status_label_inativo-{{ $departamento->id }}">Inativo</span>
            </td>
            <td>
                <button id="btn-edit-dp-{{ $departamento->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputDp({{$departamento->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-ativar-dp-{{ $departamento->id }}"
                    class="btn btn-success ativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_dp({{ $departamento->id }}, 'ativar')"><i
                        class="fas fa-undo-alt"></i></button>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
