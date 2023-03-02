@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Fonte de Captação')
@section('pagina', 'Cadastro de Fonte de Captação')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">

        <div class="col-12 p-0 d-block d-md-flex justify-content-end
                align-items-center mt-4">

             @include('layouts.parametros.partials.parametros-captacao')

            <div class="m-t-xs btn-group col-12 col-md-6 col-lg-4 p-0">
                <button type="button" class="btn btn-primary" onclick="filtro_cp('todos')"><i
                        class="fas fa-bezier-curve"></i> Todos</button>
                <button type="button" class="btn btn-success" onclick="filtro_cp('ativos')"><i class="fas fa-check"></i>
                    Ativos</button>
                <button type="button" class="btn btn-danger" onclick="filtro_cp('inativos')"><i
                        class="fas fa-times-circle" style="color:#FFFFFF"></i> Inativos</button>
            </div>
        </div>

         @include('layouts.template-partials.alerts')

        <div class="row mb-5 mt-5">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0" id="cadastro_cp">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastro de fonte de captação</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        @include('layouts.parametros.partials.criar-captacao')
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mb-4 mb-lg-0" hidden id="alteracao_cp">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start position-relative">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Alteração da fonte de captação</h3>
                            <div id="icone-cancelar" data-toogle="tooltip" onclick="toggleInputCpClosed()"
                                data-placement="top" title="Cancelar edição">X</div>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações da fonte de captação
                        </h6>
                        <div class="form-group p-0">
                           <input type="text" class="form-control" autofocus id="input_captacao_editar" name="nome" placeholder="Nome da fonte de captacão">
                           <input type="text" hidden class="form-control" id="input_cp_id" name="cp_id" >
                        </div>
                        <div class="text-center">
                            <button onclick="editar_cp()" class="btn btn-primary mt-4">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 tabela-cadastrados">
                <div class="card">
                    <div class="card-header border-0 justify-content-center justify-content-lg-start position-relative">
                        <div
                            class="row align-items-center justify-content-lg-start position-relative">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Fontes de captacão cadastradas
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive barra">
                        @include('layouts.parametros.partials.captacao')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
