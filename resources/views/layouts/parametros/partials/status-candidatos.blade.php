<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="funcionario">Nome Status</th>
            <th scope="col" class="sort" data-sort="depto">Status</th>
            <th scope="col" class="sort" data-sort="status">Editar/Inativar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($status_candidatos as $status_candidato)

        @if($status_candidato->ativo == 'Sim')
        <tr id="status-candidato-cadastro-id-{{$status_candidato->id}}" class="ativo">
            @else
        <tr id="status-candidato-cadastro-id-{{$status_candidato->id}}" class="inativo">
            @endif
            <td id="status-candidato-nome-{{$status_candidato->id}}" class="nome-sc">{{ $status_candidato->nome }}</td>
            @if ($status_candidato->ativo == 'Sim')
            <td><i id="dp_status_ativo-{{ $status_candidato->id }}" class="fas fa-check-circle text-success"></i>
                <span id="dp_status_label_ativo-{{ $status_candidato->id }}">Ativo</span>
            </td>

            <td>
                <button id="btn-edit-dp-{{ $status_candidato->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSc({{$status_candidato->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-inativar-dp-{{ $status_candidato->id }}"
                    class="btn btn-danger inativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sc({{ $status_candidato->id}}, 'inativar')"><i
                        class="fas fa-minus-circle"></i></button>
            </td>
            @else
            <td><i id="dp_status_inativo-{{ $status_candidato->id }}" class="fas fa-times-circle text-danger"></i>
                <span id="dp_status_label_inativo-{{ $status_candidato->id }}">Inativo</span>
            </td>
            <td>
                <button id="btn-edit-dp-{{ $status_candidato->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSc({{$status_candidato->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-ativar-dp-{{ $status_candidato->id }}"
                    class="btn btn-success ativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sc({{ $status_candidato->id }}, 'ativar')"><i
                        class="fas fa-undo-alt"></i></button>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
