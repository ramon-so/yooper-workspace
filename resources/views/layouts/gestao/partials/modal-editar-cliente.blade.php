<div class="adicionar-candidato-modal" id="editar-cliente">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_editar_cliente()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar contato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form action="{{route('atualizar_cliente')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group" id="form-content">
                        <div class="image-upload">
                            <label for="uploadImage">
                                <img src="{{ asset('assets') }}/img/icons/upload-image.png" id="uploadPreview"
                                     style="width:60px;">
                            </label>
                            <input id="uploadImage" type="file" name="foto" onchange="PreviewImage();"
                                   accept="image/png, image/jpeg">
                        </div>
                        <input type="hidden" name="id" value="{{$cliente->id}}">
                        <label for="empresa">Empresa</label>
                        <input type="text" name="empresa" value="{{$cliente->empresa}}" id="empresa" class="form-control">
                        <label for="razao_social">Razão social</label>
                        <input type="text" name="razao_social" value="{{$cliente->razaosocial}}" id="razao_social" class="form-control">
                        <label for="razao_social">CNPJ</label>
                        <input type="text" name="cnpj" value="{{$cliente->cnpj}}" id="cnpj" class="form-control">
                        <label for="razao_social">Logradouro</label>
                        <input type="text" name="logradouro" value="{{$cliente->logradouro}}" id="logradouro" class="form-control" >
                        <label for="razao_social">Cidade</label>
                        <input type="text" name="cidade" value="{{$cliente->cidade}}" class="form-control" id="cidade">
                        <label for="razao_social">Estado</label>
                        <input type="text" name="estado" value="{{$cliente->estado}}" class="form-control" id="estado">

                        <label for="razao_social">Grupo do telegram</label>
                        <input type="text" name="link_telegram" value="{{$cliente->link_telegram}}" class="form-control" id="telegram">

                        <label for="razao_social">Site</label>
                        <input type="text" name="site" value="{{$cliente->site}}" class="form-control" id="site">

                        <label for="razao_social">Responsavel</label>
                        <input type="text" name="responsavel" value="{{$cliente->nome_responsavel}}" id="responsavel" class="form-control">
                        <label for="razao_social">Telefone Responsavel</label>
                        <input type="text" name="telefone_responsavel" value="{{$cliente->telefone_responsavel}}" id="telefone-responsavel" class="form-control" >
                        <label for="razao_social">Responsavel Financeiro</label>
                        <input type="text" name="responsavel_financeiro" value="{{$cliente->nome_responsavel_financeiro}}" class="form-control" id="responsavel-financeiro">
                        <label for="razao_social">Telefone Responsavel Financeiro</label>
                        <input type="text" name="telefone_responsavel_financeiro" value="{{$cliente->telefone_responsavel_financeiro}}" class="form-control" id="telefone-responsavel-financeiro">

                        <label for="razao_social">Briefing</label>
                        <input type="file" name="briefing" class="form-control" id="briefing">
                    </div>
                    <div class="text-center">
                        <button class="btn btn-success mt-4">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };
</script>




