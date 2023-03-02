@foreach ($candidatos as $candidato)
<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="processo">Nome do Processo</th>
            <th scope="col" class="sort" data-sort="status">Status do Processo</th>
            <th scope="col" class="sort" data-sort="acessar">Acessar Processo</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($processoSeletivoCandidatos as $processoSeletivoCandidato)
        <tr scope="row" class="parecer-{{$processoSeletivoCandidato->candidato_id}}">
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">#{{ $processoSeletivoCandidato->processo_id }} - {{$processoSeletivoCandidato->processo_nome}}</span>
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$processoSeletivoCandidato->status_nome}}</span>
                </span>
            </td>
             <td>
                <a href="/processo-seletivo/{{ $processoSeletivoCandidato->processo_id }}/candidato/{{$candidato->candidato_id}}" class="link-ver">
                    <span class="ver-usuarios-cadastrados"><i class="fa-solid fa-eye"></i> Ver candidato</span>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach