<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="funcionario">Funcionário</th>
            <th scope="col" class="sort" data-sort="depto">Depto.</th>
            <th scope="col" class="sort" data-sort="status">Status</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($funcionarios as $funcionario)
        <tr id="funcionario-cadastro-id-{{$funcionario->id}}" scope="row">
            <td id="funcionario-name-{{$funcionario->id}}">{{ $funcionario->nome }}</td>
            <td id="funcionario-name-{{$funcionario->id}}">{{ $funcionario->departamento }}</td>
            @if ($funcionario->ativo == 'Sim')
            <td><i id="funcionario_status_ativo-{{ $funcionario->id }}"
                    class="fas fa-check-circle btn-sm text-success"></i>
                <span id="funcionario_status_label_ativo-{{ $funcionario->id }}">Ativo</span>
            </td>

            {{-- <td>
                                        <button id="btn-edit-funcionario-{{ $funcionario->id }}" class="btn-primary
            edit-button"><i class="fas fa-edit"></i></button>
            <button id="btn-inativar-funcionario-{{ $funcionario->id }}" class="btn-danger inativar-button"><i
                    class="fas fa-minus-circle"></i></button>
            </td> --}}
            @else
            <td><i id="funcionario_status_inativo-{{ $funcionario->id }}"
                    class="fas fa-times-circle btn-sm text-danger"></i>
                <span id="funcionario_status_label_inativo-{{ $funcionario->id }}">Inativo
                </span>
            </td>
            {{-- <td>
                                        <button id="btn-edit-funcionario-{{ $funcionario->id }}" class="btn-primary
            edit-button"><i class="fas fa-edit"></i></button>
            <button id="btn-ativar-funcionario-{{ $funcionario->id }}" class="btn-success ativar-button"><i
                    class="fas fa-undo-alt"></i></button>
            </td> --}}
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
