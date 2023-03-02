<div class="adicionar-candidato-modal" id="cancelar-contrato">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_cancelar_contrato()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Excluir contrato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <h2>Cancelar contrato</h2>
                <form action="{{ route('excluir_contrato') }}" id="form_excluir" method="POST">
                    @csrf
                    <select name="contrato" class="form-control" id="contratosSelect">
                    </select>
                    <div class="form-group">
                        <div class="row" id="form-content-alocar">
                            <div class="col">
                                <label for="">Data de solicitação de cancelamento</label>
                                <input type="date" class="form-control" name="data_solicitacao_cancelamento" id="data_solicitacao_cancelamento">
                            </div>
                            <div class="col">
                                <label for="">Data do ultimo dia </label>
                                <input type="date" class="form-control" name="data_ultimo_dia" id="data_ultimo_dia">
                            </div>
                        </div>
                    </div>
                </form>
                <div class="text-center">
                    <button class="btn btn-succes mt-4" onclick="fechar_modal_cancelar_contrato()">Cancelar</button>
                    <button class="btn btn-danger mt-4" onclick="cancelar_contrato()">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
</script>



