<div class="d-flex justify-content-center mt-2 pt-1">
    <div>
        <button class="btn btn-warning" style="float: right; margin-right: -8.5rem;" title="EDITAR" onclick="abrir_modal_editar_cliente()"
            type="button"><i class="fa-solid fa-pen-to-square"></i></button>
        <a href="#">
            <img style="max-width: 100px" src="./../app/storage/app/app/public/clientes/cliente<?php echo $cliente->id ?>.jpeg"
                class="rounded-circle user-foto-perfil mt-4" alt="Logo não encontrada"
                onerror="this.src='./../app/storage/app/app/public/errors/imageNotFound.png'; this.onerror = null"

                >
        </a>
    </div>
</div>

<div class="card-body pt-2 pb-5">
    <div class="col">
        <div class="card-profile-stats d-flex justify-content-center mt-0">
            <div class="ferramentas-box mt-4">
                @if($cliente->whatsapp)
                <a href="{{$cliente->whatsapp}}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                    title="Whatsapp"><i class="fa-brands fa-whatsapp"></i></a>
                @endif
                @if($cliente->link_telegram)
                <a href="{{$cliente->link_telegram}}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                    title="Grupo Interno"><img src="{{ asset('assets/img/icons/telegram.png') }}"></a>
                @endif
                @if($cliente->grupo_gmail)
                <a href="https://groups.google.com/a/yooper.com.br/g/{{explode("@", $cliente->grupo_gmail)[0]}}" target="_blank"
                    data-toggle="tooltip" data-placement="bottom" ><img
                        src="{{ asset('assets/img/icons/gmail.png') }}"></a>
                @endif
                @if($cliente->yoodash_id)
                <a href="https://agencia-yooper.monday.com/" target="_blank" data-toggle="tooltip"
                    data-placement="bottom" title="Yoo.Dash"><img src="{{ asset('assets/img/icons/yoodash.png') }}"></a>
                @endif
                @if($cliente->site)
                <a href="{{$cliente->site}}" target="_blank" data-toggle="tooltip" data-placement="bottom"
                    title="Site"><img src="{{ asset('assets/img/icons/globe-solid.svg') }}"></a>
                @endif
  
            </div>
        </div>
    </div>
    <div class="h4 mt-4">
        <div class="row align-items-left justify-content-lg-start">
            <p class="text-center" style="text-transform: uppercase"><b>{{ $cliente->empresa }}</b> </p>
            <p><i class="fa-solid fa-building mr-2"></i> {{ $cliente->razaosocial }}</p>
            <p><b>CNPJ:</b> {{ $cliente->cnpj }}</p>
            <p><i class="fa-solid fa-location-pin mr-2"></i>
                <a target="blank"
                    href="https://www.google.com/maps/place/Rua Alexandre Dumas, 1658 - 14° andar - Chácara Santo Antônio - São Paulo - SP - 04717-004">
                    {{ $cliente->logradouro }}, {{ $cliente->numero }}
                    {{ $cliente->complemento ? '- ' . $cliente->complemento . ' -' : ' - ' }} {{ $cliente->bairro }} -
                    {{ $cliente->cidade }} - {{ $cliente->estado }} - CEP:
                    {{ $cliente->cep }}
            </p>
            </a>
            <h4>Contatos</h4>
            <p title="Responsável pela Empresa"><i class="fa-solid fa-building-user mr-2"></i>
                {{ $cliente->nome_responsavel }} </p>
            <p><i class="fa-solid fa-phone mr-2"></i>{{ $cliente->telefone_responsavel }}</p>
            <p title="Responsável Financeiro"><i class="fa-solid fa-hand-holding-dollar mr-2"></i>
                {{ $cliente->nome_responsavel_financeiro }}</p>
            <p><i class="fa-solid fa-phone mr-2"></i>{{ $cliente->telefone_responsavel_financeiro }}</p>

            @if ($cliente->modelo_negocio != null)
                <h4>Modelo de negócio: {{ $cliente->modelo_negocio }}</h4>
            @endif
            <h4>Informações Gerais</h4>
            @if($cliente->projetos)
                    <p>Projetos: Sim</p>
                @else
                    <p>Projetos: Não</p>
                @endif

            @if($cliente->relatorio_automatizado)
            <h4>Relatórios automatizados</h4>
                <?php $json = json_decode($cliente->relatorio_automatizado, true);?>
                @foreach($json AS $relatorio)
                <a target="_BLANK" href="{{$relatorio['link']}}"><p>{{$relatorio['nome']}}</p></a>
                @endforeach
                @endif
            <div class="ferramentas-box">

                @if ($cliente->analise_inicial != null)
                    <a href="./../app/storage/app/app/public/{{ $cliente->analise_inicial }}"
                        target="_blank" title="Análise Inicial">

                        <i class="fa-sharp fa-solid fa-magnifying-glass-chart"></i>
                    </a>
                @endif

                @if ($cliente->raio_x != null)
                    <a href="./../app/storage/app/app/public/{{ $cliente->raio_x }}"
                        target="_blank" title="Raio-X"><i class="fa-solid fa-gears"></i></a>
                @endif

                @if ($cliente->briefing != null)
                    <a href="./../app/storage/app/app/public/{{ $cliente->briefing }}"
                        target="_blank" title="Briefing geral"><i class="fa-regular fa-id-card"></i></a>
                @endif
            </div>

            @if ($cliente->plataforma != null)
                <h4>Plataforma: {{ $cliente->plataforma }}</h4>
            @endif
            


        </div>
    </div>
</div>
