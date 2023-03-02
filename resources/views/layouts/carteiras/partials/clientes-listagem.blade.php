<div class="card">
                    <div class="card-header border-0 justify-content-center justify-content-lg-start position-relative">
                        <div
                            class="row align-items-center justify-content-lg-start position-relative">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left info-processo">Clientes sem carteiras
                            </h3>
                        </div>
                    </div>
                    <div class="table-responsive barra">
                        <table class="table align-items-center table-flush barra">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="foto">Cliente</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($clientes_sem_carteiras AS $clientes_sem_carteiras_servicos)
                                    @foreach($clientes_sem_carteiras_servicos AS $cliente)
                                    <tr>
                                        <td>{{ $cliente->empresa }}</td>
                                        <td>
                                        <button id="" onclick="abrir_modal('{{ $cliente->empresa }}', '{{ $cliente->id }}', '{{$cliente->contrato_id}}')" class="btn btn-primary edit-button btn-circle btn-sm" style="float: right" title="Adicionar a carteira" onclick="">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                

