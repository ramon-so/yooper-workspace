<div id="campos-modelo-12" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 12 - Boas vindas clientes
    <form method="get" action="{{ route('email_rh_modelo_12') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome', value)" type="text" class="form-control"
                id="nome" placeholder="Nome" required name="nome">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('cliente', value)" type="text" class="form-control"
            id="cliente" placeholder="Nome do cliente" required name="cliente">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('whatsapp', value)" type="text" class="form-control"
                id="whatsapp" placeholder="Whatsapp" required name="whatsapp">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('email', value)" type="text" class="form-control"
                id="email" placeholder="E-mail" required name="email">
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
