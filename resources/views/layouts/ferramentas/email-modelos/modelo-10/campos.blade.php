<div id="campos-modelo-10" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 10 - Retorno Proposta PJ    
    <form method="get" action="{{ route('email_rh_modelo_10') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome', value)" type="text" class="form-control"
                id="nome" placeholder="Nome" required name="nome">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('data_inicio', value)" type="text" class="form-control"
                id="data-inicio" placeholder="Data de início do trabalho " required name="data_inicio">
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
