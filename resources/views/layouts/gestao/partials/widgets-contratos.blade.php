{{-- {{ $_SERVER['REMOTE_ADDR'] }} --}}
{{-- 189.56.120.218
189.56.120.217 --}}


<div class="container-fluid mt-3 mb-3" style="padding-right: 0px !important; padding-left: 0px !important">
    <div class="header-body">

        <div class="row">
            <div class="col-xl-1 col-lg-6" >
            </div>
            <div class="col-xl-2 col-lg-6" style="display: none">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets"
                                    style="display: none">Contratos totais</h5>
                                <span
                                    class="h2 font-weight-bold mb-0">{{ $total_contratos + count($contratos_widget_aviso_previo_cancelados) + $alocados_aviso_previo_cancelados }}</span>
                                <p class="hidden-fee">R$
                                    {{ number_format($fee_pendentes + $fee_ativos + $fee_cancelados + $fee_aviso_previo, 2, ',', '.') }}
                                </p>
                                <p class="display-fee" style="font-size: 12px; font-weight:bold">R$ *******</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fa-solid fa-file-contract"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-6  pointer" onclick="tabFilter('iniciar')">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Contratos
                                    <br> pendentes</h5>
                                <span class="h2 font-weight-bold mb-0">{{ count($contratos_widget_pendentes) + $alocdos_pedentes }}</span>
                                <p class="hidden-fee">R$ {{ number_format(($fee_pendentes), 2, ',', '.')}}</p>
                                <p class="display-fee" style="font-size: 12px; font-weight:bold">R$ *******</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-6 h-100 pointer" onclick="tabFilter('iniciado')">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Contratos
                                    <br>iniciados
                                </h5>
                                <span
                                    class="h2 font-weight-bold mb-0">{{ count($contratos_widget_ativos) + $alocados_ativos }}</span>
                                <p class="hidden-fee">R$ {{ number_format($fee_ativos, 2, ',', '.') }}</p>
                                <p class="display-fee" style="font-size: 12px; font-weight:bold">R$ *******</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-6 h-100 pointer" onclick="tabFilter('aviso')">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Contratos <br>Aviso
                                    Prévio</h5>
                                <span
                                    class="h2 font-weight-bold mb-0">{{ count($contratos_widget_aviso_previo_ativos) + count($contratos_widget_aviso_previo_cancelados) + $alocados_aviso_previo_ativos + $alocados_aviso_previo_cancelados }}</span>
                                <p class="hidden-fee">R$ {{ number_format($fee_aviso_previo, 2, ',', '.') }}</p>
                                <p class="display-fee" style="font-size: 12px; font-weight:bold">R$ *******</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-6 h-100 pointer" onclick="tabFilter('cancelado')">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Contratos
                                    <br>Cancelados
                                </h5>
                                <span
                                    class="h2 font-weight-bold mb-0">{{ count($contratos_widget_cancelados) + $alocados_cancelados }}</span>
                                <p class="hidden-fee">R$ {{ number_format($fee_cancelados, 2, ',', '.') }}</p>
                                <p class="display-fee" style="font-size: 12px; font-weight:bold">R$ *******</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-6 h-100 pointer" onclick="tabFilter('todos')">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">NET <br>CONTRATOS
                                </h5>
                                <span class="h2 font-weight-bold mb-0">{{ $net }}</span>
                                <p class="hidden-fee">R$ {{ number_format($fee_ativos + $fee_aviso_previo - $fee_aviso_cancelados - $fee_cancelados, 2, ',', '.') }}</p>
                                <p class="display-fee" class="display-fee" style="font-size: 12px; font-weight:bold">R$ *******</p>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                    <i class="fa-solid fa-face-smile"></i>
                                </div>
                            </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-1 col-lg-6" >
            </div>
        </div>
    </div>
</div>

<script>
    function tabFilter(filtro){
        switch(filtro){
            case 'iniciar':
                document.getElementById('iniciar_div').style.display = "";
                document.getElementById('iniciados_div').style.display = "none";
                document.getElementById('aviso_div').style.display = "none";
                document.getElementById('cancelados_div').style.display = "none";
                break;
            case 'iniciado':
                document.getElementById('iniciar_div').style.display = "none";
                document.getElementById('iniciados_div').style.display = "";
                document.getElementById('aviso_div').style.display = "none";
                document.getElementById('cancelados_div').style.display = "none";
                break;
            case 'aviso':
                document.getElementById('iniciar_div').style.display = "none";
                document.getElementById('iniciados_div').style.display = "none";
                document.getElementById('aviso_div').style.display = "";
                document.getElementById('cancelados_div').style.display = "none";
                break;
            case 'cancelado':
                document.getElementById('iniciar_div').style.display = "none";
                document.getElementById('iniciados_div').style.display = "none";
                document.getElementById('aviso_div').style.display = "none";
                document.getElementById('cancelados_div').style.display = "";
                break;
            case 'todos':
                document.getElementById('iniciar_div').style.display = "";
                document.getElementById('iniciados_div').style.display = "";
                document.getElementById('aviso_div').style.display = "";
                document.getElementById('cancelados_div').style.display = "";
                break;
        }
    }
</script>

<style>
    .title-widgets {
        font-size: 11px;
    }
    .pointer:hover{
        cursor: pointer;
    }
</style>
