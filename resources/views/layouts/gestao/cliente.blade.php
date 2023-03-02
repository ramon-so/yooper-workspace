@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper - Cliente | ' . $cliente->empresa)
@section('pagina', $cliente->empresa)

@section('conteudo')
    @include('layouts.template-partials.alerts')
    <div class="main-content animate__animated animate__fadeIn animate__slow">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-4 tabela-cadastrados mt-3">
                    <div class="card">
                        @include('layouts.gestao.partials.cliente-informacoes')
                    </div>
                </div>

                <div class="col-lg-8 tabela-cadastrados mt-3">
                    <div class="card">
                        @if(count($contratos_ativos) > 0)
                        @include('layouts.gestao.partials.cliente-contratos')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.gestao.partials.modal-editar-contrato')
    @include('layouts.gestao.partials.modal-tabela-financeira')
    @include('layouts.gestao.partials.modal-editar-cliente')
    @include('layouts.gestao.partials.modal-adicionar-ferramenta-crm')
    @include('layouts.gestao.partials.modal-adicionar-ferramenta-blog')
    @include('layouts.gestao.partials.modal-adicionar-ferramenta-social')
    @include('layouts.gestao.partials.modal-adicionar-briefing')
    @include('layouts.gestao.partials.modal-adicionar-escopo')
    <style>
        .logo-cliente {
            left: 25% !important;
        }
    .tamanho-imagem {
        width: 50px;
    }
    </style>
    <script>

        function abrir_modal_editar(servico, id, fee){
            switch (servico) {
                case 'CRM':
                    document.getElementById('form-content').innerHTML += "<input type=\"hidden\" name=\"id\" value=\""+id+"\" class=\"form-control\" id=\"id\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Ferramentas de CRM</label>" +
                        "<input type=\"text\" name=\"ferramentas_crm\" class=\"form-control\" id=\"ferramentas_crm\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Disparos por semana</label>" +
                        "<input type=\"text\" name=\"disparos_semana_crm\" class=\"form-control\" id=\"disparos_crm\">";
                    break;

                case 'BLOG':
                    document.getElementById('form-content').innerHTML += "<input type=\"hidden\" name=\"id\" value=\""+id+"\" class=\"form-control\" id=\"id\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Conteúdos por mês</label>" +
                        "<input type=\"text\" name=\"conteudos_mes_blog\" class=\"form-control\" id=\"conteudos_mes_blog\">";
                    break;
                case 'SEO':
                    document.getElementById('form-content').innerHTML += "<input type=\"hidden\" name=\"id\" value=\""+id+"\" class=\"form-control\" id=\"id\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Desenvolvimento</label>" +
                        "<input type=\"text\" name=\"desenvolvimento_seo\" class=\"form-control\" id=\"desenvolvimento_seo\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Conteúdos por mês</label>" +
                        "<input type=\"text\" name=\"conteudos_mes_seo\" class=\"form-control\" id=\"conteudos_mes_seo\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Conteúdos Blog</label>" +
                        "<input type=\"text\" name=\"conteudos_blog_seo\" class=\"form-control\" id=\"conteudos_blog_seo\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Implementação</label>" +
                        "<input type=\"text\" name=\"implementacao_seo\" class=\"form-control\" id=\"implementacao_seo\">";
                    break;
                case 'INFLUENCERS':
                    document.getElementById('form-content').innerHTML += "<input type=\"hidden\" name=\"id\" value=\""+id+"\" class=\"form-control\" id=\"id\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Tipo de contrato</label>" +
                        "<input type=\"text\" name=\"tipo_contrato_influenciadores\" class=\"form-control\" id=\"tipo_contrato_influenciadores\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Influenciados no Escopo</label>" +
                        "<input type=\"text\" name=\"escopo_influeniadores\" class=\"form-control\" id=\"escopo_influeniadores\">";
                    break;
                case 'MÍDIA':
                    document.getElementById('form-content').innerHTML += "<input type=\"hidden\" name=\"id\" value=\""+id+"\" class=\"form-control\" id=\"id\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Canais ativos</label>" +
                        "<input type=\"text\" name=\"canais_ativos_midia\" class=\"form-control\" id=\"canais_ativos_midia\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Faixa de investimento</label>" +
                        "<input type=\"text\" name=\"faixa_investimento_midia\" class=\"form-control\" id=\"faixa_investimento_midia\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Forma de pagamento</label>" +
                        "<input type=\"text\" name=\"forma_pagamento_midia\" class=\"form-control\" id=\"forma_pagamento_midia\">";
                    break;
                case 'SOCIAL':
                    document.getElementById('form-content').innerHTML += "<input type=\"hidden\" name=\"id\" value=\""+id+"\" class=\"form-control\" id=\"id\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Gerenciamento das redes sociais</label>" +
                        "<input type=\"text\" name=\"gerenciamento_redes_sociais_social\" class=\"form-control\" id=\"gerenciamento_redes_sociais_social\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Quantidade de posts por semana</label>" +
                        "<input type=\"text\" name=\"posts_semana_social\" class=\"form-control\" id=\"posts_semana_social\">";
                    document.getElementById('form-content').innerHTML += "<label class=\"form-control-label\" for=\"input-data\">Budget de impulsionamento</label>" +
                        "<input type=\"text\" name=\"budget_impulsionamento_social\" class=\"form-control\" id=\"budget_impulsionamento_social\">";
                    break;
            
                default:
                    break;
            }
            document.getElementById('feeEditar').value = fee;
            document.getElementById('editar-contrato').classList.add(
                        "modal-visivel");
        }

        function fechar_modal_editar(){
            document.getElementById('form-content').innerHTML = "";
            document.getElementById('editar-contrato').classList.remove(
                            "modal-visivel");
        }

        function abrir_modal_editar_cliente(){
            document.getElementById('editar-cliente').classList.add(
                            "modal-visivel");
        }
        function fechar_modal_editar_cliente(){
            document.getElementById('editar-cliente').classList.remove(
                            "modal-visivel");
        }
        function abrir_modal_ferramenta(id, id_cliente){
            document.getElementById('contrato_id_ferramenta').value = id;
            document.getElementById('cliente_id_ferramenta').value = id_cliente;
            document.getElementById('adicionar-ferramenta-crm').classList.add(
                            "modal-visivel");
        }
        function abrir_modal_ferramenta_social(id, id_cliente){
            document.getElementById('contrato_id_ferramenta_social').value = id;
            document.getElementById('cliente_id_ferramenta_social').value = id_cliente;
            document.getElementById('adicionar-ferramenta-social').classList.add(
                            "modal-visivel");
        }
        function abrir_modal_ferramenta_blog(id, id_cliente){
            document.getElementById('contrato_id_ferramenta_blog').value = id;
            document.getElementById('cliente_id_ferramenta_blog').value = id_cliente;
            document.getElementById('adicionar-ferramenta-blog').classList.add(
                            "modal-visivel");
        }
        function fechar_modal_ferramenta(){
            document.getElementById('adicionar-ferramenta-crm').classList.remove(
                            "modal-visivel");
        }
        function fechar_modal_ferramenta_social(){
            document.getElementById('adicionar-ferramenta-social').classList.remove(
                            "modal-visivel");
        }
        function fechar_modal_ferramenta_blog(){
            document.getElementById('adicionar-ferramenta-blog').classList.remove(
                            "modal-visivel");
        }
    </script>

@endsection
