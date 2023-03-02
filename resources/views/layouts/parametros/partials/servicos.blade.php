<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="nome">Serviço</th>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="edit">Editar/Inativar</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($servicos as $servico)

        @if($servico->ativo == 'Sim')
        <tr id="servico-cadastro-id-{{$servico->id}}" class="ativo">
            @else
        <tr id="servico-cadastro-id-{{$servico->id}}" class="inativo">
            @endif
            <td id="servico-nome-{{$servico->id}}" class="nome-sv">{{ $servico->nome }}</td>
            @if ($servico->ativo == 'Sim')
            <td><i id="servico_ativo-{{ $servico->id }}" class="fas fa-check-circle text-success"></i>
                <span id="servico_label_ativo-{{ $servico->id }}">Ativo</span>
            </td>

            <td>
                <button id="btn-edit-sv-{{ $servico->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSv({{$servico->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-inativar-sv-{{ $servico->id }}"
                    class="btn btn-danger inativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sv({{ $servico->id}}, 'inativar')"><i
                        class="fas fa-minus-circle"></i></button>
            </td>
            @else
            <td><i id="servico_inativo-{{ $servico->id }}" class="fas fa-times-circle text-danger"></i>
                <span id="servico_label_inativo-{{ $servico->id }}">Inativo</span>
            </td>
            <td>
                <button id="btn-edit-sv-{{ $servico->id }}" class="btn btn-primary edit-button btn-circle btn-sm"
                    onclick="toggleInputSv({{$servico->id}})"><i class="fas fa-pen"></i></button>
                <button id="btn-ativar-sv-{{ $servico->id }}"
                    class="btn btn-success ativar-button btn-circle btn-sm"
                    onclick="ativar_inativar_sv({{ $servico->id }}, 'ativar')"><i
                        class="fas fa-undo-alt"></i></button>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
