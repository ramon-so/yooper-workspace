<div class="solicitacoes-cadastradas-modal" id="usuarios-modal">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="assets/img/icons/close.webp" class="close-modal" id="close-modal-usuarios">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastrar usuarios</h4>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="{{ route('cadastrar-usuarios') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do usuarios</h6>
                    <div class="form-group">
                        <label class="form-control-label" for="input-nome">Nome</label>
                        <input type="text" name="nome" class="form-control" id="input-nome" placeholder="Nome">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">E-mail</label>
                        <input type="text" name="email" class="form-control" id="input-email" placeholder="E-mail">
                    </div>
                      <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Senha</label>
                        <input type="text" name="senha" class="form-control" id="input-senha" placeholder="Senha">
                    </div>
                    <div class="form-group p-0">
                        <label class="form-control-label" for="departamento">Selecionar conta</label>
                        <select name="conta_id" id="conta" class="form-control-select" required>
                            <option disabled selected value>Selecione a conta</option>
                            @foreach ($ordem_contas as $conta)
                                @if ($conta->status == 'Ativo')
                                    <option value="{{ $conta->id }}">{{ $conta->cliente }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
