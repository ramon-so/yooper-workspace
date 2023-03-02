<div class="col-lg-6 tabela-cadastrados">
    <div class="card">
        <div class="card-header border-0 justify-content-center justify-content-lg-start position-relative">
            <div class="row align-items-center justify-content-lg-start position-relative">
                <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Últimos Yoo.Dash cadastrados</h3>
                <a href="{{ route('yoodash') }}"" class="ver-todos">Ver todos</a>
            </div>
        </div>
        <div class="table-responsive">

            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="sort" data-sort="cliente">Cliente</th>
                        <th scope="col" class="sort" data-sort="conta">Conta</th>
                        <th scope="col" class="sort" data-sort="yoodash">Yoo.Dash </th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($contas as $conta)
                    @if ($conta->status == 'Ativo')
                    <tr scope="row">
                        <td class="budget">
                            {{ $conta->cliente }} | #{{ $conta->id }}
                        </td>
                        <td class="budget">
                            {{ $conta->conta }}
                        </td>
                        <td class="budget"><a href="/yoodash/{{ $conta->conta }}"><img
                                    src="assets/img/icons/yoodash.png" class="acessar-cadastro">Acessar</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>
