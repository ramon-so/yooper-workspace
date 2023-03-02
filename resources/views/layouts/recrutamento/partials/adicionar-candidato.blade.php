<div class="adicionar-candidato-modal" id="adicionar-candidato-modal-{{$processoSeletivo->processo_id}}">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" id="close-modal-candidato-{{$processoSeletivo->processo_id}}" onclick="adicionarCandidatoFechar({{$processoSeletivo->processo_id}})">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Adicionar candidato
                    </h4>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form method="post" action="/processo-seletivo/adicionar/{{$processoSeletivo->processo_id}}" enctype="multipart/form-data" id="cadastrarCandidatoForm">
                @csrf
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
                        Informações do candidato</h6>
                    <div class="form-group">
                        <input type="number" name="user_id" required class="form-control" hidden  value="{{ Auth::user()->id }}">
                         <input type="number" name="processo_seletivo_id" required class="form-control" hidden  value="{{$processoSeletivo->processo_id}}">
                        <label class="form-control-label" for="input-name">Nome</label>
                        <input type="text" name="nome" required class="form-control" id="input-name" placeholder="Nome" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">E-mail</label>
                        <input type="email" name="email" required class="form-control" id="input-name" placeholder="E-mail" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-telefone">Telefone</label>
                        <input type="text" required name="telefone" class="form-control" id="input-telefone" placeholder="Telefone" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-linkedin">Linkedin</label>
                        <input type="text" required name="linkedin_link" class="form-control" id="input-linkedin" placeholder="Linkedin" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-file">Adicionar
                            currículo</label>
                        <input type="file" id="input-file" class="form-control" name="curriculo_anexo">
                        <input type="text" id="input-status" class="form-control" hidden name="status_id" value="1">
                    </div>
                    <div class="form-group focused">
                        <label class="form-control-label" for="status">Fonte de Captação</label>
                        <select name="captacao_id" id="captacao-processo" class="form-control-select" required>
                            <option disabled selected value>Selecione a fonte de captação</option>
                            @foreach ($listaCp as $cp)
                            <option value="{{ $cp->id }}">{{ $cp->nome }}
                            </option>
                            @endforeach
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

<script>
    $("#input-telefone").mask("(99) 99999-9999");
</script>

