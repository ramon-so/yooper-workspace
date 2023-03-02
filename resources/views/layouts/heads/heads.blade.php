@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Heads')
@section('pagina', 'Vincular Funcionário')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">

        <div class="col-12 p-0 d-block d-md-flex justify-content-end
                align-items-center mt-4">

            @include('layouts.heads.partials.parametros-heads')

            <div class="m-t-xs btn-group col-12 col-md-6 col-lg-4 p-0">
                <button type="button" class="btn btn-primary" onclick="filtro_dp('todos')"><i
                        class="fas fa-bezier-curve"></i> Todos</button>
                <button type="button" class="btn btn-success" onclick="filtro_dp('ativos')"><i class="fas fa-check"></i>
                    Ativos</button>
                <button type="button" class="btn btn-danger" onclick="filtro_dp('inativos')"><i
                        class="fas fa-times-circle" style="color:#FFFFFF"></i> Inativos</button>
            </div>
        </div>

        @include('layouts.template-partials.alerts')

        <div class="row mb-5 mt-5">
            <div class="col-12 col-lg-6 mb-4 mb-lg-0" id="cadastro_hd">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Vincular funcionário</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        @include('layouts.heads.partials.criar-head')
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 mb-4 mb-lg-0" hidden id="alteracao_hd">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div
                            class="row align-items-center justify-content-lg-start position-relative">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Alteração do funcionário</h3>
                            <div id="icone-cancelar" data-toogle="tooltip" onclick="toggleInputHdClosed()"
                                data-placement="top" title="Cancelar edição">X</div>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Informações do Funcionário
                        </h6>
                        <div class="form-group p-0">
                            <input type="text" hidden class="form-control" id="input_hd_id" name="hd_id">
                            <input type="text" hidden class="form-control" id="input_foto" name="foto">
                            <label class="form-control-label" for="funcionario">Selecione o funcionário</label>
                            <select name="funcionario_id" id="input_funcionario" class="form-control-select" required>
                                <option selected id="input_funcionario_editar"></option>
                                @foreach ($funcionarios as $fc)
                                <option value="{{ $fc->id }}">{{ $fc->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group p-0">
                            <label class="form-control-label" for="departamento">Selecione o departamento</label>
                            <select name="departamento_id" id="input_departamento" class="form-control-select" required>
                                <option selected id="input_departamento_editar"></option>
                                @foreach ($listaDp as $dp)
                                <option value="{{ $dp->id }}">{{ $dp->departamento }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                            <button onclick="editar_hd()" class="btn btn-primary mt-4">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6 tabela-cadastrados barra">
                <div class="card">
                    <div class="card-header border-0 justify-content-center justify-content-lg-start position-relative">
                        <div
                            class="row align-items-center justify-content-lg-start position-relative">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Funcionários vinculados
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive barra">
                        @include('layouts.heads.partials.heads')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
