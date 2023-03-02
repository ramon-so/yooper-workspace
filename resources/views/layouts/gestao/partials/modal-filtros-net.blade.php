<div class="adicionar-candidato-modal" id="filtrar-net">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_net()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Filtrar net
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form action="{{route('contratos_view')}}" method="GET" enctype="multipart/form-data">
                    @csrf                    
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
                    
                    <label for="">Data do último dia</label>
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
                                <input id="" name="fee_inicial" type="text" class="form-control money2">
                            </div>
                            <div class="col">
                                <p>Fee máximo</p>
                                <input id="" name="fee_final" type="text" class="form-control money2">
                            </div>
                        </div>
                    </div>

                    <label for="">Serviço </label>
                    <div class="form-group" id="">
                        <select class="form-control" name="servico" id="">
                            <option value="MÍDIA">MÍDIA</option>
                            <option value="SOCIAL">SOCIAL</option>
                            <option value="BLOG">BLOG</option>
                            <option value="INFLUENCERS">INFLUENCERS</option>
                            <option value="DEV">DEV</option>
                            <option value="CRIAÇÃO">CRIAÇÃO</option>
                            <option value="CRM">CRM</option>
                            <option value="SEO">SEO</option>
                        </select>
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