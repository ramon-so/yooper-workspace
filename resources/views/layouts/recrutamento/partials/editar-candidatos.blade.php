<form method="post"
    action="/processo-seletivo/{{$processoSeletivo->processo_id}}/editar-candidato/{{$candidato->candidato_id}}"
    enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
        Informações do candidato</h6>
    <div class="form-group">
        <input type="number" name="user_id" required class="form-control" hidden value="{{ Auth::user()->id }}">
        <input type="number" name="processo_seletivo_id" required class="form-control" hidden
            value="{{$processoSeletivo->processo_id}}">
        <label class="form-control-label" for="input-name">Nome</label>
        <input type="text" name="nome" required class="form-control" id="input-name" placeholder="Nome*"
            value="{{$candidato->candidato_nome}}">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-email">E-mail</label>
        <input type="email" name="email" required class="form-control" id="input-name" placeholder="E-mail*"
            value="{{$candidato->candidato_email}}">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-telefone">Telefone</label>
        <input type="text" required name="telefone" class="form-control" id="input-telefone" placeholder="Telefone*"
            value="{{$candidato->candidato_telefone}}">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-linkedin">Linkedin</label>
        <input type="text" required name="linkedin_link" class="form-control" value="{{ $candidato->candidato_linkedin }}" id="input-linkedin" placeholder="Linkedin">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-file">Adicionar
            currículo</label>
        <input type="file" id="input-file" class="form-control" value="{{ $candidato->candidato_curriculo }}" name="curriculo_anexo">
    </div>
    {{-- <div class="form-group focused">
        <label class="form-control-label" for="status">Status</label>
        <select name="status_id" id="status" class="form-control-select" required>
            <option disabled selected value="">Selecione o status</option>
            @foreach ($listaStc as $stc)
            <option value="{{ $stc->id }}">{{ $stc->nome }}
            </option>
            @endforeach
        </select>
    </div> --}}
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
