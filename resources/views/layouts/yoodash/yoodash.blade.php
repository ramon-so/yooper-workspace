@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Yoo.Dash | Clientes')
@section('pagina', 'Dashboards')

@section('conteudo')
    <div class="main-content animate__animated animate__fadeIn animate__slow">
        <div class="container-fluid pb-5">
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card bg-default text-white p-3">
                        <p class="text-bold">Pedido de acesso do cliente</p>
                        <ol>
                            <li>O cliente deve solicitar acesso ao Yoo.Dash para o analista.</li>
                            <li>O ANALISTA deve enviar um e-mail para yoodash@yooper.com.br, contendo Cliente, Nome do
                                usuário e E-mail para acesso.</li>
                            <li>O time de Dev irá gerar a senha no prazo de 24 horas e enviará diretamente para o cliente.
                            </li>
                        </ol>
                        <p class="text-bold">Cliente perdeu o acesso ou necessita suporte de algum problema no Yoo.Dash</p>
                        <ol>
                            <li>O cliente ou o analista deve preencher o Form que está na tela de Login do yoodash.com.br.
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            @include('layouts.template-partials.alerts')
            <div class="row mb-3 mt-1">
                <div class="col-12 lista-clientes-box">
                    <div class="card">
                        <div class="card-header topo-dash border-0 justify-content-lg-start"
                            style="z-index: 10000;">
                            <h3 class="mb-0 text-center text-lg-left">Lista de clientes</h3>
                            @if (Auth::user()->acesso == 'Master')
                                <ul class="btn-yoodash">
                                    <li id="btn-opcoes">
                                        <div class="icon-opcoes">
                                            +
                                        </div>
                                        <ul class="menu-opcoes">
                                            <li id="btn-dashboard">
                                                Cadastrar Dashboard
                                            </li>
                                            <li id="btn-usuarios">
                                                Cadastrar Usuário
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <script>
                                    $(document).ready(function() {
                                        // PROGRAMACAO MODAL
                                        document.getElementById('btn-dashboard').addEventListener('click', function() {
                                            document.getElementById(`dashboard-modal`).classList.add(
                                                "modal-visivel");
                                        });

                                        document.getElementById('close-modal-dashboard').addEventListener('click',
                                            function() {
                                                document.getElementById(`dashboard-modal`).classList.remove(
                                                    "modal-visivel");
                                            });

                                        document.getElementById('btn-usuarios').addEventListener('click', function() {
                                            document.getElementById(`usuarios-modal`).classList.add(
                                                "modal-visivel");
                                        });

                                        document.getElementById('close-modal-usuarios').addEventListener('click',
                                            function() {
                                                document.getElementById(`usuarios-modal`).classList.remove(
                                                    "modal-visivel");
                                            });
                                    });
                                </script>
                            @endif
                        </div>
                        <div class="table-responsive table-solicitacoes">

                            @include('layouts.yoodash.partials.lista-de-clientes')

                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->acesso == 'Master')
                <div class="row mb-3 mt-2">
                    <div class="col-12 lista-clientes-box">
                        <div class="card">
                            <div class="card-header topo-dash border-0 justify-content-lg-start"
                                style="z-index: 10000;">
                                <h3 class="mb-0 text-center text-lg-left">Lista de clientes inativos</h3>
                            </div>
                            <div class="table-responsive table-solicitacoes">

                                @include('layouts.yoodash.partials.lista-de-clientes-inativos')

                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if (Auth::user()->acesso == 'Master')
        @include('layouts.yoodash.partials.cadastrar-dashboard')
        @include('layouts.yoodash.partials.cadastrar-usuarios')
    @endif
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

        $(document).ready(function() {
            $('#dataTableInativo').DataTable({
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
@endsection
