<div id="campos-modelo-9" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 9 - Comunicado clientes
    <form method="get" action="{{ route('email_rh_modelo_9') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <textarea spellcheck="true" wrap="hard" onchange="informacaoEmail('comunicado', value)" type="text" class="form-control"
            id="comunicado" placeholder="Comunicado" required name="comunicado"></textarea>
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
