<table class="table align-items-center table-flush" id="dataTable">
    <thead class="thead-light">
        <tr>
            <th scope="col" class="sort" data-sort="data">Candidato</th>
            <th scope="col" class="sort" data-sort="nome">email</th>
            <th scope="col" class="sort" data-sort="nivel">Telefone</th>
            <th scope="col" class="sort" data-sort="quantidade">Linkedin</th>
            <th scope="col" class="sort" data-sort="quantidade">Curriculo</th>
            <th scope="col" class="sort" data-sort="quantidade">Data de Cadastro</th>
            <th scope="col" class="sort" data-sort="fonte">Fonte de Captação</th>
            <th scope="col" class="sort" data-sort="quantidade">Editar Candidato</th>
            <th scope="col" class="sort" data-sort="quantidade">Ver Candidato</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($candidatos as $candidato)
        <tr>
            <td class="budget">{{ $candidato->candidato_nome }}</td>
            <td class="budget">{{ $candidato->candidato_email }}</td>
            <td class="budget">{{\Carbon\Carbon::parse($candidato->data_nascimento)->format('d/m/Y')}}</td>
            <td class="budget">{{ $candidato->candidato_telefone }}</td>
            <td class="budget">
                <a href="{{$candidato->candidato_linkedin}}" target="_blank" class="linkedin" data-toogle="tooltip"
                    data-placement="top" title="Ver Linkedin"><i class="fa-brands fa-linkedin-in"></i></a>
            </td>
            <td class="budget">
                <span class="ver-pdf" data-toogle="tooltip" data-placement="top" title="Ver currículo"
                    onclick="curriculoAbrir({{$candidato->candidato_id}})"><i class="fa-solid fa-file-lines"></i></span>
            </td>
            <td class="budget">{{ $candidato->created_at->format('d/m/Y') }}</td>
            <td class="budget">{{ $candidato->captacao_nome }}</td>
            <td class="budget">
                <i class="fa-solid fa-pen-to-square processo" id="candidato-{{ $candidato->candidato_id }}"
                    onclick="candidatoEditarAbrir({{ $candidato->candidato_id }})"></i>
            </td>
            <td class="budget">
                <a href="/candidato/{{ $candidato->candidato_id }}" class="link-ver">
                    <span class="ver-usuarios-cadastrados"><i class="fa-solid fa-eye"></i> Ver candidato</span>
                </a>
            </td>
        </tr>
        @include('layouts.recrutamento.partials.curriculo-modal')

        <div class="solicitacoes-cadastradas-modal" id="editar-modal-{{$candidato->candidato_id}}">
            <div class="col-lg-5 solicitacao-processo-seletivo-box">
                <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal"
                    id="close-modal-{{$candidato->candidato_id}}"
                    onclick="candidatoEditarFechar({{$candidato->candidato_id}})">
                <div class="card shadow col-12 p-0 m-0">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar candidato</h4>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">

                        @include('layouts.recrutamento.partials.editar-candidatos-banco')

                    </div>
                </div>
            </div>
        </div>
        <script>
            // PROGRAMACAO MODAL
            function candidatoEditarAbrir(id) {
                document.getElementById(`editar-modal-${id}`).classList.add(
                    "modal-visivel");
            }

            function candidatoEditarFechar(id) {
                document.getElementById(`editar-modal-${id}`).classList.remove(
                    "modal-visivel");
            }

        </script>
        @endforeach
    </tbody>
</table>
