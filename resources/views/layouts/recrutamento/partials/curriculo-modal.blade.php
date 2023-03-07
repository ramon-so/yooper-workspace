<div class="curriculo-modal" id="curriculo-modal-{{$candidato->candidato_id}}" style="height: 100%;">
    <div class="col-lg-11 curriculo-seletivo-box" style="height: 100%;">
        <img src="{{ asset('assets') }}/img/icons/close.webp" class="close-modal" id="close-modal-curriculo-{{$candidato->candidato_id}}" onclick="curriculoFechar({{$candidato->candidato_id}})">
        <div class="card shadow col-12 p-0 m-0" style="height: 100%;">
            <div class="card-header bg-white border-0">
                <div class="row align-items-center justify-content-center justify-content-lg-start">
                    <h4 class="mt-1 mb-1 ml-2 text-center text-lg-left">Visualizar Currículo
                    </h4>
                </div>
            </div>
            <div class="card-body bg-secondary" style="height: 100%;">
            @if (!$candidato->curriculo == "")
                <iframe src='{{ asset('storage')."/".$candidato->curriculo }}' class="col-12"
                    style="height: 100%;"></iframe>
            @else
                <p class="h3 text-center m-auto">Candidato sem currículo cadastrado</p>
            @endif
            </div>
        </div>
    </div>
</div>

<script>
    // PROGRAMACAO MODAL
    function curriculoAbrir(id) {
        document.getElementById(`curriculo-modal-${id}`).classList.add(
            "modal-visivel");
    }

    function curriculoFechar(id) {
        document.getElementById(`curriculo-modal-${id}`).classList.remove(
            "modal-visivel");
    }

</script>
