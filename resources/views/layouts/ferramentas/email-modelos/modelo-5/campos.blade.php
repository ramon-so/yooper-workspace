<div id="campos-modelo-5" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 5 - Solicitações pendentes
    <form method="get" action="{{ route('email_rh_modelo_5') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome', value)" type="text" class="form-control"
                id="nome" placeholder="Nome" required name="nome">
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
