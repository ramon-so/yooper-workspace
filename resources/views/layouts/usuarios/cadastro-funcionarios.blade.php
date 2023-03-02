@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Cadastrar Funcionário')
@section('pagina', 'Cadastro de Funcionários')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">

         @include('layouts.template-partials.alerts')
         
        <div class="row mb-5 mt-5">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastro de funcionário</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">

                         @include('layouts.usuarios.partials.usuarios')

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 tabela-cadastrados">
                <div class="card">
                    <div class="card-header border-0 justify-content-center justify-content-lg-start position-relative">
                        <div
                            class="row align-items-center justify-content-lg-start position-relative">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Últimos cadastrados</h3>
                            <a href="/usuarios" id="icone-visualizar" data-toogle="tooltip" data-placement="top"
                                title="Visualizar funcionários/usuários"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </div>
                    <div class="table-responsive">

                        @include('layouts.usuarios.partials.tabela-usuarios')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
