<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0,
            user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/css/bootstrap.min.css"
        integrity="sha512-o/MhoRPVLExxZjCFVBsm17Pkztkzmh7Dp8k7/3JrtNCHh0AQ489kwpfA3dPSHzKDe8YCuEhxXq3Y71eb/o6amg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link type="text/css" href="{{ asset('assets') }}/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link type="text/css" href="{{ asset('assets') }}/css/argon.css?v=1.0.0" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets') }}/css/slick.css" rel="stylesheet">
    <link type="text/css" href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    <script src="{{ asset('assets') }}/js/jquery/jquery.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery-easing/jquery.easing.min.js"></script>
    <script src="{{ asset('assets') }}/js/jquery.mask.js"></script>
    <script src="{{ asset('assets') }}/js/script.js"></script>
    <script src="{{ asset('assets') }}/js/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js" integrity="sha512-jTgBq4+dMYh73dquskmUFEgMY5mptcbqSw2rmhOZZSJjZbD2wMt0H5nhqWtleVkyBEjmzid5nyERPSNBafG4GQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/inputmask.min.js" integrity="sha512-czERuOifK1fy7MssE4JJ7d0Av55NPiU2Ymv4R6F0mOGpyPUb9HkP9DcEeE+Qj9In7hWQHGg0CqH1ELgNBJXqGA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        .bg-warning{
            background-color: #FFC107!important;
        }
    </style>
</head>

<body class="{{ $class ?? '' }}">

    <header class="col-12 p-0 row justify-content-center align-items-center bg-primary m-0">
        <div class="navbar navbar-top navbar-dark col-12 pl-5 pr-5  d-flex header-top justify-content-between align-items-center p-3 border-bottom position-relative">
        <span id="abrir-menu"><i class="fa-solid fa-bars"></i></span>
            <p class="h4 mb-0 text-white text-uppercase d-block bem-vindo">
                Olá, {{ $infos_func[0]->nome_funcionario}}
            </p>
            <input type="checkbox" name="input-sair" hidden id="input-sair">
            <div class="botoes-header">
            <label for="input-sair" class="btn-perfil d-flex justify-content-end align-items-center position-relative">
                <div class="foto-solicitante" data-toggle="tooltip" data-placement="bottom" title="{{ Auth::user()->nome }}">
                    <img src='{{ asset("storage/usuarios/".Auth::user()->foto_usuario) }}'>
                </div>
                <a href="{{ route('perfil') }}" class="perfil">Meu perfil</a>
            </label>
            <a href="/sair" id="btn-sair" data-toggle="tooltip" data-placement="bottom" title="Sair"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
        <div class="col-12 pl-5 pr-5  header-bottom pb-3 pt-3">
            <h1 class="display-2 text-white d-flex justify-content-start align-items-start align-items-lg-center"><span class="arrow-pagina"><i class="fa-solid fa-angles-right"></i></span> @yield('pagina')</h1>
        </div>
    </header>
    @include('layouts.template-partials.menu')

    @yield('conteudo')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0-beta1/js/bootstrap.min.js"
        integrity="sha512-Hqe3s+yLpqaBbXM6VA0cnj/T56ii5YjNrMT9v+us11Q81L0wzUG0jEMNECtugqNu2Uq5MSttCg0p4KK0kCPVaQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('material')
            }}/js/core/bootstrap-material-design.min.js"></script>
    <script src="{{ asset('material')
            }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!-- Plugin for the momentJs  -->
    <script src="{{ asset('material') }}/js/plugins/moment.min.js"></script>
    <!--  Plugin for Sweet Alert -->
    <script src="{{ asset('material') }}/js/plugins/sweetalert2.js"></script>
    <!-- Forms Validations Plugin -->
    <script src="{{ asset('material') }}/js/plugins/jquery.validate.min.js"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('material')
            }}/js/plugins/jquery.bootstrap-wizard.js"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('material')
            }}/js/plugins/bootstrap-selectpicker.js"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('material')
            }}/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
    <script src="{{ asset('material')
            }}/js/plugins/jquery.dataTables.min.js"></script>
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('material') }}/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="{{ asset('material') }}/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="{{ asset('material') }}/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('material') }}/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('material') }}/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE'"></script>
    <!-- Chartist JS -->
    <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('material') }}/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <!-- Material Dashboard DEMO methods, don't include it in your project! -->
    <script src="{{ asset('material') }}/demo/demo.js"></script>
    <script src="{{ asset('material') }}/js/settings.js"></script>
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js">
    </script>
   
    @stack('js')

    <script>
        $(document).ready(function(){
            $(".solicitacoes-cadastradas-modal").appendTo("body");
            $(".curriculo-modal").appendTo("body");
            $(".adicionar-candidato-modal").appendTo("body");
        });

        $('.money2').mask("#.##0,00", {reverse: true});

        var solicitante = document.getElementsByClassName('solicitante');

        for (var z = 0; z < solicitante.length; z++) {
            solicitante[z].innerHTML = solicitante[z].innerText.replace(".", " ");
        }
    </script>
</body>

</html>
