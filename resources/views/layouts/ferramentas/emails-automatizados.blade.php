@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | E-mails Automatizados')
@section('pagina', 'E-mails Automatizados')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">
        <div class="row mt-5 mb-5 d-flex justify-content-center align-items-center">

        <div class="col-12 col-lg-5 mb-4 mb-lg-0" id="cadastro_dp">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Gerar e-mail</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Selecionar tipo de e-mail</h6>
                        @csrf
                        <div class="form-row">
                            <div class="form-group mt-2 col-md-12">
                                <label for="emailRh">Tipo de e-mail</label>
                                <select name="email_id" id="emailRh" class="form-control"
                                    onchange="displayModelo(value)" required>
                                    <option disabled selected value> Selecione o tipo</option>
                                    <option value="3">[DP] - Férias 1 (6 meses)</option>
                                    <option value="2">[DP] - Férias 2 (1 ano)</option>
                                    <option value="7">[DP] - Boas-vindas</option>
                                    <option value="4">[DP] - Retorno Proposta CLT/Estágio</option>
                                    <option value="10">[DP] - Retorno Proposta PJ</option>
                                    <option value="5">[DP] - Solicitações Pendentes</option>
                                    <option value="6">[DP] - Bandeiras Yooper</option>
                                    <option value="8">[DP] - Promoção colaborador</option>
                                    <option value="1">[GYG] - Proposta Recrutamento</option>
                                    <option value="9">[INSTITUCIONAL] - Comunicado Clientes</option>
                                    <option value="11">[QUALIDADE] - Briefings</option>
                                    <option value="12">[QUALIDADE] - Boas vindas clientes</option>
                                </select>
                            </div>

                            @include('layouts.ferramentas.email-modelos.modelo-1.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-2.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-3.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-4.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-5.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-6.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-7.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-8.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-9.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-10.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-11.campos')
                            @include('layouts.ferramentas.email-modelos.modelo-12.campos')
                        </div>
                    </div>
                </div>
            </div>

            <div id="modelo1" class="col-7" style="display: none">
                {{-- @include('rh.email-modelos.modelo-1.cadastro') --}}
            </div>
            <div id="modelo2" class="col-7" style="display: none">
                {{-- @include('rh.email-modelos.modelo-2.cadastro') --}}
            </div>
        </div>

    </div>
</div>

<script>
    function displayModelo(id) {
        // mostrar campos
        var divsToHide = document.getElementsByClassName("campos");
        for (var i = 0; i < divsToHide.length; i++) {
            divsToHide[i].style.display = "none";
        }
        // document.getElementById(`modelo-${id}`).style.display = "block";
        document.getElementById(`campos-modelo-${id}`).style.display = "block";
    }

</script>
@endsection





</body>

</html>
