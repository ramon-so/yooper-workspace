<form method="post" action="{{ route('criar_usuario') }}" enctype="multipart/form-data">
    @csrf
    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do Usuário
    </h6>
    <div hidden class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="ativo" id="inlineRadio1" checked value="Sim">
        <label class="form-check-label" for="inlineRadio1">Ativo</label>
    </div>
    <div class="form-group col-md-6 float-left">
        <label class="form-control-label" for="funcionarios">Selecione o funcionário</label>
        <select name="funcionario_id" id="funcionarios" class="form-control-select" required>
            <option disabled selected value> Selecione o funcionário</option>
            @foreach ($funcionarios as $funcionario)
            <option value="{{ $funcionario->id }}">{{ $funcionario->nome }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-6 float-left">
        <label class="form-control-label" for="inputqtdHoras">Senha</label>
        <input type="text" class="form-control" id="inputqtdHoras" placeholder="Senha" name="senha">
    </div>
    <div class="form-group col-md-6 float-left">
        <label class="form-control-label" for="inputNome">Nome usuário</label>
        <input type="text" class="form-control" id="inputNome" placeholder="Nome usuário" required name="nome">
    </div>
    <div class="form-group col-md-6 float-left">
        <label class="form-control-label" for="departamento">Selecione o departamento</label>
        <select name="departamento_id" id="departamento" class="form-control-select" required>
            <option disabled selected value> Selecione o departamento</option>
            @foreach ($listaDp as $dp)
            <option value="{{ $dp->id }}">{{ $dp->departamento }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group clearfix pl-3 pr-3">
        <label class="form-control-label" for="acesso">Tipo de acesso</label>
        <select id="acesso" class="form-control-select" name="acesso" required>
            <option disabled selected value>Tipo de Acesso</option>
            <option value="Master">Master</option>
            <option value="Administrador">Administrador</option>
            <option value="Financeiro">Financeiro</option>
            <option value="Head">Heads</option>
            <option value="Colaborador">Colaborador</option>
            <option value="RH">RH</option>
        </select>
    </div>
    <div class="form-group">
        <label class="form-control-label" for="uploadImage">Adicionar foto</label>
        <div class="image-upload">
            <label for="uploadImage">
                <img src="{{ asset('assets') }}/img/icons/upload-image.png" id="uploadPreview" style="width:60px;">
            </label>
            <input id="uploadImage" type="file" required name="foto_usuario" onchange="PreviewImage();"
                accept="image/png, image/jpeg">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-4">Salvar</button>
        </div>
    </div>
</form>

<script>
    // PREVIEW FOTO
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
    };

</script>

<style type="text/css">
    .image-upload>input {
        display: none;

    }

    #uploadPreview {
        cursor: pointer;
    }

</style>
