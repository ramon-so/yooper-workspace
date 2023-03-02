@extends('layouts.template-parts.estrutura')

@section('titulo', 'Yooper - E-mail Marketing News')
@section('pagina', 'E-mail Marketing')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">
         @include('layouts.template-parts.alerts')
        <div class="row mb-5 mt-5">
            <div class="col-12 mb-4 mb-lg-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Novo E-mail Marketing</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <form method="post" action="{{ route('criar_email_news') }}" enctype="multipart/form-data">
                            @csrf
                            <h6 class="heading-small text-muted mb-4 text-center text-lg-left">Novo E-mail
                            </h6>
                            <div class="form-row">
                                <div class="form-group mt-2 col-md-3">
                                    <label class="form-control-label" for="cliente_id">Selecione o cliente</label>
                                    <select name="cliente_id" id="cliente" class="form-control-select" required>
                                        <option disabled selected value> Selecione o cliente</option>
                                        @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mt-2 col-md-3">
                                    <label class="form-control-label" for="nome_campanha">Nome da Campanha</label>
                                    <input type="text" class="form-control" id="nome_campanha" placeholder="Nome da Campanha" required name="nome_campanha">
                                </div>
                                <div class="form-group mt-2 col-md-2">
                                    <label class="form-control-label" for="utm_source">utm_source</label>
                                    <input type="text" class="form-control" id="utm_source" placeholder="utm_source" name="utm_source">
                                </div>
                                <div class="form-group mt-2 col-md-2">
                                    <label class="form-control-label" for="utm_medium">utm_medium</label>
                                    <input type="text" class="form-control" id="utm_medium" placeholder="utm_medium" name="utm_medium">
                                </div>
                                <div class="form-group mt-2 col-md-2">
                                    <label class="form-control-label" for="utm_campaign">utm_campaign</label>
                                    <input type="text" class="form-control" id="utm_campaign" placeholder="utm_campaign" name="utm_campaign">
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <label class="form-control-label" for="previa">Prévia</label>
                                    <input type="text" class="form-control" id="previa" placeholder="Prévia" required name="previa">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="thumbnail" style="border: 1px solid black; text-align: center; padding: 10px">
                                        <a href="#">
                                            <img src="http://admin.yooper.com.br/images/crm/wireframe2.png" alt="Nature" style="width:30%">
                                        </a>
                                        <div class="caption">                                                            
                                            <p>Banners: 3</p>
                                            <p>Produtos: 6</p>
                                            <input class="form-check-input" type="radio" name="modelo_id" id="gridRadios1" value="1" checked><b>Modelo 1</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="thumbnail" style="border: 1px solid black; text-align: center; padding: 10px">
                                        <img src="http://admin.yooper.com.br/images/crm/wireframe2.png" alt="Nature" style="width:30%">

                                        <div class="caption">                                                            
                                            <p>Banners: 5</p>
                                            <p>Produtos: 12</p>
                                            <input class="form-check-input" type="radio" name="modelo_id" id="gridRadios1" value="2"><b>Modelo 2</b>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="thumbnail" style="border: 1px solid black; text-align: center; padding: 10px">
                                        <a href="#">
                                            <img src="http://admin.yooper.com.br/images/crm/wireframe1.png" alt="Nature" style="width:30%">
                                        </a>
                                        <div class="caption">                                                            
                                            <p>Banners: 1</p>
                                            <p>Produtos: 0</p>
                                            <input class="form-check-input" type="radio" name="modelo_id" id="gridRadios1" value="3"><b>Modelo 3</b>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="thumbnail" style="border: 1px solid black; text-align: center; padding: 10px">
                                        <a href="#">
                                            <img src="http://admin.yooper.com.br/images/crm/wireframe1.png" alt="Nature" style="width:30%">
                                        </a>
                                        <div class="caption">                                                            
                                            <p>Banners: 1</p>
                                            <p>Produtos: 0</p>
                                            <input class="form-check-input" type="radio" name="modelo_id" id="gridRadios1" value="3"><b>Modelo 5</b>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-2">
                                    <div class="thumbnail" style="border: 1px solid black; text-align: center; padding: 10px">
                                        <a href="#">
                                            <img src="http://admin.yooper.com.br/images/crm/wireframe1.png" alt="Nature" style="width:30%">
                                        </a>
                                        <div class="caption">                                                            
                                            <p>Banners: 5</p>
                                            <p>Produtos: 12</p>
                                            <input class="form-check-input" type="radio" name="modelo_id" id="gridRadios1" value="4"><b>Modelo 4 - CTA Modificado</b>
                                        </div>
                                    </div>
                                </div> --}}

                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
