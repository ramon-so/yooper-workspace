<form method="post" action="{{ route('cadastrar-demanda-store') }}">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Cadastrar nova demanda
    </h6>
    <div class="form-group">
        <label class="form-control-label" for="quantidade">Quantidade de demanda:</label>
        <input id="quantidade-demanda" onblur="quantidadeInsert(this.value)" name="quantidade" type="number" required min="1"
            max="15" class="form-control mb-2" value="" placeholder="Min. 1 e Max. 15 demandas">
    </div>
    <div class="form-group">
        <select name="cliente_lista" id="clientes" class="form-control-select" required>
            <option disabled selected value>Selecione o cliente</option>
            @foreach ($clientes_nomes as $cliente)
            <option value="{{ $cliente['id_board'] }}">{{ $cliente['nome'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <select name="referencia_lista" id="referencia" class="form-control-select mt-2" required>
            <option disabled selected value>Selecione a Referência</option>
            <option value="JAN/2023">JANEIRO/2023</option>
            <option value="FEV/2023">FEVEREIRO/2023</option>
            <option value="MAR/2023">MARÇO/2023</option>
            <option value="ABR/2023">ABRIL/2023</option>
            <option value="MAI/2023">MAIO/2023</option>
            <option value="JUN/2023">JUNHO/2023</option>
            <option value="OUT/2022">OUTUBRO/2022</option>
            <option value="NOV/2022">NOVEMBRO/2022</option>
            <option value="DEZ/2022">DEZEMBRO/2022</option>
        </select>
    </div>
    <div class="form-group">
        <input name="servico_demanda" id="servico-demanda" 
            style="background-color:#b5b3b3; color:white;" type="text" required class="readonly form-control mt-2"
            placeholder="Serviço">
    </div>
    <div class="form-group">
        <input id="tipo-demanda" name="tipo_demanda" style="background-color:#b5b3b3; color:white;" type="text" required
            class="readonly form-control mt-2" placeholder="Tipo de Ação">
    </div>
    <div id="lista-demandas"></div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Cadastrar no Plano Integrado</button>
    </div>
</form>
