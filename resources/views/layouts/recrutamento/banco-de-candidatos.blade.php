@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Banco de Candidatos')
@section('pagina', 'Banco de Candidatos')

@section('conteudo')

<div class="container-fluid">
  @include('layouts.template-partials.alerts')
    <div class="row mb-3 mt-4 ml-md-1 mr-md-1">
        <div class="col-12 lista-clientes-box">
            <div class="card">
                <div class="card-header topo-dash border-0 justify-content-lg-start" style="z-index: 10000;">
                    <h3 class="mb-0 text-center text-lg-left">Lista de candidatos</h3>

                    <ul class="btn-yoodash">
                        <li id="btn-opcoes">
                            <div class="icon-opcoes">
                                +
                            </div>
                            <ul class="menu-opcoes">
                                <li id="btn-dashboard" onclick="cadastrarCandidatoAbrir()">
                                    Cadastrar Candidato
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="table-responsive table-solicitacoes">

                    @include('layouts.recrutamento.partials.lista-de-candidatos')

                </div>
            </div>
        </div>
    </div>
    @include('layouts.recrutamento.partials.adicionar-candidato-banco')
</div>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ candidatos por página",
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum resultado encontrado",
                "infoFiltered": "(Filtrado from _MAX_ total de candidatos)",
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "paging": true,
            "bSort": true,
            'pagingType': 'full',
        });
    });

    function cadastrarCandidatoAbrir() {
        document.getElementById(`adicionar-candidato-modal-banco`).classList.add(
            "modal-visivel");
    }

    function cadastrarCandidatoFechar() {
        document.getElementById(`adicionar-candidato-modal-banco`).classList.remove(
            "modal-visivel");
    }
</script>

@endsection
