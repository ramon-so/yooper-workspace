<form method="post"
    action="/processo-seletivo/aprovar-processo/{{$processoSeletivo->id}}"
    enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
       Selecionar status</h6>
    <div class="form-group focused">
        <label class="form-control-label" for="status">Status</label>
        <select name="status_id" id="status" class="form-control-select" required>
            <option disabled selected value>Selecione o status</option>
            @foreach ($listaPs as $ps)
            <option value="{{ $ps->id }}">{{ $ps->nome }}
            </option>
            @endforeach
        </select>
    </div>
    <div clas="form-group">
         <label class="form-control-label" for="parecer">Parecer</label>
         <textarea class="form-control" name="parecer" required placeholder="Digite o parecer"></textarea>
         <input type="number" hidden name="processo_id" value="{{$processoSeletivo->id}}">
         <input type="number" hidden name="user_id" value="{{ Auth::user()->id }}">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
