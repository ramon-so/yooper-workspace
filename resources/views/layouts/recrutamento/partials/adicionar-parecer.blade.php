<div class="solicitacoes-cadastradas-modal" id="adicionar-parecer-modal-{{$processoSeletivo->processo_id}}">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal"
            id="close-modal-adicionar-parecer-{{$processoSeletivo->processo_id}}"
            onclick="adicionarParecerFechar({{$processoSeletivo->processo_id}})">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Adicionar parecer</h4>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="/processo-seletivo/{{$processoSeletivo->processo_id}}/adicionar-parecer"
                    enctype="multipart/form-data">
                    @csrf
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
                       Digitar o parecer</h6>
                    <div clas="form-group">
                        <label class="form-control-label" for="parecer">Parecer</label>
                        <textarea class="form-control" name="parecer" required
                            placeholder="Digite o parecer"></textarea>
                        <input type="number" hidden name="processo_id" value="{{$processoSeletivo->processo_id}}">
                        <input type="number" hidden name="user_id" value="{{ Auth::user()->id }}">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
