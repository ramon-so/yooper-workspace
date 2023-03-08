<style> 
    .tamanho-imagem {
            width: 50px;
        }
    </style>
    @extends('layouts.template-partials.estrutura')
    
    @section('titulo', 'Yooper - Clientes Classificações')
    @section('pagina', 'Clientes Classificações')
    
    @section('conteudo')
        <div class="main-content animate__animated animate__fadeIn animate__slow">
            <div class="container-fluid">
                @include('layouts.template-partials.alerts')
                <form action="/atualizar-classificacoes">
                    @include('layouts.gestao.partials.lista-clientes-classificacoes')
                </form>
                
            </div>
        </div>    
    @endsection
    
    
    