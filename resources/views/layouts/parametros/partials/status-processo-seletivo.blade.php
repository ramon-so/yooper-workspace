<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="funcionario">Nome Status</th>
            <th scope="col" class="sort" data-sort="depto">Status</th>
            <th scope="col" class="sort" data-sort="status">Editar/Inativar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($status_processo_seletivos as $status_processo_seletivo)

        @if($status_processo_seletivo->ativo == 'Sim')
        <tr id="status-processo-seletivo-cadastro-id-{{$status_processo_seletivo->id}}" class="ativo">
            @else
        <tr id="status-processo-seletivo-cadastro-id-{{$status_processo_seletivo->id}}" class="inativo">
            @endif
            <td id="status-processo-seletivo-name-{{$status_processo_seletivo->id}}" class="nome-sps">{{ $status_processo_seletivo->nome }}</td>
            @if ($status_processo_seletivo->ativo == 'Sim')
            <td><i id="dp_status_ativo-{{ $status_processo_seletivo->id }}" class="fas fa-check-circle text-success"></i>
                <span id="dp_status_label_ativo-{{ $status_processo_seletivo->id }}">Ativo</span>
            </td>

            <td>
                <button id="btn-edit-dp-{{ $status_processo_seletivo->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSps({{$status_processo_seletivo->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-inativar-dp-{{ $status_processo_seletivo->id }}"
                    class="btn btn-danger inativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sps({{ $status_processo_seletivo->id}}, 'inativar')"><i
                        class="fas fa-minus-circle"></i></button>
            </td>
            @else
            <td><i id="dp_status_inativo-{{ $status_processo_seletivo->id }}" class="fas fa-times-circle text-danger"></i>
                <span id="dp_status_label_inativo-{{ $status_processo_seletivo->id }}">Inativo</span>
            </td>
            <td>
                <button id="btn-edit-dp-{{ $status_processo_seletivo->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSps({{$status_processo_seletivo->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-ativar-dp-{{ $status_processo_seletivo->id }}"
                    class="btn btn-success ativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sps({{ $status_processo_seletivo->id }}, 'ativar')"><i
                        class="fas fa-undo-alt"></i></button>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
