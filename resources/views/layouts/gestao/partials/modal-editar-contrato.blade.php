<div class="adicionar-candidato-modal" id="editar-contrato">
    <div class="col-lg-5 adicionar-candidato-seletivo-box">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" onclick="fechar_modal_editar()" id="close-modal-editar-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Editar contrato
                    </h3>
                </div>
            </div>
            <div class="card-body bg-secondary">
                <form action="{{ route('atualizar_contrato') }}" method="POST">
                    @csrf
                    <div class="form-group" id="">
                        <label for="feeEditar">FEE</label>
                        <input class="form-control money2" id="feeEditar" type="text" name="fee" placeholder="FEE">
                        <div id="dtKicoffDiv" style="display: none">
                            <label for="data_kickoff_editar">Data de kickoff</label>
                            <input class="form-control" type="date" name="data_kickoff" id="data_kickoff_editar">
                        </div>

                        <div id="dtCancelamentoDiv" style="display: none">
                            <label for="cancelamento">Data de solicitação de cancelamento</label>
                            <input class="form-control" type="date" name="data_solicitacao_cancelamento" id="cancelamento">
                        </div>

                        <div id="dtUltimoDiv" style="display: none">
                            <label for="ultimo">Data do ultimo dia</label>
                            <input class="form-control" type="date" name="data_ultimo_dia" id="ultimo">
                        </div>
                    </div>
                    <div class="form-group" id="form-content">

                    </div>
                    <div class="text-center">
                        <button class="btn btn-success mt-4">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<style type="text/css">
    .image-upload>input {
        display: none;

    }

    #uploadPreview {
        cursor: pointer;
    }
</style>

<script>
    $('#feeEditar').mask("#.##0,00", {reverse: true});
    function json_inputs(json_input, servico, id){
        servico = servico.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
        json_input = JSON.parse(json_input);
        if(document.getElementById(id).checked == true){
            document.getElementById('form_dinamico').innerHTML += '<h6 class="heading-small text-muted mb-4 text-center text-lg-left '+servico+'" '+servico+'> '+servico+'</h6>';
            json_input.forEach(element => {
            document.getElementById('form_dinamico').innerHTML +=
                       ' <div class="row '+servico+'" style="margin-bot: 20px;">' +
                                    '<p class="'+servico+'">'+element.name+'</p>'+
                                    '<input type="'+element.type+'" class="form-control '+servico+'"'+
                                        'id="'+element.name+servico+'" name="'+element.name+servico+'"'+
                                       ' value="" placeholder="'+servico+' '+element.name+'">'+
                        '</div>';
            });
            document.getElementById('form_dinamico').innerHTML +=
                       ' <div class="row '+servico+'" style="margin-bot: 20px;">' +
                                    '<p class="'+servico+' money2">fee</p>'+
                                    '<input type="number" class="form-control '+servico+'"'+
                                        'id="fee'+servico+'" name="fee'+servico+'"'+
                                       ' value="" placeholder="'+servico+' fee">'+
                        '</div>';
        }else{
            remover = document.getElementsByClassName(servico);
            while(remover.length > 0){

                remover[0].remove();
                console.log(remover);
            }
        }

    }
</script>
