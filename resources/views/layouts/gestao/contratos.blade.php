@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper - Contratos')
@section('pagina', 'NET CONTRATOS')

@section('conteudo')

<style>
    .hidden-fee{
        display: none;
    }
    .tamanho-imagem {
        width: 50px;
    }
</style>


    <div class="main-content animate__animated animate__fadeIn animate__slow">
        <div class="container-fluid">

            @include('layouts.template-partials.alerts')
            <form id="formAno" action="/net-contratos/" method="GET">
            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-4">
                    <select name="anoRef" id="ano" class="form-control-select mt-3" required>
                        <option disabled selected value>  <?php if(isset($anoRef)){echo "Ano de referência: " . $anoRef;}else{echo "Ano Ref.:";} ?></option>
                        @foreach($anos_com_kickoff AS $ano)
                        <option value="{{$ano->ano_filtro}}">{{$ano->ano_filtro}}</option>
                        @endforeach
                    </select> 
                    
                </div>
                <div class="col-3">
                    <button class="btn btn-info ativar-button btn-circle btn-sm mt-4" id="sendFormAno"><i class="fas fa-undo-alt"></i>
                        Atualizar</button>
                        <button type="button" class="btn btn-info ativar-button btn-circle btn-sm mt-4" id="mostrar-fee">
                            <i class="fa-solid fa-eye"></i></button>
                        <button type="button" class="btn btn-info ativar-button btn-circle btn-sm mt-4" onclick="abrir_modal_filtros_net()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                              </svg></button>
                              @if (Auth::user()->acesso == 'Master')
                              <button title="Adicionar contrato" type="button" class="btn btn-info ativar-button btn-circle btn-sm mt-4" id="btn-contrato-adicionar">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                                  </svg></button>
                                  @endif
                </div>
            </div>
            </form>

            @include('layouts.gestao.partials.widgets-contratos')
            <div class="row mb-3 mt-1" id="iniciar_div">
                <div class="col-12 lista-clientes-box">
                    <div class="card">
                        <div class="card-header topo-dash border-0 justify-content-center justify-content-lg-start"
                            style="z-index: 10000;">
                            <h3 class="mb-0 text-center text-lg-left"><button  type="button" data-toggle="collapse"
                                data-target="#collapseIniciar" aria-expanded="false" aria-controls="collapseIniciar"
                                   class="btn btn-info btn-sm" >
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                  </svg>
                                </button> Contratos para iniciar </h3>

                        </div>

                        <div class="table-responsive table-solicitacoes collapse show" id="collapseIniciar">

                            @include('layouts.gestao.partials.lista-contratos-iniciar')

                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3 mt-1" id="iniciados_div">
                <div class="col-12 lista-clientes-box">
                    <div class="card">
                        <div class="card-header topo-dash border-0 justify-content-center justify-content-lg-start"
                            style="z-index: 10000;">
                            <h3 class="mb-0 text-center text-lg-left"><button  type="button" data-toggle="collapse"
                                data-target="#collapseAtivos" aria-expanded="false" aria-controls="collapseAtivos"
                                   class="btn btn-info btn-sm" >
                                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                  </svg>
                                </button> Contratos iniciados </h3>
                        </div>

                        <div class="table-responsive table-solicitacoes collapse show" id="collapseAtivos">

                            @include('layouts.gestao.partials.lista-contratos-ativos')

                        </div>
                    </div>
                </div>
            </div>


                <div class="row mb-3 mt-1" id="aviso_div">
                    <div class="col-12 lista-clientes-box">
                        <div class="card">
                            <div class="card-header topo-dash border-0 justify-content-center justify-content-lg-start"
                                style="z-index: 10000;">
                                <h3 class="mb-0 text-center text-lg-left"><button  type="button" data-toggle="collapse"
                                    data-target="#collapseAviso" aria-expanded="false" aria-controls="collapseAviso"
                                    class="btn btn-info btn-sm" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                      </svg>
                                    </button> Contratos em Aviso Prévio </h3>
                            </div>

                            <div class="table-responsive table-solicitacoes collapse show" id="collapseAviso">

                                @include('layouts.gestao.partials.lista-contratos-aviso-previo')

                            </div>
                        </div>
                    </div>
                </div>

            <div class="row mb-3 mt-1" id="cancelados_div">
                <div class="col-12 lista-clientes-box">
                    <div class="card">
                        <div class="card-header topo-dash border-0 justify-content-center justify-content-lg-start"
                            style="z-index: 10000;">
                            <h3 class="mb-0 text-center text-lg-left"><button  type="button" data-toggle="collapse"
                                data-target="#collapseCancelado" aria-expanded="false" aria-controls="collapseCancelado"
                                class="btn btn-info btn-sm" >
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-up" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                                  </svg>
                                </button> Contratos cancelados</h3>
                        </div>

                        <div class="table-responsive table-solicitacoes collapse show" id="collapseCancelado">

                            @include('layouts.gestao.partials.lista-contratos-cancelados')

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @include('layouts.gestao.partials.modal-editar-contrato')
    @include('layouts.gestao.partials.modal_alocar_servico')
    @include('layouts.gestao.partials.modal-excluir-contrato')
    @include('layouts.gestao.partials.modal-filtros-net')
    <script>
        $('#sendFormAno').on('click', ()=>{
            var form = document.getElementById("form-id");
            form.submit();
        });
        $('#mostrar-fee').on('click', ()=>{
            var mostrar = document.getElementsByClassName("hidden-fee");
            var ocultar = document.getElementsByClassName("display-fee");

            for(let i = 0; i < mostrar.length; i++){
                if(ocultar[i].innerHTML === "R$ *******"){
                    ocultar[i].innerHTML = mostrar[i].innerHTML;
                    document.getElementById("mostrar-fee").innerHTML = "<i class=\"fa-solid fa-eye\"></i>";
                }else{
                    ocultar[i].innerHTML = "R$ *******";
                    document.getElementById("mostrar-fee").innerHTML = "<i class=\"fa-solid fa-eye\"></i>";
                }
            }

        });
        $(document).ready(function() {
            // PROGRAMACAO MODAL
            document.getElementById('btn-contrato-adicionar').addEventListener('click', function() {
                document.getElementById(`contrato-modal`).classList.add(
                    "modal-visivel");
            });

            document.getElementById('close-modal-contrato').addEventListener('click',
                function() {
                    document.getElementById(`contrato-modal`).classList.remove(
                        "modal-visivel");
                });

        });
    </script>

    <script>
        function navegate_cliente(id, servico){
        window.location.href = "/cliente/" + id + "/?servico=" + servico;
    }
    </script>

<script>

    function abrir_modal_alocar_servico(servico, id, possiveis_alocacoes){
        possiveis_alocacoes = JSON.parse(possiveis_alocacoes);
        for(var item in possiveis_alocacoes){
            document.getElementById('contrato_id_alocar').value = id;
            document.getElementById('form-content-alocar').innerHTML += "<div class=\"custom-control custom-checkbox mb-3 col-md-4\">"+
                                    "<input type=\"checkbox\" class=\"custom-control-input\""+
                                        "id=\""+servico + possiveis_alocacoes[item].sub_servico +"\" name=\"alocados[]\""+
                                        "value=\""+possiveis_alocacoes[item].servico_id+"\">"+
                                    "<label class=\"custom-control-label\" for=\""+servico + possiveis_alocacoes[item].sub_servico +"\">"+servico + "->"+possiveis_alocacoes[item].sub_servico +" </label>"+
                                "</div>";
        }
        document.getElementById('alocar-servico').classList.add(
                    "modal-visivel");
    }

    function fechar_modal_alocar_servico(){
        document.getElementById('alocar-servico').classList.remove(
                    "modal-visivel");
        document.getElementById('form-content-alocar').innerHTML = "";
    }

    function abrir_modal_editar(servico, id, kickoff, tipo, data_kickoff, data_cancelamento, data_ultimo_dia, fee){
        switch (tipo) {
            case "ativo" :
                document.getElementById('dtKicoffDiv').style.display = "";
                break;
            case "aviso previo" :
                document.getElementById('dtKicoffDiv').style.display = "";
                document.getElementById('dtCancelamentoDiv').style.display = "";
                document.getElementById('dtUltimoDiv').style.display = "";
                document.getElementById('cancelamento').value = data_cancelamento;
                document.getElementById('ultimo').value = data_ultimo_dia;
                break;
            case "cancelado" :
                document.getElementById('dtKicoffDiv').style.display = "";
                document.getElementById('dtCancelamentoDiv').style.display = "";
                document.getElementById('dtUltimoDiv').style.display = "";
                break;
        }
        document.getElementById('feeEditar').value = fee;
        document.getElementById('data_kickoff_editar').value = data_kickoff;
        document.getElementById('form-content').innerHTML += "<input type=\"hidden\" name=\"id\" value="+id+">";
        document.getElementById('editar-contrato').classList.add(
                    "modal-visivel");
    }

    function fechar_modal_editar(){
        document.getElementById('dtKicoffDiv').style.display = "none";
        document.getElementById('dtCancelamentoDiv').style.display = "none";
        document.getElementById('dtUltimoDiv').style.display = "none";
        document.getElementById('editar-contrato').classList.remove(
                        "modal-visivel");
    }

    function abrir_modal_excluir(id){
        document.getElementById('contrato_id_excluir').value = id;
        document.getElementById('excluir-contrato').classList.add(
                    "modal-visivel");
    }

    function fechar_modal_excluir(){
        document.getElementById('excluir-contrato').classList.remove(
                    "modal-visivel");
        document.getElementById('form-content-alocar').classList.remove(
                        "modal-visivel");
    }

    function abrir_modal_filtros_net(){
        document.getElementById('filtrar-net').classList.add(
                    "modal-visivel");
    }

    function fechar_modal_net(){
        document.getElementById('filtrar-net').classList.remove(
                        "modal-visivel");
    }
</script>

    @include('layouts.gestao.partials.cadastrar-contrato')




@endsection
