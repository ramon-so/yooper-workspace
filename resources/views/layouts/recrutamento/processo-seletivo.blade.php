@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Processos Seletivos')
@section('pagina', 'Processos Seletivos')

@section('conteudo')
<div class="main-content">
    <div class="container-fluid">
        @if(session('msg'))
        <div class="alert alert-success mt-4" style="/* display: none */">
            {{ session('msg') }}
        </div>
        @endif
        <div class="row col-12 mt-4 mb-4 d-flex ml-0 mr-0 pl-0 pr-0 justify-content-center justify-content-md-end align-items-center align-items-md-end">
            <form method="get" action="{{ route('processo-seletivo') }}" class="col-12 mb-3 p-0 mb-md-0 col-md-4 col-lg-3 mr-0 mr-lg-3">
                <input type="text" name="searchProcesso" id="searchProcesso" class="form-control"
                    placeholder="Pesquisar Departamento">
            </form>

             @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH')
            <div class="filtro-recrutador">
                @foreach($recrutadores as $recrutador)
                <div class="foto-solicitante" onclick="mostrarRecrutador('{{$recrutador->recrutador_id}}')" id="recrutador-{{$recrutador->recrutador_id}}" data-toggle="tooltip" data-placement="top"
                    title="{{$recrutador->recrutador_nome}}">
                    <img src='{{ asset("storage/usuarios/$recrutador->recrutador_foto") }}'>
                </div>
                @endforeach
                <div class="mostrar-todos bg-primary" onclick="mostrarTodos('recrutador')" data-toggle="tooltip" data-placement="top"
                    title="Mostrar todos">
                    <span>X</span>
                </div>
            </div>
            @endif
        </div>
        <div class="status-container" style="overflow:auto;">
            @include('layouts.recrutamento.partials.status-processo')
        </div>
    </div>
</div>

<script>
    function mostrarRecrutador(recrutador) {
        var recrutadorCard = document.querySelectorAll('.card-processo');
        var foto = document.getElementsByClassName('foto-solicitante');
        var recrutadorCardDisplay = document.querySelectorAll(`.recrutador-${recrutador}`);
        var recrutadorFoto = document.getElementById(`recrutador-${recrutador}`);

            for (var x = 0; x < foto.length; x++) {
            foto[x].classList.add('selecionado');
            }
            recrutadorFoto.classList.remove('selecionado');

            for (var i = 0; i < recrutadorCard.length; i++) {
            recrutadorCard[i].style.display = 'none';
            }
            for (var y = 0; y < recrutadorCardDisplay.length; y++) {
            recrutadorCardDisplay[y].style.display = 'flex';
            }
    }

    function mostrarTodos(recrutador) {
         var foto = document.getElementsByClassName('foto-solicitante');
          for (var x = 0; x < foto.length; x++) {
            foto[x].classList.remove('selecionado');
            }
        var recrutadorCard = document.querySelectorAll('.card-processo');
            for (var i = 0; i < recrutadorCard.length; i++) {
            recrutadorCard[i].style.display = 'flex';
            }
    }
</script>
@endsection
