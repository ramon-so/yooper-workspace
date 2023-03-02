<style> 
.tamanho-imagem {
        width: 50px;
    }
</style>
@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper - Clientes')
@section('pagina', 'Clientes')

@section('conteudo')
    <div class="main-content animate__animated animate__fadeIn animate__slow">
        <div class="container-fluid">

            @include('layouts.template-partials.alerts')

            <div class="row mb-3 mt-1">
                <div class="col-12 lista-clientes-box">
                    <div class="card">
                        <div class="card-header topo-dash border-0 justify-content-center justify-content-lg-start"
                            style="z-index: 10000;">
                            <h3 class="mb-0 text-center text-lg-left">Clientes</h3>
                            @if (Auth::user()->acesso == 'Master')
                                <ul class="btn-yoodash">
                                    <li id="btn-opcoes">
                                        <div class="icon-opcoes">
                                            +
                                        </div>
                                        <ul class="menu-opcoes">
                                            <li id="btn-cliente">
                                                Cadastrar cliente
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                        </div>
                        <div class="table-responsive table-solicitacoes">

                            @include('layouts.gestao.partials.lista-clientes')

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
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
    </script>


<script>
    $(document).ready(function() {
        // PROGRAMACAO MODAL
        document.getElementById('btn-cliente').addEventListener('click', function() {
            document.getElementById(`cliente-modal`).classList.add(
                "modal-visivel");
        });

        document.getElementById('close-modal-cliente').addEventListener('click',
            function() {
                document.getElementById(`cliente-modal`).classList.remove(
                    "modal-visivel");
            });
    });
</script>

@include('layouts.gestao.partials.cadastrar-cliente')

@endsection


