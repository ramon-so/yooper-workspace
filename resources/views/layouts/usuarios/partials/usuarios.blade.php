<form method="post" action="{{ route('criar_funcionario') }}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Cadastro
    </h6>
    <div class="form-group col-lg-6 float-left p-0">
        <label class="form-control-label" for="inputNome">Nome</label>
        <input type="text" class="form-control nome" id="inputNome" placeholder="Nome" required name="nome">
    </div>
    <div class="form-group col-lg-6 float-left p-0">
        <div class="input-container col-12 p-0 pl-lg-3">
            <label class="form-control-label col-12 clearfix" for="cpf">CPF</label>
            <input type="text" class="form-control-cpf cpfcnpj float-left" required placeholder="CPF" id="cpf" name="cpf">
            <span class="icon icon-ok float-left" style="display: none;"><i class="fas fa-check"></i></span>
            <span class="icon icon-erro float-left" style="display: flex;"><i class="fas fa-times"></i></span>
        </div>
    </div>
    <div class="form-group clearfix">
        <label class="form-control-label" for="inputEmail">E-mail</label>
        <input type="text" class="form-control nome" id="inputEmail" placeholder="E-mail" required name="email">
    </div>
    <div hidden class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ativo" id="inlineRadio1" checked value="Sim">
        <label class="form-check-label" for="inlineRadio1">Ativo</label>
    </div>
    <div class="form-group col-md-4 float-left p-0">
        <label class="form-control-label" for="sexp">Sexo</label>
        <select name="sexo" id="sexo" class="form-control-select" required>
            <option disabled selected value>Sexo</option>
            <option value="F">Feminino</option>
            <option value="M">Masculino</option>

        </select>
    </div>
    <div class="form-group col-md-8 float-left p-0 pl-lg-3">
        <label class="form-control-label" for="departamento">Selecione o departamento</label>
        <select name="departamento_id" id="departamento" class="form-control-select" required>
            <option disabled selected value>Selecione o departamento</option>
            @foreach ($listaDp as $dp)
            <option value="{{ $dp->id }}">{{ $dp->departamento }}</option>
            @endforeach
        </select>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
