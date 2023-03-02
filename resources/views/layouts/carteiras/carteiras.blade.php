@extends('layouts.template-partials.estrutura')
@section('titulo', 'Yooper - Carteiras')
@section('pagina', 'Carteiras')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">

        <div class="row mb-5 mt-5">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0" id="cadastro_hd">
                @include('layouts.carteiras.partials.carteiras-listagem')
            </div>

            <div class="col-12 col-lg-6 tabela-cadastrados barra">
                @include('layouts.carteiras.partials.clientes-listagem')
            </div>
        </div>
    </div>
</div>
@include('layouts.carteiras.partials.atribuir-carteira')
@include('layouts.carteiras.partials.confirmar-exclusao')
@include('layouts.carteiras.partials.editar-carteira')
@endsection