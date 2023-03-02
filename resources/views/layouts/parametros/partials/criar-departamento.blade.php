<form id="dp_criar" method="post" action="{{ route('criar_departamento') }}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do
        Departamento
    </h6>
    <div hidden class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ativo" id="inlineRadio1" checked value="Sim">
        <label class="form-check-label" for="inlineRadio1">Ativo</label>
    </div>
    <div class="form-group p-0">
        <label class="form-control-label" for="departamento">Nome do departamento</label>
        <input type="text" class="form-control" autofocus id="departamento" name="departamento"
            placeholder="Nome do departamento">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
