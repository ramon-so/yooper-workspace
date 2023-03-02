<div id="campos-modelo-2" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 2 - Suas férias chegou
    <form method="get" action="{{ route('email_rh_modelo_2') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome', value)" type="text" class="form-control"
                id="nome" placeholder="Nome" required name="nome">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('setor', value)" type="text" class="form-control"
            id="Setor" placeholder="Setor" required name="setor">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('data_limite', value)" type="text" class="form-control"
                id="data-limite" placeholder="Data Limite" required name="data_limite">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('qtd_dias', value)" type="text" class="form-control"
                id="qtd-dias" placeholder="Qtd. de Dias" required name="qtd_dias">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome_gestor', value)" type="text" class="form-control"
                id="nome-gestor" placeholder="Nome do Gestor" required name="nome_gestor">
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
