<form method="post"
    action="/processo-seletivo/fechamento-processo/{{$processoSeletivo->id}}"
    enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">
       Selecionar status</h6>
    <div class="form-group focused">
        <label class="form-control-label" for="status">Status de Fechamento</label>
        <select name="status_fechamento" id="status" class="form-control-select" required>
            <option disabled selected value>Selecione o status</option>
            <option value="Fechada Antes do Prazo">Fechada Antes do Prazo
            </option>
            <option value="Fechada Antes do Prazo">Fechada no Prazo
            </option>
            <option value="Fechada Antes do Prazo">Fechada depois do Prazo
            </option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-fechamento">Data Fechamento</label>
        <input type="date" value="" name="data_fechamento" class="form-control input-fechamento" required id="input-fechamento"
            placeholder="Deadline">
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
