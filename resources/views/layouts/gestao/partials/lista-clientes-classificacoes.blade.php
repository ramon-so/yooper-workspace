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
<button class="btn btn-success" type="submit" style="float: right; margin-bottom: 10px;">Salvar</button>
<script>
    $(document).ready(function() {
        var censor = true;
        var data = JSON.parse(@json($lista_clientes));
        console.log(data);

        function customRender(data, type, row, meta) {
            if (censor && meta.col == 2) {
                return "R$ ******";
            } else {
                let conteudo = data.toString();
                if(conteudo.includes(".")){
                    conteudo = conteudo.replace(".", ",");
                    return "R$ "+conteudo
                }else{
                    return "R$ "+data+",00";
                }
                
            }
        }

        function customRenderVolume(data, type, row, meta) {
            if (meta.col == 1) {
                return '<input type="text" name="volumes[]" class="form-control" value="' + data + '">';
            } else {
                return data;
            }
        }

        $('#dataTable').DataTable({
            data: data,
            columns: [
                { data: 'cliente' },
                { data: 'volume', render: customRenderVolume},
                { data: 'fee', render: customRender },
                { data: 'classificacao' },
                { data: 'updated_at' }
            ]
            });

        $('#btnMostrarCensurados').click(function() {
            censor = !censor; // inverte o valor da variável "censor"
            // redefine a função de renderização com o novo valor de "censor"
            $("#dataTable").dataTable().fnDestroy();
            $('#dataTable').DataTable({
                data: data,
                columns: [
                    { data: 'cliente' },
                    { data: 'volume', render: customRenderVolume},
                    { data: 'fee', render: customRender },
                    { data: 'classificacao' },
                    { data: 'updated_at' }
                ]
            });
        });
    });
</script>