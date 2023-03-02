<form method="post" action="{{route('cadastrar-plano-integrado-store')}}">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Cadastrar nova demanda</h6>
    <div class="form-group">
        <label class="form-control-label" for="cliente">Cliente</label>
        <input id="nome-demanda" name="cliente" type="text" required class="form-control mt-2"
            style="text-transform: uppercase;" placeholder="Cliente">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="facebook_id">Conta de Anúncio ID</label>
        <input id="facebook-id" name="facebook_id" type="text" required class="form-control mt-2"
            style="text-transform: uppercase;" placeholder="Conta de Anúncio ID">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="email">E-mail</label>
        <input id="email-id" name="email" type="text" required class="form-control mt-2"
            style="text-transform: uppercase;" placeholder="E-mail">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="plataforma">Plataforma</label>
        <input id="plataforma" name="plataforma" type="text" required class="form-control mt-2"
            style="text-transform: uppercase;" placeholder="Plataforma">
    </div>
    <div class="form-group">
        <label class="form-control-label">Serviços</label>
        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="checkblog" name="servicos[]" value="BLOG">
            <label class="custom-control-label" for="checkblog">BLOG</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="checkcrm" name="servicos[]" value="CRM">
            <label class="custom-control-label" for="checkcrm">CRM</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="checkgestao" name="servicos[]" value="GESTÃO MÍDIA">
            <label class="custom-control-label" for="checkgestao">GESTÃO MÍDIA</label>
        </div>


        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="checkinfluencer" name="servicos[]"
                value="INFLUENCER">
            <label class="custom-control-label" for="checkinfluencer">INFLUENCER</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="checkprojetos" name="servicos[]" value="PROJETOS">
            <label class="custom-control-label" for="checkprojetos">PROJETOS</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="checkseo" name="servicos[]" value="SEO">
            <label class="custom-control-label" for="checkseo">SEO</label>
        </div>

        <div class="custom-control custom-checkbox mb-3">
            <input type="checkbox" class="custom-control-input" id="checksocial" name="servicos[]" value="SOCIAL">
            <label class="custom-control-label" for="checksocial">SOCIAL</label>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Cadastrar novo Plano Integrado</button>
    </div>
</form>
