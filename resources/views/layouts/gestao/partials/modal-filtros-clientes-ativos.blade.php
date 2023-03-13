<div class="adicionar-candidato-modal" id="filtrar-clientes-ativos">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_filtrar_clientes_ativos()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar contato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form action="{{route('clientes_ativos')}}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <label for="">Cliente ID</label>
                    <div class="form-group" id="">
                        <select id="myCliente" class="form-control" name="cliente_id">
                            <option value=""></option>
                        </select>
                    </div>
                    
                    <label for="">Data de kickoff</label>
                    <div class="form-group" id="">
                        <div class="row">
                            <div class="col">
                                <p>Data inicial</p>
                                <input id="" name="data_kickoff_inicial" type="date" class="form-control">
                            </div>
                            <div class="col">
                                <p>Data final</p>
                                <input id="" name="data_kickoff_final" type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <label for="">Data de cancelamento</label>
                    <div class="form-group" id="">
                        <div class="row">
                            <div class="col">
                                <p>Data inicial</p>
                                <input id="" name="data_cancelamento_inicial" type="date" class="form-control">
                            </div>
                            <div class="col">
                                <p>Data final</p>
                                <input id="" name="data_cancelamento_final" type="date" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <label for="">Fee </label>
                    <div class="form-group" id="">
                        <div class="row">
                            <div class="col">
                                <p>Fee mínimo</p>
                                <input id="" name="fee_inicial" type="text" class="form-control">
                            </div>
                            <div class="col">
                                <p>Fee máximo</p>
                                <input id="" name="fee_final" type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    
                    <label for="">Projetos </label>
                    <div class="form-group" id="">
                        <select class="form-control" name="projetos" id="">
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>
                    
                    <div class="text-center">
                        <button class="btn btn-success mt-4">Atualizar</button>
                        <button class="btn btn-danger mt-4">Zerar filtros</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>