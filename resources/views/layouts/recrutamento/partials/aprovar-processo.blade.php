<form method="post" action="/solicitacao/aprovar/{{$processo->id}}}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
        Informações do processo
        seletivo</h6>
    <div class="form-group">
        <input type="text" value="99" hidden name="avaliacao_tecnico_ids" class="form-control" required>
        <input type="text" class="form-control" name="user_id" value="{{$processo->usuario_id}}" hidden required>
        <label class="form-control-label" for="input-name">Título</label>
        <input type="text" required name="titulo" value="{{$processo->titulo}}" class="form-control" id="input-name"
            placeholder="Título">
    </div>
    <div class="form-group focused">
        <label class="form-control-label" for="departamento">Departamento</label>
        <input type="text" class="form-control" id="departamento" value="{{$processo->departamento_nome}}" disabled>
        <input type="number" name="departamento_id" id="departamento-aprovar" hidden class="form-control" value="{{$processo->departamento_id}}"
            required>
    </div>
    <div class="form-group focused">
        <label class="form-control-label" for="departamento">Subdepartamento</label>
        <input type="text" class="form-control" value="<?php if($processo->subdepartamento_id == 0){ ?>--<?php } else { ?>{{$processo->subdepartamento_nome}}<?php } ?>" disabled>
        <input type="number" value="{{$processo->subdepartamento_id}}" hidden name="subdepartamento_id" class="form-control">        
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
        <select name="nivel_de" class="form-control-select" required id="select-nivel">
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
        <select name="nivel_para" class="form-control-select" required id="select-nivel">
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

    <div class="form-group">
        <label class="form-control-label" for="input-aprovados">Motivo</label>
        <input type="text" value="" required name="motivo" class="form-control"
            id="input-motivo" placeholder="Ex: Aumento de time">
    </div>


    <div class="form-group">
        <label class="form-control-label" for="input-aprovados">Range Salarial</label>
        <input type="text" value="" required name="salario_de" class="form-control"
            id="input-salario-de" placeholder="1000">
            até
        <input type="text" value="" required name="salario_ate" class="form-control"
            id="input-salario-de" placeholder="2000">
    </div>

    <div class="form-group focused">
        <label class="form-control-label" for="select-seguranca">Segurança</label>
        <select name="seguranca" required class="form-control-select" id="select-seguranca">
            <option value="Divulgação Liberada">Divulgação Liberada</option>
            <option value="Confidencial">Confidencial</option>
        </select>
    </div>

    <div class="form-group focused">
        <label class="form-control-label" for="select-prioridade">Urgência</label>
        <select name="prioridade" required class="form-control-select" id="select-prioridade">
            <option selected value="{{$processo->prioridade}}">
                {{$processo->prioridade}}
            </option>
            <option value="Baixa">Baixa</option>
            <option value="Médio">Médio</option>
            <option value="Alta">Alta</option>
            <option value="Crítico">Crítico</option>
        </select>
    </div>

    <div class="form-group">
        <label class="form-control-label" for="input-vencimento">Deadline</label>
        <input type="date" value="" name="data_vencimento" class="form-control input-vencimento" required id="input-vencimento"
            placeholder="Deadline">
    </div>

    <div class="form-group focused">
        <label class="form-control-label" for="status">Status</label>
        <select name="status_id" id="status" class="form-control-select" required>
            <option disabled selected value>Selecione o status</option>
            @foreach ($listaPs as $ps)
            <option value="{{ $ps->id }}">{{ $ps->nome }}
            </option>
            @endforeach
        </select>
    </div>

    <div class="form-group focused">
        <label class="form-control-label" for="recrutador">Recrutador</label>
        <select name="recrutador_funcionario_id" id="recrutador" class="form-control-select" required>
            <option disabled selected value>Selecione o recrutador</option>
            @foreach ($listaFc as $fc)
            @if ($fc->departamento_nome == 'GENTE Y GESTÃO' && $fc->ativo == 'Sim')
            <option value="{{ $fc->funcionario_id }}">{{ $fc->funcionario_nome }}
            </option>
            @endif
            @endforeach
        </select>
    </div>

<div class="form-group">
    <div id="padrao">
        <label class="form-control-label">Selecionar avaliações padrão</label>
        @foreach ($avaliacoes as $avaliacao)
        @if ($avaliacao->avaliacao_tipo == 'Padrão')
        <div class="custom-control custom-checkbox mb-3 dp-{{$avaliacao->avaliacao_departamento}}">
            <input type="checkbox" class="custom-control-input check-avaliacao" id="check-{{$processo->id}}-{{$avaliacao->avaliacao_id}}"
                name="avaliacao[]" value="{{$avaliacao->avaliacao_id}}">
            <label class="custom-control-label" for="check-{{$processo->id}}-{{$avaliacao->avaliacao_id}}">{{$avaliacao->avaliacao_nome}}</label>
        </div>
        @endif
        @endforeach
    </div>

    <div id="tecnico">
        <label class="form-control-label">Selecionar avaliações técnico</label>
        @foreach ($avaliacoes as $avaliacao)
        @if ($avaliacao->avaliacao_tipo == 'Técnico')
        <div class="custom-control custom-checkbox mb-3 dp-{{$avaliacao->avaliacao_departamento}}">
            <input type="checkbox" class="custom-control-input check-avaliacao" id="check-{{$processo->id}}-{{$avaliacao->avaliacao_id}}"
                name="avaliacao[]" value="{{$avaliacao->avaliacao_id}}">
            <label class="custom-control-label" for="check-{{$processo->id}}-{{$avaliacao->avaliacao_id}}">{{$avaliacao->avaliacao_nome}}</label>
        </div>
        <script>
             var dp{{$avaliacao->avaliacao_departamento}} = document.getElementsByClassName('dp-{{$avaliacao->avaliacao_departamento}}');
             var departamento2 = document.getElementById('departamento-aprovar');

           if({{$processo->departamento_id}} == {{$avaliacao->avaliacao_departamento}}) {
                    for(var j = 0; j < dp{{$avaliacao->avaliacao_departamento}}.length; j++) {
                    dp{{$avaliacao->avaliacao_departamento}}[j].style.display = 'flex';
                }
             } else {
                for(var j = 0; j < dp{{$avaliacao->avaliacao_departamento}}.length; j++) {
                    dp{{$avaliacao->avaliacao_departamento}}[j].style.display = 'none';
                }
             } 
        </script>
        @endif
        @endforeach
    </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>

<script>
var checkbox_required = $('input[type="checkbox"]');

checkbox_required.prop('required', true);

checkbox_required.on('click', function(){
    if (checkbox_required.is(':checked')) {
        checkbox_required.prop('required', false);
    } else {
        checkbox_required.prop('required', true);
    }
});
</script>

