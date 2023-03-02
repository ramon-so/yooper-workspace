<form method="post" action="{{ route('processo-seletivo-solicitacao-cadastrar') }}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do processo
        seletivo</h6>
    <div class="form-group">
        <label class="form-control-label" for="input-name">Título</label>
        <input type="text" name="titulo" class="form-control" id="input-name" placeholder="Título">
    </div>
    @include('layouts.template-partials.partials.selecionar-departamento')
    {{-- @include('layouts.template-partials.partials.selecionar-cargo') --}}

    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
