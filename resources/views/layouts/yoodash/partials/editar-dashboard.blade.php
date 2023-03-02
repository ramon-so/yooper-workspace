<form method="post" action="/yoodash/editar/{{$contas[$i]->id}}}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do dashboard</h6>
    <div class="form-group">
        <label class="form-control-label" for="input-conta">Conta</label>
        <input type="text" name="conta" value="{{$contas[$i]->conta}}" class="form-control" id="input-conta" placeholder="Conta">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-cliente">Cliente</label>
        <input type="text" name="cliente" value="{{$contas[$i]->cliente}}" class="form-control" id="input-cliente" placeholder="Cliente">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-empresa">Empresa</label>
        <input type="text" name="empresa" value="{{$contas[$i]->empresa}}" class="form-control" id="input-empresa" placeholder="Empresa">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-qtd">Quantidade de usuários</label>
        <input type="number" name="qtd_usuarios" value="{{$contas[$i]->qtd_usuarios}}" class="form-control" id="input-qtd"
            placeholder="Quantidade de usuários">
        <input type="text" name="logo" value="yooper.png" class="form-control" id="input-logo" hidden>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-dashid">Id do dashboard</label>
        <input type="text" name="dashboard_id" value="{{$contas[$i]->dashboard_id}}" class="form-control" id="input-dashid" placeholder="Id do dashboard">
    </div>
    <div class="form-group">
        <label class="form-control-label">Plataformas de e-commerce</label>
        <div class="custom-control custom-checkbox mb-3">
         @if (in_array('VTEX', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" id="checkdvtex{{ $contas[$i]->id}}" checked="checked" name="integracoes_edit[]" value="VTEX">
            <label class="custom-control-label" for="checkdvtex{{ $contas[$i]->id}}">VTEX</label>
            @else
            <input type="checkbox" class="custom-control-input" id="checkdvtex{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="VTEX">
            <label class="custom-control-label" for="checkdvtex{{ $contas[$i]->id}}2">VTEX</label>
            @endif
        </div>
        <div class="custom-control custom-checkbox mb-3">
        @if (in_array('FBITS', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" id="checkdfbits{{ $contas[$i]->id}}" checked="checked" name="integracoes_edit[]" value="FBITS">
            <label class="custom-control-label" for="checkdfbits{{ $contas[$i]->id}}">FBITS</label>
            @else
            <input type="checkbox" class="custom-control-input" id="checkdfbits{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="FBITS">
            <label class="custom-control-label" for="checkdfbits{{ $contas[$i]->id}}2">FBITS</label>
            @endif
        </div>
        <div class="custom-control custom-checkbox mb-3">
         @if (in_array('SHOPIFY', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" id="checkdtray{{ $contas[$i]->id}}" checked="checked" name="integracoes_edit[]" value="TRAY">
            <label class="custom-control-label" for="checkdtray{{ $contas[$i]->id}}">TRAY</label>
            @else
            <input type="checkbox" class="custom-control-input" id="checkdtray{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="TRAY">
            <label class="custom-control-label" for="checkdtray{{ $contas[$i]->id}}2">TRAY</label>
            @endif
        </div>
        <div class="custom-control custom-checkbox mb-3">
        @if (in_array('SHOPIFY', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" id="checkdshopify{{ $contas[$i]->id}}" checked="checked" name="integracoes_edit[]" value="SHOPIFY">
            <label class="custom-control-label" for="checkdshopify{{ $contas[$i]->id}}">SHOPIFY</label>
            @else
            <input type="checkbox" class="custom-control-input" id="checkdshopify{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="SHOPIFY">
            <label class="custom-control-label" for="checkdshopify{{ $contas[$i]->id}}2">SHOPIFY</label>
            @endif
        </div>
        <div class="custom-control custom-checkbox mb-3">
        @if (in_array('VNDA', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" id="checkdvnda{{ $contas[$i]->id}}" checked="checked" name="integracoes_edit[]" value="VNDA">
            <label class="custom-control-label" for="checkdvnda{{ $contas[$i]->id}}">VNDA</label>
            @else
             <input type="checkbox" class="custom-control-input" id="checkdvnda{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="VNDA">
            <label class="custom-control-label" for="checkdvnda{{ $contas[$i]->id}}2">VNDA</label>
            @endif
        </div>
        <label class="form-control-label">Gestão de Mídia</label>
        <div class="custom-control custom-checkbox mb-3">
         @if (in_array('FADS', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" id="checkdfads{{ $contas[$i]->id}}" checked="checked" name="integracoes_edit[]" value="FADS">
            <label class="custom-control-label" for="checkdfads{{ $contas[$i]->id}}">Facebook Ads</label>
            @else
            <input type="checkbox" class="custom-control-input" id="checkdfads{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="FADS">
            <label class="custom-control-label" for="checkdfads{{ $contas[$i]->id}}2">Facebook Ads</label>
            @endif
        </div>
        <div class="custom-control custom-checkbox mb-3">
        @if (in_array('GADS', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" id="checkdgads{{ $contas[$i]->id}}" checked="checked" name="integracoes_edit[]" value="GADS">
            <label class="custom-control-label" for="checkdgads{{ $contas[$i]->id}}">Google Ads</label>
            @else
            <input type="checkbox" class="custom-control-input" id="checkdgads{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="GADS">
            <label class="custom-control-label" for="checkdgads{{ $contas[$i]->id}}2">Google Ads</label>
            @endif
        </div>
        <label class="form-control-label">Outros</label>
        <div class="custom-control custom-checkbox mb-3">
        @if (in_array('GA', explode(",", $contas[$i]->integracoes)))
            <input type="checkbox" class="custom-control-input" checked="checked" id="checkdga{{ $contas[$i]->id}}" name="integracoes_edit[]" value="GA">
            <label class="custom-control-label" for="checkdga{{ $contas[$i]->id}}">Google Analytics</label>
        @else
        <input type="checkbox" class="custom-control-input" id="checkdga{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="GA">
            <label class="custom-control-label" for="checkdga{{ $contas[$i]->id}}2">Google Analytics</label>
        @endif
        </div>
        <div class="custom-control custom-checkbox mb-3">
        @if (in_array('GSC', explode(",", $contas[$i]->integracoes)))
        <input type="checkbox" class="custom-control-input" checked="checked" id="checkdgsc{{ $contas[$i]->id}}" name="integracoes_edit[]" value="GSC">
        <label class="custom-control-label" for="checkdgsc{{ $contas[$i]->id}}">Google Search Console</label>
        @else
        <input type="checkbox" class="custom-control-input" id="checkdgsc{{ $contas[$i]->id}}2" name="integracoes_edit[]" value="GSC">
        <label class="custom-control-label" for="checkdgsc{{ $contas[$i]->id}}2">Google Search Console</label>
        @endif
        </div>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-monday">Monday embed</label>
        <input type="text" name="monday_embed" value="{{$contas[$i]->monday_embed}}" class="form-control" id="input-monday" placeholder="Monday embed">
    </div>
    <div class="form-group">
        <label class="form-control-label" for="input-planoid">Id do plano integrado</label></label>
        <input type="number" name="plano_integrado_id" value="{{$contas[$i]->plano_integrado_id}}" class="form-control" id="input-planoid"
            placeholder="Id do plano integrado">
        <input type="text" name="status" value="Ativo" class="form-control" id="input-status" hidden>
    </div>


    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
    </div>
</form>
