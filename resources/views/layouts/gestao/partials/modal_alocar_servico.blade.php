<div class="adicionar-candidato-modal" id="alocar-servico">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_alocar_servico()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar contrato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form action="{{ route('alocar_servico') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Serviços contratados</h6>
                        <div class="row" id="form-content-alocar">
                            <input type="hidden" name="contrato_id" id="contrato_id_alocar">

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

