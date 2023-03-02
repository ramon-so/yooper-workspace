@extends('layouts.template-partials.estrutura')

@section('titulo', 'Administrativo | Yoopers')
@section('pagina', 'Yoopers')

@section('conteudo')
    <div class="main-content animate__animated animate__fadeIn animate__slow">
        <div class="container-fluid">

            <div class="col-12 p-0 d-block d-md-flex justify-content-end
                align-items-center mt-4">
                <form method="get" action="/usuarios" class="col-md-3 mb-3 mb-md-0">
                    <input type="text" name="searchName" id="searchName"
                        class="form-control" placeholder="Pesquisar nome">
                </form>
                <div class="m-t-xs btn-group col-12 col-md-6 col-lg-4 p-0">
                    <button type="button" class="btn btn-primary"
                        onclick="filtro_usuario('todos')"><i class="fas fa-users"></i>
                        Todos</button>
                    <button type="button" class="btn btn-success"
                        onclick="filtro_usuario('ativos')"><i class="fas fa-check"></i>
                        Ativos</button>
                    <button type="button" class="btn btn-danger"
                        onclick="filtro_usuario('inativos')"><i class="fas
                            fa-times-circle" style="color:#FFFFFF"></i> Inativos</button>
                </div>
            </div>

             @include('layouts.template-partials.alerts')
            @csrf
            <div class="row users mt-4 mb-4">
                @foreach ($usuarios as $usuario)

                <div class="input-group w-50" hidden id="input-nome-usuario-{{
                    $usuario->id }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fas fa-check"></i>
                        </button>
                    </div>
                </div>

                @if($usuario->ativo_user == 'Sim')
                <div class="col-sm-6 col-md-5 col-lg-3 ativo ativo-{{$usuario->id_user}}">
                    @else
                    <div class="col-sm-6 col-md-5 col-lg-3 inativo
                        inativo-{{$usuario->id_user}}">
                        @endif

                        <div class="card p-4 shadow justify-content-center
                            align-items-center user contact-box center-version
                            funcionario">
                            <a>
                                <div class="foto-usuario m-auto">
                                    <img src='{{ asset("storage/usuarios/$usuario->foto_usuario") }}'>
                                </div>
                                <h4 class="nome-usuario card-title text-uppercase
                                    text-primary mt-4 mb-2 font-weight-bold
                                    text-center display-edit-{{$usuario->id_user}}"><strong>{{
                                        $usuario->nome_funcionario }}</strong></h4>
                                <div class="form-group bmd-form-group input-edit-{{
                                    $usuario->id_user }} input-edit">
                                    <input placeholder="Nome funcionário"
                                        type="text" class="mb-3 form-control mt-3
                                        input-edit-nome-func-{{ $usuario->id_user
                                    }}" value="{{ $usuario->nome_funcionario }}">
                                </div>

                                <p class="mt-1 mb-0 text-sm text-center">
                                    <span class="text-center text-default
                                        display-edit-{{$usuario->id_user}}">{{
                                        $usuario->departamento }}</span>
                                </p>
                                <p class="mt-1 mb-0 text-sm text-center">
                                    <span class="text-center text-default
                                        display-edit-{{$usuario->id_user}}">{{
                                        $usuario->acesso }}</span>
                                </p>
                                <div class="form-group bmd-form-group input-edit-{{
                                    $usuario->id_user }} input-edit"
                                    id="departamento-display">
                                    <select name="departamento_id" id="departamento"
                                        class="form-control input-edit-dept-{{
                                        $usuario->id_user }}" required>
                                        <option disabled selected value> Selecione o
                                            departamento</option>
                                        @foreach ($listaDp as $dp)
                                        <option value="{{ $dp->id }}">{{ $dp->departamento
                                            }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <p class="mt-1 mb-3 text-sm text-center">
                                    <span class="text-center font-weight-bold
                                        text-default display-edit-{{$usuario->id_user}}">{{
                                        $usuario->nome_user }}</span>
                                </p>
                                <div class="form-group bmd-form-group input-edit
                                    input-edit-{{ $usuario->id_user }}">
                                    <input placeholder="Nome usuário" type="text"
                                        class="form-control mt-3 mb-3
                                        input-edit-nome-user-{{ $usuario->id_user
                                    }}" value="{{ $usuario->nome_user }}">
                                </div>

                                <div class="form-group bmd-form-group">
                                    <input placeholder="Senha"
                                        id="password-{{$usuario->id_user}}"
                                    type="password" class="col-9 input-senha
                                    float-left pass input-edit-senha-{{ $usuario->id_user
                                    }}" disabled="disabled" value="{{ $usuario->senha
                                    }}"><button type="button" class="col-3 btn
                                        btn-senha clearfix btn-mostrar-senha"
                                        onclick="mostrarSenha({{$usuario->id_user}})"><i
                                            class="mostrar-senha far fa-eye"></i></button>
                                </div>

                                <p class="mt-1 mb-4 text-sm text-center">
                                    <span class="text-center text-default
                                        display-edit-{{$usuario->id_user}}">{{
                                        $usuario->email_funcionario }}</span>
                                </p>
                                <div class="form-group bmd-form-group input-edit
                                    input-edit-{{ $usuario->id_user }}">
                                    <input placeholder="E-mail" type="email"
                                        class="form-control mt-3 input-edit-email-{{
                                        $usuario->id_user }}" value="{{ $usuario->email_funcionario
                                    }}">
                                </div>
                            </a>
                            <div class="contact-box-footer">
                                @if ($usuario->ativo_user == 'Sim')
                                <div class="m-t-xs btn-group">
                                    <button type="button" class="btn btn-danger
                                        btn-inativar-{{$usuario->id_user}}"
                                        onclick="ativar_inativar_usuario_funcionario({{
                                        $usuario->id_user}}, {{ $usuario->func_id
                                        }}, 'inativar')"><i class="fas
                                            fa-times-circle" style="color:#FFFFFF"></i>
                                        Inativar</button>
                                    <button type="button" class="btn btn-primary
                                        btn-editar-{{$usuario->id_user}}"
                                        onclick="editarUsuario({{$usuario->id_user}});"><i
                                            class="fas fa-pen"></i> Editar</button>
                                </div>
                                @else
                                <div class="m-t-xs btn-group">
                                    <button type="button" class="btn btn-success
                                        bnt-ativar-{{$usuario->id_user}}"
                                        onclick="ativar_inativar_usuario_funcionario({{
                                        $usuario->id_user}}, {{ $usuario->func_id
                                        }}, 'ativar')"><i class="fas fa-check"></i>
                                        Ativar</button>
                                </div>
                                @endif
                                <div class="m-t-xs btn-group btn-group-edit">
                                    <button type="button" class="btn btn-success
                                        salvar-edicao btn-salvar-edicao-{{$usuario->id_user}}"
                                        onclick="salvarUsuario({{$usuario->id_user}},
                                        {{$usuario->func_id}})"><i class="fas
                                            fa-check"></i> Salvar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
