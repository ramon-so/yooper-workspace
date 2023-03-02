<div class="parecer-modal" id="parecer-modal-{{$processoSeletivo->processo_id}}">
    <div class="col-lg-9 parecer-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal"
            id="close-modal-parecer-{{$processoSeletivo->processo_id}}"
            onclick="parecerFechar({{$processoSeletivo->processo_id}})">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Lista de parecer do processo</h4>
                </div>
            </div>
            <div class="card-body bg-secondary" style="overflow:auto;">

                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="sort" data-sort="data">Usuário</th>
                            <th scope="col" class="sort" data-sort="nome">Data e Hora</th>
                            <th scope="col" class="sort" data-sort="departamento">Parecer</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($processoParecers as $processoParecer)
                        <tr scope="row" class="parecer-{{$processoSeletivo->id}}">
                            <td class="budget">
                                <div class="foto-solicitante" data-toggle="tooltip" data-placement="top"
                                    title="{{$processoParecer->usuario_nome}}">
                                    <img src='{{ asset("storage/usuarios/$processoParecer->usuario_foto") }}'>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-dot mr-4">
                                    <span class="status">{{$processoParecer->created_at->format('d/m/Y - H:i')}}</span>
                            </td>
                            <td>
                                <span class="badge badge-dot mr-4">
                                    <span class="status parecer">{{$processoParecer->processo_parecer}}</span>
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
