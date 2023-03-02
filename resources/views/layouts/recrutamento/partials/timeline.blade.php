<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Usuário</th>
            <th scope="col" class="sort" data-sort="nome">Data e Hora</th>
            <th scope="col" class="sort" data-sort="departamento">Parecer</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($candidatoParecers as $candidatoParecer)
        <tr scope="row" class="parecer-{{$candidatoParecer->candidato_id}}">
            <td class="budget">
                <div class="foto-solicitante" data-toggle="tooltip" data-placement="top"
                    title="{{$candidatoParecer->usuario_nome}}">
                    <img src='{{ asset("storage/usuarios/$candidatoParecer->usuario_foto") }}'>
                </div>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$candidatoParecer->created_at->format('d/m/Y - H:i')}}</span>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status parecer">{{$candidatoParecer->candidato_parecer}}</span>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
