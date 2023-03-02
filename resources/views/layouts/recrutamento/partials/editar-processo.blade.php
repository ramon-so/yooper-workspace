<form method="post" action="/solicitacao/editar/{{$processo->id}}}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
        Informações do processo
        seletivo</h6>
    <div class="form-group">
        <input type="text" class="form-control" name="status" value="Pendente" hidden>
        <label class="form-control-label" for="input-name">Título</label>
        <input type="text" name="titulo" value="{{$processo->titulo}}" class="form-control" id="input-name"
            placeholder="Título">
    </div>
    <div class="form-group focused">
        <label class="form-control-label" for="departamento">Departamento</label>
        <input type="text" class="form-control" value="{{$processo->departamento_nome}}" disabled>
    </div>
    <div class="form-group focused">
        <label class="form-control-label" for="departamento">Subdepartamento</label>
        <input type="text" class="form-control" value="<?php if($processo->subdepartamento_id == 0){ ?>--<?php } else { ?>{{$processo->subdepartamento_nome}}<?php } ?>" disabled>
    </div>
    {{-- <div class="form-group focused">
        <label class="form-control-label" for="cargo">Selecionar
            cargo</label>
        <select name="cargo_id" id="cargo" class="form-control-select" required>
            <option selected value="{{$processo->cargo_id}}">
                {{$processo->cargo_nome}}
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
        <select name="nivel_de" class="form-control-select" id="select-nivel">
            <option selected value="{{$processo->nivel_de}}">
                {{$processo->nivel_de}}</option>
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
        <select name="nivel_para" class="form-control-select" id="select-nivel">
            <option selected value="{{$processo->nivel_para}}">
                {{$processo->nivel_para}}</option>
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

    {{-- <div class="form-group">
        <label class="form-control-label" for="input-aprovados">Motivo</label>
        <input type="text" value="{{$processo->motivo}}" name="motivo" class="form-control"
            id="input-motivo" placeholder="Motivo">
    </div> --}}

    <div class="form-group focused">
    <label class="form-control-label" for="select-prioridade">Urgência</label>
        <select name="prioridade" class="form-control-select" id="select-prioridade">
            <option selected value="{{$processo->prioridade}}">
                {{$processo->prioridade}}
            </option>
            <option value="Baixa">Baixa</option>
            <option value="Médio">Médio</option>
            <option value="Alta">Alta</option>
            <option value="Crítico">Crítico</option>
        </select>
    </div>


    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
