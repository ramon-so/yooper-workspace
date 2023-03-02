<table class="table align-items-center table-flush" id="dataTable">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Cliente</th>
            <th scope="col" class="sort" data-sort="nome">Conta</th>
            <th scope="col" class="sort" data-sort="departamento">Usuários Cadastrados</th>
            <th scope="col" class="sort" data-sort="nivel">Plano Integrado</th>
            <th scope="col" class="sort" data-sort="quantidade">Yoo.Dash</th>
            @if (Auth::user()->acesso == 'Master')
            <th scope="col" class="sort" data-sort="editar">Editar</th>
            <th scope="col" class="sort" data-sort="inativar">Inativar Dashboard</th>
            @endif
        </tr>
    </thead>
    <tbody class="list">
        @for ($i = 0; $i < count($contas); $i++) @if ($contas[$i]->status == "Ativo")
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
                 <i class="fa-solid fa-pen-to-square processo" id="cliente-{{ $contas[$i]->id}}"
                    onclick="clienteEditarAbrir({{ $contas[$i]->id}})"></i>
                <div class="solicitacoes-cadastradas-modal" id="editar-modal-{{ $contas[$i]->id}}">
                    <div class="col-lg-5 solicitacao-processo-seletivo-box">

                        <img src="assets/img/icons/close.webp" class="close-modal" id="close-modal-{{ $contas[$i]->id}}"
                            onclick="clienteEditarFechar({{$contas[$i]->id}})">
                        
                            <div class="card shadow col-12 p-0 m-0">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center justify-content-center justify-content-lg-start">
                                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Yoo.Dash</h4>
                                </div>
                            </div>
                            <div class="card-body bg-secondary">
                                
                                @include('layouts.yoodash.partials.editar-dashboard')

                            </div>
                        </div>
                    </div>
                </div>
                </td>
            @endif
            <script>
                // PROGRAMACAO MODAL
                function clienteEditarAbrir(id) {
                    document.getElementById(`editar-modal-${id}`).classList.add(
                        "modal-visivel");
                }

                function clienteEditarFechar(id) {
                    document.getElementById(`editar-modal-${id}`).classList.remove(
                        "modal-visivel");
                }

            </script>
                @if (Auth::user()->acesso == 'Master')
                    <td class="budget">
                        <form action="/yoodash/{{ $contas[$i]->id }}/inativar" method="POST" class="formulario">
                            @csrf
                            <input type="text" name="status" value="Inativo" hidden>
                            <button class="btn btn-danger inativar-button btn-circle btn-sm"><i
                                    class="fas fa-minus-circle"></i></button>
                        </form>
                    </td>
                @endif
            </tr>
            @endif
            @endfor
    </tbody>
</table>
