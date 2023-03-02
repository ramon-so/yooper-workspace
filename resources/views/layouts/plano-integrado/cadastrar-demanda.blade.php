@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Qualidade - Cadastrar Demanda')
@section('pagina', 'Cadastrar Demanda | Plano Integrado')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">
        <!-- <div class="alert alert-success mt-4" style="/* display: none */">
            <i class="fas fa-exclamation-triangle"></i>
            O Plano Integrado de Maio foi liberado para todos os clientes. Qualquer problema acione o time de QA. <br>
        </div> -->
       @include('layouts.template-partials.alerts')
        <div class="row mb-5 mt-5">
            <div class="col-lg-4 mb-4 mb-lg-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastrar demanda</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                         @include('layouts.plano-integrado.partials.cadastrar-demanda')
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header border-0 justify-content-lg-start">
                        <h3 class="mb-0 text-center text-lg-left">Demandas não obrigatórias</h3>
                    </div>
                    <div class="table-responsive table-solicitacoes">
                        @include('layouts.plano-integrado.partials.demandas-nao-obrigatorias')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function campoCadastro(nome, servico, tipo) {
        var quantidade = document.getElementById('quantidade-demanda').value;
        for (let i = 0; i < quantidade; i++) {
            document.getElementById('demanda-' + i).value = nome;
        }
        document.getElementById('servico-demanda').value = servico;
        document.getElementById('tipo-demanda').value = tipo;
    }

</script>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ clientes por página",
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum resultado encontrado",
                "infoFiltered": "(Filtrado from _MAX_ total de clientes)",
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
            },
            "paging": true,
            "bSort": true,
            'pagingType': 'full',
        });
    });

</script>

<script>
    function quantidadeInsert(val) {
        
        var quantidade = val;
        var element = document.getElementById('lista-demandas');
        console.log(quantidade);

        if (element.childNodes.length > 0) {
            while (element.firstChild) {
                element.removeChild(element.lastChild);
            }
        }

        for (let i = 0; i < quantidade; i++) {
            var x = document.createElement("INPUT");
            x.setAttribute("type", "text");
            x.setAttribute("class", "demandas-nome form-control mt-2");
            x.setAttribute("value", "");
            x.setAttribute("id", "demanda-" + i);
            x.setAttribute("name", "demanda[]");
            x.setAttribute("placeholder", "Demanda " + (i + 1));
            x.setAttribute("required", "");
            document.getElementById("lista-demandas").appendChild(x)
        }
        console.log("final");
    }

</script>

<script>
    $(".readonly").keydown(function (e) {
        e.preventDefault();
    });

</script>

@endsection
