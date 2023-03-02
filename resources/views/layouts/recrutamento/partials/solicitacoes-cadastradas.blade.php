<table class="table align-items-center table-flush">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Data da solicitação</th>
            <th scope="col" class="sort" data-sort="nome">Título</th>
            <th scope="col" class="sort" data-sort="departamento">Departamento</th>
            <th scope="col" class="sort" data-sort="subdepartamento">Subdepartamento</th>
            <th scope="col" class="sort" data-sort="nivel">Nível</th>
            <th scope="col" class="sort" data-sort="quantidade">Candidatos</th>
            <th scope="col" class="sort" data-sort="status">Status</th>
            <th scope="col" class="sort" data-sort="solicitante">Solicitante</th>
            @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH')
                <th scope="col" class="sort" data-sort="editar">Editar</th>
            @endif
            @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Master-RH')
                <th scope="col" class="sort" data-sort="aprovar">Aprovação</th>
            @endif
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($processos as $processo)
        <tr scope="row">
            <td>
                <span class="badge badge-dot mr-4">
                    <span class="status">{{$processo->created_at->format('d/m/Y')}}</span>
                </span>
            </td>
            <th>
                <div class="media align-items-center">
                    <div class="media-body">
                        <span class="name mb-0 text-sm">{{$processo->titulo}}</span>
                    </div>
                </div>
            </th>
            <td class="budget">
                {{$processo->departamento_nome}}
            </td>
             <td class="budget">
                @if($processo->subdepartamento_id == 0) 
                    --
                    @else
                    {{$processo->subdepartamento_nome}}
                @endif
            </td>
            <td class="budget">
                {{$processo->nivel_de}} - {{$processo->nivel_para}}
            </td>
            <td class="budget">
                {{$processo->qtd_candidatos}}
            </td>
            <td>
                <span class="badge badge-dot mr-4">
                    @if($processo->status == 'Pendente')
                    <i class="bg-danger"></i>
                    @else
                    <i class="bg-success"></i>
                    @endif
                    <span class="status">{{$processo->status}}</span>
                </span>
            </td>
            <td class="budget">
                <div class="foto-solicitante" data-toggle="tooltip" data-placement="top"
                    title="{{$processo->usuario_nome}}">
                    <img src='{{ asset("storage/usuarios/$processo->usuario_foto") }}'>
                </div>
            </td>
            @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Head' || Auth::user()->acesso == 'Master-RH')
            <td class="budget">
                <i class="fa-solid fa-pen-to-square processo" id="processo{{$processo->id}}"
                    onclick="processoEditarAbrir({{$processo->id}})"></i>
            </td>
            @endif
            @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Head' || Auth::user()->acesso == 'RH' || Auth::user()->acesso == 'Master-RH')
             <td class="budget">
                <i class="fa-solid fa-check processo" id="processo{{$processo->id}}"
                    onclick="processoAprovarAbrir({{$processo->id}})"></i>
            </td>
            @endif
            <div class="solicitacoes-cadastradas-modal" id="editar-modal-{{$processo->id}}">
                <div class="col-lg-5 solicitacao-processo-seletivo-box">
                    <img src="assets/img/icons/close.webp" class="close-modal" id="close-modal-{{$processo->id}}"
                        onclick="processoEditarFechar({{$processo->id}})">
                    <div class="card shadow col-12 p-0 m-0">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar solicitação</h4>
                            </div>
                        </div>
                        <div class="card-body bg-secondary">
                            
                            @include('layouts.recrutamento.partials.editar-processo')

                        </div>
                    </div>
                </div>
            </div>
           @if (Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Head' || Auth::user()->acesso == 'Master-RH' || Auth::user()->acesso == 'RH')
                <div class="solicitacoes-cadastradas-modal" id="aprovar-modal-{{$processo->id}}">
                    <div class="col-lg-5 solicitacao-processo-seletivo-box">
                        <img src="assets/img/icons/close.webp" class="close-modal" id="close-modal-{{$processo->id}}"
                            onclick="processoAprovarFechar({{$processo->id}})">
                        <div class="card shadow col-12 p-0 m-0">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center justify-content-center justify-content-lg-start">
                                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Aprovar solicitação</h4>
                                </div>
                            </div>
                            <div class="card-body bg-secondary">
                                
                                @include('layouts.recrutamento.partials.aprovar-processo')

                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <script>
                // PROGRAMACAO MODAL
                function processoEditarAbrir(id) {
                    document.getElementById(`editar-modal-${id}`).classList.add(
                        "modal-visivel");
                }

                function processoEditarFechar(id) {
                    document.getElementById(`editar-modal-${id}`).classList.remove(
                        "modal-visivel");
                }

                function processoAprovarAbrir(id) {
                    document.getElementById(`aprovar-modal-${id}`).classList.add(
                        "modal-visivel");
                }

                function processoAprovarFechar(id) {
                    document.getElementById(`aprovar-modal-${id}`).classList.remove(
                        "modal-visivel");
                }

            </script>
        </tr>
        @endforeach
    </tbody>
</table>
