<div class="solicitacoes-cadastradas-modal" id="cliente-modal">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="assets/img/icons/close.webp" class="close-modal" id="close-modal-cliente">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastrar Cliente</h3>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="{{ route('cadastrar-cliente') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- Empresa --}}
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações da empresa</h6>
                    <p id="empresa"></p>

                    <div class="image-upload">
                        <label for="uploadImage">
                            <img src="{{ asset('assets') }}/img/icons/upload-image.png" id="uploadPreview"
                                style="width:60px;">
                        </label>
                        <input id="uploadImage" type="file" name="foto" onchange="PreviewImage();"
                            accept="image/png, image/jpeg">
                    </div>


                    <div class="form-group">
                        <label class="form-control-label" for="input-cnpj">CNPJ</label>
                        <input type="text" class="form-control" required="" placeholder="CNPJ" id="cnpj"
                            name="cnpj" maxlength="18">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-nome">Cliente</label>
                        <input type="text" name="cliente" class="form-control" id="empresa" placeholder="Cliente">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Razão Social</label>
                        <input type="text" name="razaosocial" class="form-control" id="razaosocial"
                            placeholder="Razão Social">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Site</label>
                        <input type="text" name="site" class="form-control" id="site"
                            placeholder="Site">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Arquivo Raio X</label>
                        <input type="file" name="raiox" class="form-control" id="raiox"
                            placeholder="Raio X">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Análise inicial</label>
                        <input type="file" name="analise_inicial" class="form-control" id="analise_inicial"
                            placeholder="Análise inicial">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Briefing</label>
                        <input type="file" name="briefing" class="form-control" id="briefing"
                            placeholder="Briefing">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-cliente">Modelo de negócio</label>
                        <input type="text" name="modelo_negocio" class="form-control" id="modelo_negocio"
                            placeholder="Modelo de negócio">
                    </div>


                    {{-- Localização --}}
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Endereço da Empresa</h6>
                    <div class="form-group">
                        <label class="form-control-label form-control-cep cep" for="input-cep">CEP</label>
                        <input type="text" name="cep" class="form-control" id="cep" placeholder="CEP"
                            maxlength="8">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-logradouro">Logradouro</label>
                        <input type="text" name="endereco" class="form-control" id="endereco"
                            placeholder="Endereço">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-logradouro">Número</label>
                        <input type="text" name="numero" class="form-control" id="numero" placeholder="Número">

                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-logradouro">Complemento</label>
                        <input type="text" name="complemento" class="form-control" id="complemento"
                            placeholder="Complemento">
                    </div>


                    <div class="form-group">
                        <label class="form-control-label" for="input-bairro">Bairro</label>
                        <input type="text" name="bairro" class="form-control" id="bairro" placeholder="Bairro">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-cidade">Cidade</label>
                        <input type="text" name="cidade" class="form-control" id="cidade" placeholder="Cidade">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-estado">Estado</label>
                        <input type="text" name="uf" class="form-control" id="estado" placeholder="UF">
                    </div>

                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Responsável pela Empresa</h6>
                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-emp-nome">Nome do responsável</label>
                        <input type="text" name="resp_emp_nome" class="form-control" id="resp-emp-nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-emp-email">E-mail do responsável</label>
                        <input type="email" name="resp_emp_email" class="form-control" id="resp-emp-email" placeholder="E-mail">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-emp-telefones">Telefone ou Celular do responsável</label>
                        <input type="text" name="telefone_emp" class="form-control" id="resp-emp-telefones" placeholder="Telefone">
                    </div>


                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Responsável Financeiro pela Empresa</h6>
                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-nome">Nome do responsável</label>
                        <input type="text" name="resp_fin_nome" class="form-control" id="resp-fin-nome" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-email">E-mail do responsável</label>
                        <input type="email" name="resp_fin_email" class="form-control" id="resp-fin-email" placeholder="E-mail">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-telefones">Telefone ou Celular do responsável</label>
                        <input type="tel" name="telefone_fin" maxlength="15" onkeyup="handlePhone(event)" class="form-control" id="resp-fin-telefones" placeholder="Telefone">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-telefones">data de faturamento</label>
                        <input type="date" name="data_faturamento" maxlength="15" onkeyup="" class="form-control" id="resp-fin-telefones" placeholder="Telefone">
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-telefones">Plataforma</label>
                        <select name="plataforma" class="form-control" id="">
                            <option value="">---</option>
                            <option value="">Site institucional</option>
                            <option value="">Vtex</option>
                            <option value="">Tray / Fbits</option>
                            <option value="">Nuvem shop</option>
                            <option value="">Plataforma própria</option>
                            <option value="">Linx</option>
                            <option value="">Jet</option>
                            <option value="">Magento</option>
                            <option value="">Shopify</option>
                            <option value="">Loja integrada</option>
                            <option value="">Outra</option>
                            <option value="">Aguardando</option>
                            <option value="">F1</option>
                            <option value="">Megazord</option>
                            <option value="">WooComerce</option>
                            <option value="">MercadoShops</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-telefones">Total de funcionarios</label>
                        <select name="total_funcionarios" class="form-control" id="">
                            <option value="">---</option>
                            <option value="">Mais de 100</option>
                            <option value="">50 a 100</option>
                            <option value="">25 a 50</option>
                            <option value="">10 a 25</option>
                            <option value="">Menos de 10</option>
                            <option value="">Aguardando</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-telefones">Tempo de operação online</label>
                        <select name="operacao_online" class="form-control" id="">
                            <option value="">---</option>
                            <option value="">Mais de 3 anos</option>
                            <option value="">1 a 3 anos</option>
                            <option value="">Site novo / Em desenvolvimento</option>
                            <option value="">Aguardando</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-control-label" for="input-resp-fin-telefones">Uma das bandeiras da Yooper é a Causa Animal. Você realiza ou terceriza testes em animais?
                        </label>
                        <select name="testes_animais" class="form-control" id="">
                            <option value="">---</option>
                            <option value="">Sim</option>
                            <option value="">Não</option>
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


<script src="assets/js/api_cep.js" type="module" defer></script>
<script src="assets/js/api_cnpj.js" type="module" defer></script>

<script>
    $("#cnpj").mask("99.999.999/9999-99");
    $("#resp-emp-telefones").mask("(00) 0 0000-0000");
    $("#resp-fin-telefones").mask("(00) 0 0000-0000");
    // PREVIEW FOTO
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>

<style type="text/css">
    .image-upload>input {
        display: none;

    }

    #uploadPreview {
        cursor: pointer;
    }
</style>
