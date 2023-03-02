<div id="campos-modelo-7" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 7 - Acessos
    <form method="get" action="{{ route('email_rh_modelo_7') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome', value)" type="text" class="form-control"
            id="nome" placeholder="Nome" required name="nome">
        </div>
        
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('email', value)" type="text" class="form-control"
                id="email" placeholder="E-mail" required name="email">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('senha', value)" type="text" class="form-control"
            id="senha" placeholder="Senha" required name="senha">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('datas', value)" type="text" class="form-control"
                id="datas" placeholder="Datas" required name="datas">
        </div>
        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('mes', value)" type="text" class="form-control"
                id="mes" placeholder="Mês" required name="mes">
        </div>
        <div class="form-group mt-2 col-md-12">
            <select name="pronome" class="form-control" required>
                    <option disabled selected value> Selecione o pronome</option>
                    <option value="elu">Elu</option>
                    <option value="ela">Ela</option>
                    <option value="ele">Ele</option>
            </select>
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
