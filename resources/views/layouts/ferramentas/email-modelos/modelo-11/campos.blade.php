<div id="campos-modelo-11" class="mt-2 col-md-12 campos" style="display: none">
    Modelo 11 - Briefings
    <form method="get" action="{{ route('email_rh_modelo_11') }}" enctype="multipart/form-data">
        {{-- @csrf --}}

        <div class="form-group mt-2 col-md-12">
            <input onchange="informacaoEmail('nome', value)" type="text" class="form-control" id="nome"
                placeholder="Nome" required name="nome">
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="persona" name="servico[]" value="persona">
            <label class="custom-control-label" for="persona">Persona</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="midia" name="servico[]" value="midia">
            <label class="custom-control-label" for="midia">Mídia</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="midialead" name="servico[]" value="midialead">
            <label class="custom-control-label" for="midialead">Mídia Lead</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="seo" name="servico[]" value="seo">
            <label class="custom-control-label" for="seo">SEO</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="social" name="servico[]" value="social">
            <label class="custom-control-label" for="social">Social</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="crm" name="servico[]" value="crm">
            <label class="custom-control-label" for="crm">CRM</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="influencers" name="servico[]" value="influencers">
            <label class="custom-control-label" for="influencers">Influencers</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="criacao" name="servico[]" value="criacao">
            <label class="custom-control-label" for="criacao">Criação</label>
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
