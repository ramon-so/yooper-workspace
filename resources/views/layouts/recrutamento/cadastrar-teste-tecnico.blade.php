@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Cadastrar teste técnico')
@section('pagina', 'Cadastrar Teste técnico')

@section('conteudo')

    <div class="main-content">
        <div class="container-fluid">
            @if (session('msg'))
                <div class="alert alert-success mt-4" style="/* display: none */">
                    {{ session('msg') }}
                </div>
            @endif
            <div class="row mb-5 mt-5">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <div class="card shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastro Teste Técnico</h3>
                            </div>
                        </div>
                        <div class="card-body bg-secondary">

                            @include('layouts.recrutamento.partials.adicionar-teste-tecnico')

                        </div>
                    </div>
                </div>
                <div class="col-lg-7 solicitacoes-cadastradas-box">
                    <div class="card">
                        <div class="card-header border-0 justify-content-center justify-content-lg-start">
                            <h3 class="mb-0 text-center text-lg-left">Testes cadastrados</h3>
                        </div>
                        <div class="table-responsive">

                            {{-- @include('layouts.recrutamento.partials.solicitacoes-cadastradas') --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <script>
    var modal = document.getElementById("editar-candidato");
    var closeModal = document.getElementById("fechar-candidato");
    var abrirCandidato = document.getElementById("abrir-candidato");

    abrirCandidato.addEventListener("click", function() {
        modal.classList.add("modal-visivel");
    });

    closeModal.addEventListener("click", function() {
        modal.classList.remove("modal-visivel");
    });


    var modalCurriculo = document.getElementById("curriculo-modal");
    var closeModalCurriculo = document.getElementById("close-modal-curriculo");
    var iconeCurriculo = document.getElementById("abrir-curriculo");

    iconeCurriculo.addEventListener("click", function() {
        modalCurriculo.classList.add("modal-visivel");
    });

    closeModalCurriculo.addEventListener("click", function() {
        modalCurriculo.classList.remove("modal-visivel");
    });
</script> --}}

