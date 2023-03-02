@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper - Clientes Ativos')
@section('pagina', 'Clientes Ativos')
@include('layouts.template-partials.alerts')

@section('conteudo')
<style>
    .hidden-fee{
        display: none;
    }
</style>
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">
        @include('layouts.gestao.partials.widgets-visao-ativos')
        @include('layouts.gestao.partials.modal-filtros-clientes-ativos')
        @include('layouts.gestao.partials.modal-cancelar-contratos')
        @include('layouts.gestao.partials.tabela-ativos-visao-ativos')
    </div>
</div>
@endsection

<script>

        

    function abrir_modal_filtrar_clientes_ativos(){
        document.getElementById('filtrar-clientes-ativos').classList.add(
                    "modal-visivel");
    }

    function fechar_modal_filtrar_clientes_ativos(){
        document.getElementById('filtrar-clientes-ativos').classList.remove(
                    "modal-visivel");
        document.getElementById('form-content-alocar').innerHTML = "";
    }

    function abrir_modal_cancelar_contrato(contratos){
        console.log(contratos);
        contratos.forEach(element => {
            console.log(element.contrato_id);
            $('#contratosSelect').append('<option value='+element.contrato_id+'>' + element.servico + '</option>');
        });
        document.getElementById('cancelar-contrato').classList.add(
                    "modal-visivel");
    }

    function fechar_modal_cancelar_contrato(){
        document.getElementById('cancelar-contrato').classList.remove(
                    "modal-visivel");
    }
    
    function cancelar_contrato() {
        const contrato_id = document.getElementById('contratosSelect').value;
        console.log(contrato_id);
        const data_cancelar = document.getElementById('data_solicitacao_cancelamento').value;
        const data_ultimo_dia = document.getElementById('data_ultimo_dia').value;
        if (data_cancelar) {
            if (data_ultimo_dia) {
                let Data = new FormData();
                const token = document
                    .querySelector('input[name="_token"]')
                    .value;
                Data.append('data_cancelar', data_cancelar);
                Data.append('data_ultimo_dia', data_ultimo_dia);
                Data.append('_token', token);

                const url = `/contrato/${contrato_id}/cancelar`;
                fetch(url, {
                    method: 'POST',
                    body: Data
                }).then(() => {
                    alert("Contrato cancelado com sucesso");
                });
            } else {
                alert('Por favor, inserir a quantidade de dias de aviso prévio que ele irá cumprir');
            }
        } else {
            alert('Por favor, inserir a Data de solicitação do cancelamento');
        }
    }
</script>