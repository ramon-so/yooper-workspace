<div class="adicionar-candidato-modal" id="ativar-contrato">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" id="close-modal-candidato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Ativar contrato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form>
                    @csrf
                    <div class="form-group">
                        <label class="form-control-label" for="input-data">Data Kickoff</label>
                        <input type="text" name="datakickoff" class="form-control" id="datakickoff"
                            placeholder="__/__/____">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-data">Fee</label>
                        <input type="text" name="fee" class="form-control money2" id="fee"
                            placeholder="Fee do contrato">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success mt-4">Ativar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

