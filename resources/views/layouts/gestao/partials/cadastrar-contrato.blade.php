<div class="solicitacoes-cadastradas-modal" id="contrato-modal">
    <div class="col-lg-12 solicitacao-processo-seletivo-box">
        <img src="assets/img/icons/close.webp" class="close-modal" id="close-modal-contrato">
        <div class="card shadow col-12 p-0 m-0">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Cadastrar Contrato</h3>
                </div>
            </div>
            <div class="card-body bg-secondary">

                <form method="post" action="{{ route('cadastrar-contrato') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- Empresa --}}
                    <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Contrato</h6>
                    <p id="empresa"></p>

                    @include('layouts.template-partials.partials.selecionar-cliente')

                    <div class="form-group">
                        <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Serviços contratados</h6>
                        <div class="row">
                            @for ($i = 0; $i < count($lista_servicos); $i++)
                                <div class="custom-control custom-checkbox mb-3 col-md-4">
                                    <input type="checkbox" onChange="json_inputs({{ json_encode($lista_servicos[$i]->escopo) }}, '{{ $lista_servicos[$i]->nome }}', '{{ $lista_servicos[$i]->nome }}')" class="custom-control-input"
                                        id="{{ $lista_servicos[$i]->nome }}" name="servicos[]"
                                        value="{{ $lista_servicos[$i]->id }}">
                                    <label class="custom-control-label" for="{{ $lista_servicos[$i]->nome }}">
                                        {{ $lista_servicos[$i]->nome }} </label>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="form-select" name="origem" aria-label="Default select example">
                            <option selected disabled>Origem do contrato</option>
                            <option value="Site & Campanhas">Site & Campanhas</option>
                            <option value="Cross Sell">Cross Sell</option>
                            <option value="UpSell">UpSell</option>
                            <option value="Retomada de Parceria">Retomada de Parceria</option>
                            <option value="Indicação de Cliente Ativo">Indicação de Cliente Ativo</option>
                            <option value="Indicações de Parceiros">Indicações de Parceiros</option>
                            <option value="Evento Vtexday">Evento Vtexday</option>
                            <option value="Evento Fórum Ecommerce">Evento Fórum Ecommerce</option>
                            <option value="Outros Eventos">Outros Eventos</option>
                            <option value="Prospecção Ativa">Prospecção Ativa</option>
                          </select>
                    </div>
                    <div class="form-group" id="form_dinamico">

                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">Salvar</button>
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
                                    '<p class="'+servico+'">fee</p>'+
                                    '<input type="text" class="form-control '+servico+'"'+
                                        'id="fee'+servico+'" onkeyup="maskFee(this)" name="fee'+servico+'"'+
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
    function maskFee(input){
        $(input).mask("##0.00", {reverse: true});
    }
</script>
