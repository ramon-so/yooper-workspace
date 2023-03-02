@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Dashboard')
@section('pagina', 'Dashboard')

@section('conteudo')

@include('layouts.dashboard.partials.ferramentas')


<div class="row mb-5 ml-1 mr-1 ml-lg-3 mr-lg-3 mt-4">
    @include('layouts.dashboard.partials.ultimos-usuarios')
    @include('layouts.dashboard.partials.ultimos-dashboards')
</div>
   


<script>
    $('.dashboard-mobile').slick({
        dots: false,
        speed: 600,
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true,
        autoplay: false,
        prevArrow: $('.icon-prev'),
        nextArrow: $('.icon-next'),
        responsive: [{
            breakpoint: 650,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
            }
        }, ]
    });

</script>
@endsection
