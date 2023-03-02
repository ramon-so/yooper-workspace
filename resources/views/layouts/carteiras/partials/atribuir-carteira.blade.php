<div class="solicitacoes-cadastradas-modal" id="atribuir-modal">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="assets/img/icons/close.webp" class="close-modal" onclick="fechar_modal()" id="close-modal-atribuir">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Atribuir cliente à carteira</h3>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="{{ route('adicionar_cliente_carteira') }}" enctype="multipart/form-data">
                    @csrf
                    <p id="razao_social"></p>
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Selecione o analista</h6>
                    <input name="contrato_id" type="hidden" id="contrato_id"> 
                    <select class="form-control" name="analista" id="analista">
                        @foreach($analistas AS $analista)
                            <option value="{{$analista->id}}">{{$analista->nome}}</option>
                        @endforeach
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
    function abrir_modal(razao_social, id, contrato_id){
        document.getElementById('contrato_id').value = contrato_id;
        document.getElementById('razao_social').innerText = razao_social;
        document.getElementById('atribuir-modal').classList.add("modal-visivel");
    }

    function fechar_modal(){
        document.getElementById('atribuir-modal').classList.remove("modal-visivel");
    }
</script>
