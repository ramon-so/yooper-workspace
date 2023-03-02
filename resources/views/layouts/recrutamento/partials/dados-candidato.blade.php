<div class="editar-processo-modal" id="editar-processo-modal-1">
    <div class="col-lg-5 editar-processo-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" id="close-modal-1">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Dados do Candidato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form>
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
                        Informações do candidato</h6>
                    <div class="form-group">
                        <label class="form-control-label" for="input-name">Nome</label>
                        <input type="text" class="form-control" id="input-name" placeholder="Nome"
                            value="Jose Henrique">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">E-mail</label>
                        <input type="text" class="form-control" id="input-name" placeholder="Email"
                            value="jose.henrique@email.com">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-telefone">Telefone</label>
                        <input type="text" class="form-control" id="input-telefone" placeholder="Telefone"
                            value="(11) 99999-9999">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-linkedin">Linkedin</label>
                        <input type="text" class="form-control" id="input-linkedin" placeholder="Linkedin"
                            value="www.linkedin.com/jose.henrique">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-file">Adicionar
                            currículo</label>
                        <input type="file" class="form-control-select" id="input-file" accept=".pdf">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success mt-4">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
