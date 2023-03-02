@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Perfil')
@section('pagina', 'Meu Perfil')

@section('conteudo')

<div class="container-fluid">
    @include('layouts.template-partials.alerts')
    @foreach ($usuarios as $usuario)
    <div class="row ml-lg-2 mr-lg-2 mt-5 mb-5">
        <div class="col-xl-4 order-xl-1 mb-2 mb-xl-0">
            <div class="card card-profile shadow">
                <div class="row justify-content-center">
                    <div class="d-flex justify-content-center mt-2 pt-1">
                        <div class="card-profile-image">
                            <a href="#">
                                <img src="{{ asset("storage/usuarios/".Auth::user()->foto_usuario) }}"
                                    class="rounded-circle foto-perfil">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-2 pb-5">
                    <div class="col">
                        <div class="card-profile-stats d-flex justify-content-center mt-0">
                            <div>
                                <span class="heading">{{Auth::user()->created_at->format('d/m/Y')}}</span>
                                <span class="description">Data de Cadastro</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2>
                            {{$usuario->nome_funcionario}}
                        </h2>
                        <div class="h5 font-weight-300">
                            {{$usuario->email_funcionario}}
                        </div>
                        <div class="h4 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>Nível de acesso: {{Auth::user()->acesso}}
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i>Departamento: {{$usuario->departamento_funcionario}}
                        </div>
                        {{-- <hr class="my-4" />
                        <p>Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes,
                            performs and records all of his own music.</p>
                        <a href="#">Show more</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8 order-xl-2">
            <div class="card bg-secondary shadow">
                <div class="card-header bg-white border-0">
                    <div class="row align-items-center">
                        <h3 class="mb-0">Editar perfil</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('editar_perfil') }}" enctype="multipart/form-data">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">Minhas Informações</h6>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Senha</label>
                                <input type="text" name="senha" id="input-email"
                                    class="form-control form-control-alternative" placeholder="Senha"
                                    value="{{$usuario->senha_funcionario}}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Adicionar foto</label>
                                <div class="image-upload">
                                    <label for="uploadImage">
                                        <img src="{{ asset('assets') }}/img/icons/upload-image.png" id="uploadPreview"
                                            style="width:60px;">
                                    </label>
                                     <input id="uploadImage" type="file" name="foto_usuario" onchange="PreviewImage();"
                accept="image/png, image/jpeg">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

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

@endsection
