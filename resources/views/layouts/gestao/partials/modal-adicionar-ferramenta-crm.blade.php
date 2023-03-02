<div class="adicionar-candidato-modal" id="adicionar-ferramenta-crm">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_ferramenta()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Adicionar ferramenta CRM
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form action="{{ route('adicionar_ferramenta') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Ferramentas</h6>
                        <div class="row" id="form-content-alocar">
                            <input type="hidden" name="contrato_id" id="contrato_id_ferramenta">
                            <input type="hidden" name="cliente_id" id="cliente_id_ferramenta">
                        </div>
                        <div class="row">
                            <select name="ferramenta" class="form-control" id="ferramenta">
                                <option value="" selected disabled>-- SELECIONE UMA FERRAMENTA --</option>
                                <option value="Active Campaign">Active Campaign</option>
                                <option value="AllIn">AllIn</option>
                                <option value="Dito">Dito</option>
                                <option value="Dinamize">Dinamize</option>
                                <option value="Edrone">Edrone</option>
                                <option value="E-goi">E-goi</option>
                                <option value="Emarsys">Emarsys</option>
                                <option value="Encharge">Encharge</option>
                                <option value="MailChimp">MailChimp</option>
                                <option value="Mailerlite">Mailerlite</option>
                                <option value="RD Station">RD Station</option>
                                <option value="Salesforce">Salesforce</option>
                            </select>
                        </div>
                        <div class="row mt-4">
                            <input type="text" name="login" class="form-control" placeholder="Login" id="">
                        </div>
                        <div class="row mt-4">
                            <input type="text" name="senha" class="form-control" placeholder="Senha" id="">
                        </div>
                        </div>
                    <div class="text-center">
                        <button class="btn btn-success mt-4">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

