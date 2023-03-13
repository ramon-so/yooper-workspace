{{-- {{ $_SERVER['REMOTE_ADDR'] }} --}}
{{-- 189.56.120.218
189.56.120.217 --}}

<style>
    .pointer{
        cursor: pointer;
    }
</style>

<div class="container-fluid mt-3 mb-3" style="padding-right: 0px !important; padding-left: 0px !important">
    <div class="header-body">

        <div class="row">
            <div class="col-xl-2 pointer col-lg-" onclick="nav('primeiro_mes')" >
                <div class="card card-stats mb-4 h-100 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Primeiro mês</h5>
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
            <div class="col-xl-2 pointer col-lg-6" onclick="nav('ultimo_mes')">
                <div class="card card-stats mb-4 h-100 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Ultimo mês </h5>
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
            <div class="col-xl-2 pointer col-lg-6" onclick="nav('recorrentes_mes')">
                <div class="card card-stats mb-4 h-100 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Ativos recorrentes</h5>
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
            <div class="col-xl-2 pointer col-lg-6" onclick="nav('pendentes_mes')">
                <div class="card card-stats mb-4 h-100 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Pendentes</h5>
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
            <div class="col-xl-2 pointer col-lg-6" onclick="nav('nda')">
                <div class="card card-stats mb-4 h-100 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Total</h5>
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
            <div class="col-xl-1 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <button onclick="abrir_modal_filtrar_clientes_ativos()" class="btn btn-sm btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                          </svg>
                    </button>
                </div>
            </div>
            <div class="col-xl-1 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <button type="button" class="btn btn-info btn-sm" id="mostrar-fee">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                          </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- -------------------SEGUNDA LINHA------------------ -->
<div class="container-fluid mt-3 mb-3" style="padding-right: 0px !important; padding-left: 0px !important">
    <div class="header-body">

        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Fee total</h5>
                                <span class="h2 display-fee font-weight-bold mb-0">R$ *******</span>
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
            <div class="col-xl-3 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Fee perdido </h5>
                                <span class="h2 display-fee font-weight-bold mb-0">R$ *******</span>
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
            <div class="col-xl-4 col-lg-6">
                <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body pb-1">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0 title-widgets">Saldo financeiro</h5>
                                <span class="h2 display-fee font-weight-bold mb-0">R$ *******</span>
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
            
            
            
        </div>
    </div>
</div>

<script>

$('#mostrar-fee').on('click', ()=>{
            var mostrar = document.getElementsByClassName("hidden-fee");
            var ocultar = document.getElementsByClassName("display-fee");

            for(let i = 0; i < mostrar.length; i++){
                if(ocultar[i].innerHTML === "R$ *******"){
                    ocultar[i].innerHTML = mostrar[i].innerHTML;
                    // document.getElementById("mostrar-fee").innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height="\20\" fill=\"currentColor\" class=\"bi bi-eye-slash-fill\" viewBox=\"0 0 16 16\">" +
                    //         "<path d=\"m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z\"/>"+
                    //         "<path d=\"M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z\"/>"+
                    //     "</svg>";
                }else{
                    ocultar[i].innerHTML = "R$ *******";
                    // document.getElementById("mostrar-fee").innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"currentColor\" class=\"bi bi-eye-fill\" viewBox=\"0 0 16 16">\" +
                    //             "<path d=\"M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z\"/>" +
                    //             "<path d=\"M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z\"/>"+
                    //         "</svg>";
                }
            }

        });
    
    function nav(filter){
        window.location.href = "./clientes-ativos?filterTab="+filter;
    }
</script>

<style>
    .title-widgets {
        font-size: 11px;
    }
</style>
