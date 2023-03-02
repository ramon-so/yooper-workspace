<form method="post" action="{{ route('cadastrar-avaliacao') }}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Cadastrar nova avaliação
    </h6>
    <div class="form-group">
        <label class="form-control-label" for="nome-avaliacao">Nome</label>
        <input id="nome-avaliacao" name="nome" type="text" required class="form-control mb-2"
            placeholder="Nome da avaliação">
        <input id="status" hidden name="status" type="text" class="form-control mb-2" value="Ativo">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="tipo-avaliacao">Selecione o tipo</label>
        <select name="tipo" id="tipo-avaliacao" class="form-control-select mt-2" required>
            <option disabled selected value>Selecione o tipo</option>
            <option value="Padrão">Padrão</option>
            <option value="Técnico">Técnico</option>
        </select>
    </div>
    @include('layouts.template-partials.partials.selecionar-departamento')
    <div class="form-group clearfix">
        <div class="col-6 float-left pl-0 ml-0">
            <label class="form-control-label" for="quantidade-dissertativa">Qtd dissertativas</label>
            <input id="quantidade-dissertativa" name="qtd_dissertativa" type="number" required min="0" max="20"
                class="form-control mb-2" placeholder="Min. 0 e Max. 20 dissertativas">
        </div>
        <div class="col-6 float-left clearfix pr-0 mr-0"> 
            <label class="form-control-label" for="quantidade-alternativa">Qtd alternativas</label>
            <input id="quantidade-alternativa" name="qtd_alternativa" type="number" required min="0" max="20"
                class="form-control mb-2" placeholder="Min. 0 e Max. 20 alternativas">
        </div>
    </div>

    <div class="form-group d-flex flex-column flex-md-row clearfix justify-content-center">
        <span id="btn-limpar-dissertativas">Limpar dissertativas</span>
        <span id="btn-limpar-alternativas">Limpar alternativas</span>
    </div>
    <div id="lista-dissertativas"></div>
    <div id="lista-alternativas"></div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
