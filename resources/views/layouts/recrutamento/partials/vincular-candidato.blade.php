<div class="adicionar-candidato-modal" id="vincular-candidato-modal-{{$processoSeletivo->processo_id}}">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" id="close-modal-candidato-{{$processoSeletivo->processo_id}}" onclick="vincularCandidatoFechar({{$processoSeletivo->processo_id}})">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Vincular candidato
                    </h4>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form method="post" action="/processo-seletivo/vincular-candidato/{{$processoSeletivo->processo_id}}" enctype="multipart/form-data" id="cadastrarCandidatoForm">
                @csrf
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
                        Informações do candidato</h6>
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">E-mail</label>
                        <input type="email" name="email" required class="form-control" id="input-name" placeholder="E-mail*" value="">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


