<div class="form-group focused">
    <label class="form-control-label" for="departamento_solicitacao">Selecione o departamento</label>
    <select name="departamento_id" id="departamento_solicitacao" class="form-control-select" required onchange="subDepartamento()">
        <option disabled selected value>Selecione o departamento</option>
        @foreach ($listaDp as $dp)
        <option value="{{ $dp->id }}">{{ $dp->departamento }}</option>
        @endforeach
    </select>
</div>