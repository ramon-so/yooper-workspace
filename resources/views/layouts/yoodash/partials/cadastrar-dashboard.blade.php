<div class="solicitacoes-cadastradas-modal" id="dashboard-modal">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="assets/img/icons/close.webp" class="close-modal" id="close-modal-dashboard">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastrar Dashboard</h4>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="{{ route('cadastrar-dashboard') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do dashboard</h6>
                    <div class="form-group">
                        <label class="form-control-label" for="input-conta">Conta</label>
                        <input type="text" name="conta" class="form-control" id="input-conta" placeholder="Conta">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Cliente</label>
                        <input type="text" name="cliente" class="form-control" id="input-cliente" placeholder="Cliente">
                    </div>
                      <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Empresa</label>
                        <input type="text" name="empresa" class="form-control" id="input-empresa" placeholder="Empresa">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-qtd">Quantidade de usuários</label>
                        <input type="number" name="qtd_usuarios" class="form-control" id="input-qtd" placeholder="Quantidade de usuários">
                        <input type="text" name="logo" value="yooper.png" class="form-control" id="input-logo"  hidden>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-dashid">Id do dashboard</label>
                        <input type="text" name="dashboard_id" class="form-control" id="input-dashid" placeholder="Id do dashboard">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Plataformas de e-commerce</label>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkvtex" name="integracoes[]" value="VTEX">
                            <label class="custom-control-label" for="checkvtex">VTEX</label>
                        </div>
                         <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkfbits" name="integracoes[]" value="FBITS">
                            <label class="custom-control-label" for="checkfbits">FBITS</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checktray" name="integracoes[]" value="TRAY">
                            <label class="custom-control-label" for="checktray">TRAY</label>
                        </div>
                       <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkshopify" name="integracoes[]" value="SHOPIFY">
                            <label class="custom-control-label" for="checkshopify">SHOPIFY</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkvnda" name="integracoes[]" value="VNDA">
                            <label class="custom-control-label" for="checkvnda">VNDA</label>
                        </div>
                        <label class="form-control-label">Gestão de Mídia</label>
                         <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkfads" name="integracoes[]" value="FADS">
                            <label class="custom-control-label" for="checkfads">Facebook Ads</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkgads" name="integracoes[]" value="GADS">
                            <label class="custom-control-label" for="checkgads">Google Ads</label>
                        </div>
                         <label class="form-control-label">Outros</label>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkga" name="integracoes[]" value="GA">
                            <label class="custom-control-label" for="checkga">Google Analytics</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="checkgsc" name="integracoes[]" value="GSC">
                            <label class="custom-control-label" for="checkgsc">Google Search Console</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-monday">Monday embed</label>
                        <input type="text" name="monday_embed" class="form-control" id="input-monday" placeholder="Monday embed">
                    </div>
                     <div class="form-group">
                        <label class="form-control-label" for="input-planoid">Id do plano integrado</label></label>
                        <input type="number" name="plano_integrado_id" class="form-control" id="input-planoid" placeholder="Id do plano integrado">
                        <input type="text" name="status" value="Ativo" class="form-control" id="input-status"  hidden>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
