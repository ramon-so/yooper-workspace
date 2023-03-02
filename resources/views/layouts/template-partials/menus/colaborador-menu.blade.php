@if (Auth::user()->departamento_id == 50)
    <li>
        <input type="checkbox" name="qualidade" hidden><label for="qualidade" id="qualidade"><span id="icon-qualidade"><i
                    class="fa-solid fa-check-double"></i></span>Plano Integrado<i
                class="fa-solid fa-angle-down menu-arrow" id="arrow-qualidade"></i></label>
        <ul class="sub-menu" id="sub-menu-qualidade">
            <li><a href="/plano-integrado/clientes">Relatório Plano Integrado</a></li>
            <li><a href="/cadastrar-plano-integrado">Novo Plano Integrado</a></li>
            <li><a href="/plano-integrado/cadastrar-demanda">Cadastrar Demanda</a></li>
        </ul>
    </li>

    <li>
        <input type="checkbox" name="gestaodemidia" hidden><label for="gestaodemidia" id="gestaodemidia"><span
                id="icon-gestaodemidia"><i class="fa-solid fa-list-check"></i></span>Gestão de Mídia<i
                class="fa-solid fa-angle-down menu-arrow" id="arrow-gestaodemidia"></i></label>
        <ul class="sub-menu" id="sub-menu-gestaodemidia">
            <li><a href="/receitas-e-consumos">Receitas e Consumos</a></li>
        </ul>
    </li>

    <li>
        <input type="checkbox" name="ferramentas" hidden><label for="ferramentas" id="ferramentas"><span
                id="icon-ferramentas"><i class="fa-solid fa-wrench"></i></span>Ferramentas<i
                class="fa-solid fa-angle-down menu-arrow" id="arrow-ferramentas"></i></label>
        <ul class="sub-menu" id="sub-menu-ferramentas">
            <li><a href="/emails-automatizados">E-mails Automatizados</a></li>
        </ul>
    </li>
@elseif(Auth::user()->departamento_id == 43)
    <li>
        <input type="checkbox" name="gestaodemidia" hidden><label for="gestaodemidia" id="gestaodemidia"><span
                id="icon-gestaodemidia"><i class="fa-solid fa-list-check"></i></span>Gestão de Mídia<i
                class="fa-solid fa-angle-down menu-arrow" id="arrow-gestaodemidia"></i></label>
        <ul class="sub-menu" id="sub-menu-gestaodemidia">
            <li><a href="/receitas-e-consumos">Receitas e Consumos</a></li>
        </ul>
    </li>

<li>
    <input type="checkbox" name="qualidade" hidden><label for="qualidade" id="qualidade"><span id="icon-qualidade"><i class="fa-solid fa-check-double"></i></span>Plano Integrado<i
            class="fa-solid fa-angle-down menu-arrow" id="arrow-qualidade"></i></label>
    <ul class="sub-menu" id="sub-menu-qualidade">
        <li><a href="/plano-integrado/cadastrar-demanda">Cadastrar Demanda</a></li>
    </ul>
</li>

@elseif(Auth::user()->departamento_id == 61 || Auth::user()->departamento_id == 53)

<li>
    <input type="checkbox" name="ferramentas" hidden><label for="ferramentas" id="ferramentas"><span
            id="icon-ferramentas"><i class="fa-solid fa-wrench"></i></span>Ferramentas<i
            class="fa-solid fa-angle-down menu-arrow" id="arrow-ferramentas"></i></label>
    <ul class="sub-menu" id="sub-menu-ferramentas">
        <li><a href="/emails-automatizados">E-mails Automatizados</a></li>
    </ul>
</li>

@else
    <li>
        <input type="checkbox" name="qualidade" hidden><label for="qualidade" id="qualidade"><span
                id="icon-qualidade"><i class="fa-solid fa-check-double"></i></span>Plano Integrado<i
                class="fa-solid fa-angle-down menu-arrow" id="arrow-qualidade"></i></label>
        <ul class="sub-menu" id="sub-menu-qualidade">
            <li><a href="/plano-integrado/cadastrar-demanda">Cadastrar Demanda</a></li>
        </ul>
    </li>
@endif

{{-- <li>
    <input type="checkbox" name="administracao" hidden><label for="administracao" id="clientes-contratos"><span
            id="icon-administracao"><i class="fa-solid fa-handshake"></i></span>Clientes & Contratos<i
            class="fa-solid fa-angle-down menu-arrow" id="arrow-clientes-contratos"></i></label>
    <ul class="sub-menu" id="sub-menu-clientes-contratos">
        <li><a href="/clientes">Clientes</a></li>
        <li><a href="/carteiras">Carteiras</a></li>
    </ul>
</li> --}}

<script>
    var submenu = document.getElementsByClassName("sub-menu");
    var arrow = document.getElementsByClassName("menu-arrow");

    var qualidade = document.getElementById("qualidade");
    var arrow_qualidade = document.getElementById("arrow-qualidade");
    var submenu_qualidade = document.getElementById("sub-menu-qualidade");

    if (qualidade) {

        qualidade.addEventListener('click', function() {
            if (!submenu_qualidade.classList.contains('sub-menu-aberto')) {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_qualidade.classList.add('sub-menu-aberto');
                    arrow_qualidade.classList.add('menu-arrow-rotate');
                }
            } else {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_qualidade.classList.remove('sub-menu-aberto');
                    arrow_qualidade.classList.remove('menu-arrow-rotate');
                }
            }
        });
    }

    var clientes_contratos = document.getElementById("clientes-contratos");
    var arrow_clientes_contratos = document.getElementById("arrow-clientes-contratos");
    var submenu_clientes_contratos = document.getElementById("sub-menu-clientes-contratos");
    if (clientes_contratos) {
        clientes_contratos.addEventListener('click', function() {
            if (!submenu_clientes_contratos.classList.contains('sub-menu-aberto')) {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_clientes_contratos.classList.add('sub-menu-aberto');
                    arrow_clientes_contratos.classList.add('menu-arrow-rotate');
                }
            } else {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_clientes_contratos.classList.remove('sub-menu-aberto');
                    arrow_clientes_contratos.classList.remove('menu-arrow-rotate');
                }
            }
        });
    }
    var ferramentas = document.getElementById("ferramentas");
    var arrow_ferramentas = document.getElementById("arrow-ferramentas");
    var submenu_ferramentas = document.getElementById("sub-menu-ferramentas");
    
    if (ferramentas) {
        ferramentas.addEventListener('click', function() {
            if (!submenu_ferramentas.classList.contains('sub-menu-aberto')) {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_ferramentas.classList.add('sub-menu-aberto');
                    arrow_ferramentas.classList.add('menu-arrow-rotate');
                }
            } else {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_ferramentas.classList.remove('sub-menu-aberto');
                    arrow_ferramentas.classList.remove('menu-arrow-rotate');
                }
            }
        });
    }

    var gestaodemidia = document.getElementById("gestaodemidia");
    var arrow_gestaodemidia = document.getElementById("arrow-gestaodemidia");
    var submenu_gestaodemidia = document.getElementById("sub-menu-gestaodemidia");
    if (gestaodemidia) {

        gestaodemidia.addEventListener('click', function() {
            if (!submenu_gestaodemidia.classList.contains('sub-menu-aberto')) {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_gestaodemidia.classList.add('sub-menu-aberto');
                    arrow_gestaodemidia.classList.add('menu-arrow-rotate');
                }
            } else {
                for (var b = 0; b < submenu.length; b++) {
                    submenu[b].classList.remove('sub-menu-aberto');
                    arrow[b].classList.remove('menu-arrow-rotate');
                    submenu_gestaodemidia.classList.remove('sub-menu-aberto');
                    arrow_gestaodemidia.classList.remove('menu-arrow-rotate');
                }
            }
        });
    }
</script>
