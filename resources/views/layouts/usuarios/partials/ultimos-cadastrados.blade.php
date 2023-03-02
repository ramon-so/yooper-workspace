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
        @endforeach
    </tbody>
</table>
