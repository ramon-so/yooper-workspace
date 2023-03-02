<div id="campos-modelo-8" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 8 - Promoção colaborador
    <form method="get" action="{{ route('email_rh_modelo_8') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('cargo', value)" type="text" class="form-control"
            id="cargo" placeholder="Cargo" required name="cargo">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('salario', value)" type="text" class="form-control"
            id="salario" placeholder="Salario" required name="salario">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('data', value)" type="text" class="form-control"
            id="data" placeholder="Data" required name="data">
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
