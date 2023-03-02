@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Solicitação de Processo Seletivo')
@section('pagina', 'Solicitação de Processo Seletivo')

@section('conteudo')
<div class="main-content">
    <div class="container-fluid">
     @if(session('msg'))
    <div class="alert alert-success mt-4" style="/* display: none */">
        {{ session('msg') }}
    </div>
    @endif
        <div class="row mb-5 mt-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Solicitação processo seletivo</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        
                        @include('layouts.recrutamento.partials.adicionar-solicitacao')

                    </div>
                </div>
            </div>
            <div class="col-lg-7 solicitacoes-cadastradas-box">
                <div class="card">
                    <div class="card-header border-0 justify-content-lg-start position-relative">
                        <h3 class="mb-0 text-center text-lg-left">Solicitações cadastradas</h3>
                        <a href="/processo-seletivo" id="icone-visualizar" data-toogle="tooltip" data-placement="top"
                                title="Visualizar todos"><i class="fa-solid fa-eye"></i></a>
                    </div>
                    <div class="table-responsive">

                        @include('layouts.recrutamento.partials.solicitacoes-cadastradas')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
