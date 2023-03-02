<br><button type="button" class="btn btn-info ativar-button btn-circle btn-sm mt-4" style="float: right" id="btnMostrarCensurados">
    <i class="fa-solid fa-eye"></i></button>
<table class="table align-items-center table-flush" id="dataTable">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Volume de busca</th>
            <th scope="col" class="sort" data-sort="data">Fee </th>
            <th scope="col" class="sort" data-sort="data">Classificação </th>
            <th scope="col" class="sort" data-sort="nome">Data de atualização</th>
        </tr>
    </thead>
    <tbody class="list">
    </tbody>
</table>
<script>
    $(document).ready(function() {
        var censor = true;
        var data = JSON.parse(@json($lista_clientes));
        console.log(data);

        function customRender(data, type, row, meta) {
            if (censor && meta.col == 2) {
                return "R$ ******";
            } else {
                return data;
            }
        }

        $('#dataTable').DataTable({
            data: data,
            columns: [
                { data: 'cliente' },
                { data: 'volume'},
                { data: 'fee', render: customRender },
                { data: 'classificacao' },
                { data: 'updated_at' }
            ]
        });

        // $('#dataTable').DataTable({
        //     "language": {
        //         "lengthMenu": "Mostrar _MENU_ contratos por página",
        //         "zeroRecords": "Nenhum resultado encontrado",
        //         "info": "Mostrando página _PAGE_ de _PAGES_",
        //         "infoEmpty": "Nenhum resultado encontrado",
        //         "infoFiltered": "(Filtrado from _MAX_ total de contratos)",
        //         "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        //     },
        //     "paging": true,
        //     "bSort": true,
        //     'pagingType': 'full',
        // });
        $('#btnMostrarCensurados').click(function() {
            censor = !censor; // inverte o valor da variável "censor"
            // redefine a função de renderização com o novo valor de "censor"
            $("#dataTable").dataTable().fnDestroy();
            $('#dataTable').DataTable({
            data: data,
            columns: [
                { data: 'cliente' },
                { data: 'volume'},
                { data: 'fee', render: customRender },
                { data: 'classificacao' },
                { data: 'updated_at' }
            ]
        });
        });
    });
</script>