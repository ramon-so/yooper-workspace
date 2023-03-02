<div class="form-group focused">
    <label class="form-control-label" for="carclientego">Selecionar cliente</label>
    <select name="cliente_id" id="cliente" class="form-control-select" required>
        <option disabled selected value>Selecione o cliente</option>
        @foreach ($clientes as $cliente)
        <option value="{{ $cliente->id }}">{{ $cliente->empresa }}</option>
        @endforeach
    </select>
</div>
