<div id="campos-modelo-6" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 6 - Bandeiras Yooper
    <form method="get" action="{{ route('email_rh_modelo_6') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

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
