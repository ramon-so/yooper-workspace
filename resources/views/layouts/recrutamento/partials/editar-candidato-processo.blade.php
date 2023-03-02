 @foreach ($processosSeletivo as $processoSeletivo)
<div class="solicitacoes-cadastradas-modal" id="editar-modal-{{$candidato->candidato_id}}">
    <div class="col-lg-5 solicitacao-processo-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal"
            id="close-modal-{{$candidato->candidato_id}}" onclick="candidatoEditarFechar({{$candidato->candidato_id}})">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar candidato
                    </h4>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form method="post"
                    action="/processo-seletivo/{{$processoSeletivo->processo_id}}/editar-candidato/{{$candidato->candidato_id}}"
                    enctype="multipart/form-data">
                    @csrf
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
                        Informações do candidato</h6>
                    <div class="form-group">
                      <input type="number" class="form-control" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <label class="form-control-label" for="input-name">Nome</label>
                        <input type="text" name="nome" required class="form-control" id="input-name" placeholder="Nome*"
                            value="{{$candidato->candidato_nome}}">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-email">E-mail</label>
                        <input type="email" name="email" class="form-control" required id="input-name"
                            placeholder="E-mail*" value="{{$candidato->candidato_email}}">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label"
                            for="input-telefone-{{$candidato->candidato_id}}">Telefone</label>
                        <input type="text" required name="telefone" class="form-control"
                            id="input-telefone-{{$candidato->candidato_id}}" placeholder="Telefone*"
                            value="{{$candidato->candidato_telefone}}">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-linkedin">Linkedin</label>
                        <input type="text" required name="linkedin_link" class="form-control"
                            value="{{ $candidato->candidato_linkedin }}" id="input-linkedin" placeholder="Linkedin">
                    </div>
                    <div class="form-group">
                        <label class="form-control-label" for="input-file">Adicionar
                            currículo</label>
                        <input type="file" id="input-file" class="form-control" value="{{ $candidato->curriculo }}"
                            name="curriculo_anexo">
                    </div>
                    <div class="form-group focused">
                        <label class="form-control-label" for="status">Fonte de Captação</label>
                        <select name="captacao_id" id="captacao-processo" class="form-control-select" required>
                            <option disabled selected value="{{ $candidato->captacao_id }}">{{ $candidato->captacao_nome }}</option>
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
@endforeach

<script>
    $("#input-telefone-{{$candidato->candidato_id}}").mask("(99) 99999-9999");

</script>
