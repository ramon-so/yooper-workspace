@extends('layouts.template-partials.estrutura')

@section('titulo', 'Yooper | Yoo.Dash')

@section('conteudo')

<style>
        .header-bottom {
                display: none !important;
        }
</style>
        <div class="iframe-clientes">
                <iframe width="100%" height="auto"
            src="https://datastudio.google.com/embed/u/0/reporting/{{$dash_id}}"
            frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
@endsection
