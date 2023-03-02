<div class="col-lg-6 tabela-cadastrados">
    <div class="card">
        <div class="card-header border-0 justify-content-center justify-content-lg-start position-relative">
            <div class="row align-items-center justify-content-lg-start position-relative">
                <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Últimos funcionários cadastrados</h3>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="foto">Foto</th>
                        <th scope="col" class="sort" data-sort="usuario">Usuário</th>
                        <th scope="col" class="sort" data-sort="depto">Depto.</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($usuarios as $usuario)
                    @if ($usuario->ativo == 'Sim')
                    <tr scope="row">
                        <td class="budget">
                            <div class="foto-solicitante">
                                <img src='{{ asset("storage/usuarios/$usuario->foto_usuario") }}'>
                            </div>
                        </td>
                        <td class="budget">
                            {{ $usuario->nome }}
                        </td>
                        <td class="budget">
                            {{ $usuario->departamento }}
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
