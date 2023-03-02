<table class="table align-items-center table-flush" id="dataTable">
    <thead class="thead-light">
        <tr>
            <th scope="col"></th>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="data">Razão Social</th>
            <th scope="col" class="sort" data-sort="data">Fee total</th>
            <th scope="col" class="sort" data-sort="data">Quantidade de contratos</th>
            <th scope="col" class="sort" data-sort="nome">Acessar</th>
        </tr>
    </thead>
    <tbody class="list">
        @for ($i = 0; $i < count($cliente_lista); $i++)       
            <tr>
                <td>
                    <img class="tamanho-imagem" src="./../app/storage/app/app/public/clientes/cliente{{$cliente_lista[$i]['id']}}.jpeg" alt="Cliente sem logo"
                    onerror="this.src='./../app/storage/app/app/public/errors/imageNotFound.png'; this.onerror = null">
                </td>
                <td class="budget">
                    {{ $cliente_lista[$i]['empresa'] }}
                </td>
                <td class="budget">{{ $cliente_lista[$i]['razaosocial'] }}</td>
                <td>{{ $cliente_lista[$i]['fee_total'] }}</td>
                <td>{{ $cliente_lista[$i]['quantidade_contratos'] }}</td>
                <td> <button onclick="chamar_view_cliente_id({{ $cliente_lista[$i]['id'] }})" class="btn btn-info ativar-button btn-circle btn-sm"><i class="fa-solid fa-circle-info"></i>
                    Detalhes</button></td>
            </tr>
        @endfor
    </tbody>
</table>

<style>
    .qtd-contratos {
        text-align: center;
        color: #fff;
        font-size: 18px;
        border-radius: 18px;
        padding: 5px 10px 5px 10px;
    }
    .tamanho-imagem {
        width: 50px;
    }
</style>

<script>
    function chamar_view_cliente_id(id){
        window.location.href = "/cliente/" + id;
    }
</script>
