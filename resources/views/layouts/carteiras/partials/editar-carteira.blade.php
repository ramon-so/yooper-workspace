<div class="solicitacoes-cadastradas-modal" id="editar-modal">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="assets/img/icons/close.webp" class="close-modal" onclick="fechar_modal_editar()" id="close-modal-atribuir">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Remover cliente da carteira</h3>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="{{ route('excluir_cliente_carteira') }}" enctype="multipart/form-data">
                    @csrf
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Selecione o cliente</h6>
                    <input name="funcionario_id_excluir" type="hidden" id="funcionario_id_excluir"> 
                    <select class="form-control" name="contrato_id" id="contrato">
                        
                    </select>
                    
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

<script type="text/javascript">
    function abrir_modal_editar(razao_social, id){
        razao_social = JSON.parse(razao_social);
        console.log(id);
        document.getElementById('funcionario_id_excluir').value = id;
        console.log(razao_social);
        for (i = 0; i < razao_social.length; i++) {
            console.log(razao_social[i]);
            $('#contrato').append('<option value='+razao_social[i].contrato_id+'>' + razao_social[i].empresa + '</option>');
        }
        document.getElementById('editar-modal').classList.add("modal-visivel");
    }

    function fechar_modal_editar(){
        document.getElementById('editar-modal').classList.remove("modal-visivel");
    }
</script>
