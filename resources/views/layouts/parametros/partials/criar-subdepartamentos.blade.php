<form id="sd_criar" method="post" action="{{ route('criar_subdepartamentos') }}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do
        Sub Departamentos
    </h6>
    <div hidden class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ativo" id="inlineRadio1" checked value="Sim">
        <label class="form-check-label" for="inlineRadio1">Ativo</label>
    </div>
    <div class="form-group p-0">
        <label class="form-control-label" for="departamento">Selecione o departamento</label>
        <select name="departamento_id" id="departamento" class="form-control-select" required>
            <option disabled selected value>Selecione o departamento</option>
            @foreach ($listaDp as $dp)
                @if ($dp->ativo == 'Sim')
                    <option value="{{ $dp->departamento_id }}">{{ $dp->departamento }}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="form-group p-0">
        <label class="form-control-label" for="nome">Nome do sub departamento</label>
        <input type="text" class="form-control" autofocus id="subdepartamento" name="nome"
            placeholder="Nome do sub departamento">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
