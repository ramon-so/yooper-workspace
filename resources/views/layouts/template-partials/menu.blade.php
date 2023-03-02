<div class="menu-box" id="menu-box">
    <div class="logo-box">
        <span id="fechar-menu"><i class="fa-solid fa-xmark"></i></span>
        <img class="logo-yooper" src="{{ asset('assets') }}/img/yooper-digital-marketing-logo.png">
    </div>
    <ul>
        <li><a href="/dashboard"><span id="icon-dashboard"><i class="fa-solid fa-gauge"></i></span>Home</a></li>
        <li><a href="/yoodash"><img id="icon-yoodash" src="{{ asset('assets') }}/img/icons/yoodash.png">Yoo.Dash</a></li>
    </ul>
    <hr class="hr-menu">
    <ul>

    @if (Auth::user()->acesso == 'Master')
        @include('layouts.template-partials.menus.master-menu')

    @elseif(Auth::user()->acesso == 'Master-RH')
        @include('layouts.template-partials.menus.master-rh-menu')

    @elseif(Auth::user()->acesso == 'Head')
        @include('layouts.template-partials.menus.head-menu')

    @elseif(Auth::user()->acesso == 'RH')
        @include('layouts.template-partials.menus.rh-menu')

    @elseif(Auth::user()->acesso == 'Colaborador')
        @include('layouts.template-partials.menus.colaborador-menu')

    @elseif(Auth::user()->acesso == 'Administrador')
        @include('layouts.template-partials.menus.administrador-menu')

    @elseif(Auth::user()->acesso == 'Financeiro')
        @include('layouts.template-partials.menus.financeiro-menu')

    @endif
    </ul>
</div>

<script>
    var abrirMenu = document.getElementById('abrir-menu');
    var fecharMenu = document.getElementById('fechar-menu');
    var menuBox = document.getElementById('menu-box');

    abrirMenu.addEventListener('click', function () {
        menuBox.style.left = '0px';
    });

    fecharMenu.addEventListener('click', function () {
        menuBox.style.left = '-100%';
    });

</script>