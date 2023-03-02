<div id="campos-modelo-1" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 1 - Boas-vindas
    <form method="get" action="{{ route('email_rh_modelo_1') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome-destinatario', value)" type="text" class="form-control"
                id="nome-destinatario" placeholder="Nome do destinatário" required name="nome_destinatario">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('cargo',value)" type="text" class="form-control" id="cargo"
                placeholder="Cargo" required name="cargo">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('admissao',value)" type="text" class="form-control" id="admissao"
                placeholder="Admissão" required name="admissao">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('regime',value)" type="text" class="form-control" id="regime"
                placeholder="Regime de contratação" required name="regime">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input type="text" onchange="informacaoEmail('horario',value)" class="form-control" value="Seg. à Sex - 09h às 18h" id="horario"
                placeholder="Horário de trabalho" required name="horario">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input type="text" onchange="informacaoEmail('remuneracao',value)" class="form-control" id="remuneracao"
                placeholder="Remuneração fixa bruta" required name="remuneracao">
        </div>
        <button type="submit" onclick="downloadHTML()" class="btn btn-primary">Gerar e-mail HTML</button>
</div>
</form>


<script>
    function informacaoEmail(campo, valor) {
        // mostrar campos
        var valor = $(`#${campo}`).val();
        console.log(valor);
        document.getElementById(`view-${campo}`).innerHTML = valor;
    }
</script>
