<div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Carteiras</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        @foreach ($analistas AS $analista)
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><img style="width: 50px" src="{{$analista['usuario']['foto_usuario']}}" alt="{{$analista['nome']}}">
                                    <button id="" onclick="abrir_modal_excluir('{{$analista->nome}}', '{{$analista->id}}')" class="btn btn-danger ativar-button btn-circle btn-sm ml-1"  style="float: right" title="Excluir" onclick="">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button id="" onclick="abrir_modal_editar('{{json_encode($analista['carteira'])}}', '{{$analista->id}}')" class="btn btn-primary edit-button btn-circle btn-sm" style="float: right" title="Editar" onclick="">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    
                                </h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    @if(count($analista['carteira']) > 0)
                                    Clientes
                                    @else
                                    Sem Clientes
                                    @endif
                                </h6>
                                <p class="card-text">
                                    @foreach($analista['carteira'] AS $cliente)
                                        <a href="/cliente/{{$cliente->cliente_id}}"><span class="badge text-bg-primary">{{$cliente->empresa}}</span></a>
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>