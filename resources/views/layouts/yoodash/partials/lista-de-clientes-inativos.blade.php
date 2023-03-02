<table class="table align-items-center table-flush" id="dataTableInativo">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="nome">Conta</th>
            <th scope="col" class="sort" data-sort="departamento">Usuários Cadastrados</th>
            <th scope="col" class="sort" data-sort="nivel">Plano Integrado</th>
            <th scope="col" class="sort" data-sort="quantidade">Yoo.Dash</th>
            @if (Auth::user()->acesso == 'Master')
            <th scope="col" class="sort" data-sort="inativar">Ativar Dashboard</th>
            @endif
        </tr>
    </thead>
    <tbody class="list">
        @for ($i = 0; $i < count($contas); $i++) @if ($contas[$i]->status == "Inativo")
            <tr>
                <td class="budget">{{ $contas[$i]->cliente }} | #{{ $contas[$i]->id }}</td>
                <td class="budget">{{ $contas[$i]->conta }}</td>
                <td class="budget position-relative">
                    <span class="ver-usuarios-cadastrados"><i class="fa-solid fa-eye"></i> Ver usuários</span>
                    @if($contas[$i]->email != "")
                    <div class="usuarios-cadastrados">{{ $contas[$i]->email }}</div>
                    @else
                    <div class="usuarios-cadastrados">--</div>
                    @endif
                </td>
                <td class="budget"><a target="_blank"
                        href="https://agencia-yooper.monday.com/boards/{{ $contas[$i]->plano_integrado_id }}"><img
                            src="assets/img/icons/monday.png" class="acessar-cadastro">Acessar</a></td>
                <td class="budget"><a href="/yoodash/{{ $contas[$i]->conta }}"><img src="assets/img/icons/yoodash.png"
                            class="acessar-cadastro">Acessar</a></td>
                @if (Auth::user()->acesso == 'Master')
                    <td class="budget">
                        <form action="/yoodash/{{ $contas[$i]->id }}/ativar" method="POST" class="formulario">
                            @csrf
                            <input type="text" name="status" value="Ativo" hidden>
                            <button class="btn btn-success ativar-button btn-circle btn-sm"><i
                        class="fas fa-undo-alt"></i></button>
                        </form>
                    </td>
                @endif
            </tr>
            @endif
            @endfor
    </tbody>
</table>
