<li>
    <input type="checkbox" name="gestaodemidia" hidden><label for="gestaodemidia" id="gestaodemidia"><span
            id="icon-gestaodemidia"><i class="fa-solid fa-list-check"></i></span>Gestão de Mídia<i
            class="fa-solid fa-angle-down menu-arrow" id="arrow-gestaodemidia"></i></label>
    <ul class="sub-menu" id="sub-menu-gestaodemidia">
        <li><a href="/receitas-e-consumos">Receitas e Consumos</a></li>
    </ul>
</li>
<li>
    <input type="checkbox" name="administracao" hidden><label for="administracao" id="clientes-contratos"><span
            id="icon-administracao"><i class="fa-solid fa-handshake"></i></span>Clientes & Contratos<i
            class="fa-solid fa-angle-down menu-arrow" id="arrow-clientes-contratos"></i></label>
    <ul class="sub-menu" id="sub-menu-clientes-contratos">
        <li><a href="/net-contratos">NET Contratos</a></li>
        <li><a href="/clientes-ativos">Clientes ativos</a></li>
    </ul>
</li>


<script>
        var submenu = document.getElementsByClassName("sub-menu");
    var arrow = document.getElementsByClassName("menu-arrow");
    var gestaodemidia = document.getElementById("gestaodemidia");
    var arrow_gestaodemidia = document.getElementById("arrow-gestaodemidia");
    var submenu_gestaodemidia = document.getElementById("sub-menu-gestaodemidia");

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

    var clientes_contratos = document.getElementById("clientes-contratos");
    var arrow_clientes_contratos = document.getElementById("arrow-clientes-contratos");
    var submenu_clientes_contratos = document.getElementById("sub-menu-clientes-contratos");

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
</script>
