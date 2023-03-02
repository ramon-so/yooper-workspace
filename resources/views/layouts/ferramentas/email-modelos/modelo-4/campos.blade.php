<div id="campos-modelo-4" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 4 - Agradecimento de retorno
    <form method="get" action="{{ route('email_rh_modelo_4') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome', value)" type="text" class="form-control"
                id="nome" placeholder="Nome" required name="nome">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('data_exame', value)" type="text" class="form-control"
            id="data-exame" placeholder="Data do Exame" required name="data_exame">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('data_inicio', value)" type="text" class="form-control"
                id="data-inicio" placeholder="Data de início do trabalho " required name="data_inicio">
        </div>
        <div class="form-group mt-2 col-md-12">
            <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="checkestagio" name="estagio" value="Sim">
                <label class="custom-control-label" for="checkestagio">Estágio?</label>
            </div>
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
