<div class="form-group focused">
    <label class="form-control-label" for="cargo">Selecionar cargo</label>
    <select name="cargo_id" id="cargo" class="form-control-select" required>
        <option disabled selected value>Selecione o cargo</option>
        @foreach ($listaCg as $cg)
        <option value="{{ $cg->id }}">{{ $cg->nome }}</option>
        @endforeach
    </select>
</div>
