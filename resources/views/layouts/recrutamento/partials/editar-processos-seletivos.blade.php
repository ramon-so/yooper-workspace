<form method="post" action="/processo-seletivo/editar-processo/{{$processoSeletivo->id}}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
        Informações do processo
        seletivo</h6>
    <div class="form-group">
        <input type="text" class="form-control" name="user_id" value="{{$processoSeletivo->usuario_id}}" hidden
            required>
        <input type="text" value="99" hidden name="avaliacao_tecnico_ids" class="form-control" id="input-avaliacao"
            required>
        <input type="text" class="form-control" name="titulo" value="Pendente" hidden>
        <label class="form-control-label" for="input-titulo">Título</label>
        <input type="text" name="titulo" required value="{{$processoSeletivo->titulo}}" class="form-control" id="input-titulo"
            placeholder="Título">
    </div>
    <div class="form-group focused">
        <label class="form-control-label" for="departamento">Departamento</label>
        <input type="text" class="form-control" required id="departamento" value="{{$processoSeletivo->departamento_nome}}"
            disabled>
        <input type="text" name="departamento_id" hidden class="form-control"
            value="{{$processoSeletivo->departamento_id}}" required>

    </div>
    {{-- <div class="form-group focused">
        <label class="form-control-label" for="cargo">Selecionar
            cargo</label>
        <select name="cargo_id" id="cargo" reuqired class="form-control-select" required>
            <option selected value="{{$processoSeletivo->cargo_id}}">
                {{$processoSeletivo->cargo_nome}}
            </option>
            @foreach ($listaCg as $cg)
            <option value="{{ $cg->id }}">{{ $cg->nome }}
            </option>
            @endforeach
        </select>
    </div> --}}
    <div class="form-group focused">
        <label class="form-control-label" for="select-nivel">Nível
            adequação</label>
        <select name="nivel_de" required class="form-control-select" id="select-nivel">
            <option selected value="{{$processoSeletivo->nivel_de}}">
                {{$processoSeletivo->nivel_de}}</option>
            <option value="Assistente">Assistente</option>
            <option value="Júnior 1">Júnior 1</option>
            <option value="Júnior 2">Júnior 2</option>
            <option value="Júnior 3">Júnior 3</option>
            <option value="Pleno 1">Pleno 1</option>
            <option value="Pleno 2">Pleno 2</option>
            <option value="Pleno 3">Pleno 3</option>
            <option value="Senior 1">Senior 1</option>
            <option value="Senior 2">Senior 2</option>
            <option value="Senior 3">Senior 3</option>
            <option value="Coordenador 1">Coordenador 1</option>
            <option value="Coordenador 2">Coordenador 2</option>
            <option value="Coordenador 3">Coordenador 3</option>
            <option value="Gerente 1">Gerente 1</option>
            <option value="Gerente 2">Gerente 2</option>
            <option value="Gerente 3">Gerente 3</option>
            <option value="Especialista 1">Especialista 1</option>
            <option value="Especialista 2">Especialista 2</option>
            <option value="Especialista 3">Especialista 3</option>
            <option value="Especialista 4">Especialista 4</option>
            <option value="Especialista 5">Especialista 5</option>
            <option value="Especialista 6">Especialista 6</option>
        </select>
    </div>
    <div class="form-group focused">
        <select name="nivel_para" required class="form-control-select" id="select-nivel">
            <option selected value="{{$processoSeletivo->nivel_para}}">
                {{$processoSeletivo->nivel_para}}</option>
            <option value="Assistente">Assistente</option>
            <option value="Júnior 1">Júnior 1</option>
            <option value="Júnior 2">Júnior 2</option>
            <option value="Júnior 3">Júnior 3</option>
            <option value="Pleno 1">Pleno 1</option>
            <option value="Pleno 2">Pleno 2</option>
            <option value="Pleno 3">Pleno 3</option>
            <option value="Senior 1">Senior 1</option>
            <option value="Senior 2">Senior 2</option>
            <option value="Senior 3">Senior 3</option>
            <option value="Coordenador 1">Coordenador 1</option>
            <option value="Coordenador 2">Coordenador 2</option>
            <option value="Coordenador 3">Coordenador 3</option>
            <option value="Gerente 1">Gerente 1</option>
            <option value="Gerente 2">Gerente 2</option>
            <option value="Gerente 3">Gerente 3</option>
            <option value="Especialista 1">Especialista 1</option>
            <option value="Especialista 2">Especialista 2</option>
            <option value="Especialista 3">Especialista 3</option>
            <option value="Especialista 4">Especialista 4</option>
            <option value="Especialista 5">Especialista 5</option>
            <option value="Especialista 6">Especialista 6</option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-motivo">Motivo</label>
        <input type="text" value="{{$processoSeletivo->motivo}}" required name="motivo" class="form-control"
            id="input-motivo" placeholder="Motivo">
    </div>

    <div class="form-group focused">
        <label class="form-control-label" for="select-prioridade">Urgência</label>
        <select name="prioridade" class="form-control-select" required id="select-prioridade">
            <option selected value="{{$processoSeletivo->prioridade}}">
                {{$processoSeletivo->prioridade}}
            </option>
            <option value="Crítico">Crítico</option>
            <option value="Alta">Alta</option>
            <option value="Médio">Médio</option>
            <option value="Baixa">Baixa</option>
        </select>
    </div>
    {{-- <div class="form-group focused">
        <label class="form-control-label" for="status">Status</label>
        <select name="status_id" id="status" class="form-control-select" required>
            <option selected value="{{$processoSeletivo->status_processo}}">
                {{$processoSeletivo->status_nome}}
            </option>
            @foreach ($listaPs as $ps)
            <option value="{{ $ps->id }}">{{ $ps->nome }}
            </option>
            @endforeach
        </select>
    </div> --}}
    <div class="form-group">
        <label class="form-control-label" for="input-vencimento">Deadline</label>
        <input type="date" value="{{$processoSeletivo->data_vencimento}}" required name="data_vencimento" class="form-control"
            id="input-vencimento" placeholder="Deadline" disabled>
    </div>
    <div class="form-group focused">
        <label class="form-control-label" for="recrutador">Recrutador</label>
        <select name="recrutador_funcionario_id" id="recrutador" class="form-control-select" required>
            <option selected value="{{$processoSeletivo->recrutador_funcionario_id}}">{{$processoSeletivo->nome_recrutador}}</option>
            @foreach ($listaFc as $fc)
            @if ($fc->departamento_nome == 'GENTE Y GESTÃO' && $fc->ativo == 'Sim')
            <option value="{{ $fc->funcionario_id }}">{{ $fc->funcionario_nome }}
            </option>
            @endif
            @endforeach
        </select>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
