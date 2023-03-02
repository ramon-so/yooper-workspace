@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Cadastrar Plano Integrado')
@section('pagina', 'Cadastrar Plano Integrado')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">

        <div class="row mb-5 mt-5 justify-content-center align-items-center">
            <div class="col-12 col-md-8 mb-4 mb-lg-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastrar plano integrado</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                         @include('layouts.plano-integrado.partials.cadastrar-plano-integrado')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
