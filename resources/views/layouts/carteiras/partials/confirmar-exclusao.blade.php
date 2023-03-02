<div class="solicitacoes-cadastradas-modal" id="excluir-modal">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="assets/img/icons/close.webp" class="close-modal" onclick="fechar_modal_excluir()" id="close-modal-atribuir">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Exclusão de carteira</h3>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="{{ route('excluir_carteira') }}" enctype="multipart/form-data">
                    @csrf
                    <h6 id="mensagem" class="heading-small text-muted mb-4 text-center text-lg-left"></h6>
                    <input name="funcionario_id" type="hidden" id="funcionario_id"> 
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-danger mt-4">Sim, confirmar exclusão</button>
                        <button type="button" onclick="fechar_modal_excluir()" class="btn btn-primary mt-4">Não, Cancelar exclusão</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<script src="assets/js/api_cep.js" type="module" defer></script>
<script src="assets/js/api_cnpj.js" type="module" defer></script>

<script type="text/javascript">
    function abrir_modal_excluir(analista, id){
        document.getElementById('funcionario_id').value = id;
        document.getElementById('mensagem').innerHTML = "Este procedimento removerá todos os clientes do analista: " + analista + ". <br> Deseja confirmar a exclusão?";
        document.getElementById('excluir-modal').classList.add("modal-visivel");
    }

    function fechar_modal_excluir(){
        document.getElementById('excluir-modal').classList.remove("modal-visivel");
    }
</script>
