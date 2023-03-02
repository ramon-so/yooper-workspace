<div class="adicionar-candidato-modal" id="excluir-contrato">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_excluir()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Excluir contrato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <h2>Deseja excluir o contrato?</h2>
                <p>Ao excluir o contrato <b>NÃO SERÁ POSSÍVEL RECUPERA-LO</b> deseja confirmar?</p>
                <form action="{{ route('excluir_contrato') }}" id="form_excluir" method="POST">
                    @csrf
                    <input type="hidden" name="contrato_id" value="" id="contrato_id_excluir">
                </form>
                <div class="text-center">
                    <button class="btn btn-succes mt-4" onclick="fechar_modal_excluir()">Cancelar</button>
                    <button class="btn btn-danger mt-4" onclick="submit_form_excluir()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function submit_form_excluir(){
        document.getElementById('form_excluir').submit();
    }
</script>



