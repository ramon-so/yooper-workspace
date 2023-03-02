@extends('layouts.template-parts.estrutura')

@section('titulo', 'Yooper - E-mail Marketing Unico')
@section('pagina', 'E-mail Marketing Individual')

@section('conteudo')
<div class="main-content animate__animated animate__fadeIn animate__slow">
    <div class="container-fluid">
        @if (!empty($mensagem))
        <div class="alert alert-success" role="alert">
            {{ $mensagem }}
        </div>
        @else
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @endif
        <div class="row mb-5 mt-5">
            <div class="col-12 col-lg-8 mb-4 mb-lg-0">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Novo E-mail Marketing Individual</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <form method="post" action="{{ route('criar_funcionario') }}" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" id="nome_campanha"
                                        placeholder="Nome da Campanha" required name="nome_campanha">
                                </div>
                                <div class="form-group mt-2 col-md-5">
                                    <label class="form-control-label" for="link">URL Campanha</label>
                                    <input type="text" class="form-control" id="url" placeholder="URL Campanha" required
                                        name="link">
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <label class="form-control-label" for="previa">Prévia</label>
                                    <input type="text" class="form-control" id="previa" placeholder="Prévia" required
                                        name="previa">
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <label class="form-control-label" for="img_email">Imagem e-mail</label>
                                    <div></div>
                                    <input class="form-control-select" name="img_email" type="file" id="emailimagem"
                                        accept="image/png, image/jpeg, image/gif, image/jpg" name="imagem_email">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Gerar HTML</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">Últimos e-mails cadastrados</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <div class="table-responsive">
                            <table class="table" id="data_emails">
                                <thead>
                                    <tr>
                                        <th scope="col" class="sort"></th>
                                        <th scope="col" class="sort">Data</th>
                                        <th scope="col" class="sort">Nome Campanha</th>
                                        <th scope="col" class="sort">Cliente</th>
                                        <th scope="col" class="sort">Usuário</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($emails as $email)
                                    <tr id="email-cadastro-id-{{$email->id}}">
                                        <td><a href="/email-marketing-unico-html/{{ $email->id }}" target="_blank"><img
                                                    style="width:45px"
                                                    src="https://email-marketing.yooper.com.br/email/{{ $email->config_nome_pasta_emkt }}/email-marketing-{{ $email->numero_pasta}}/{{ $email->imagem_email }}"
                                                    alt=""></td></a>
                                        <td id="email-data">{{ date_format($email->created_at, 'd/m/y') }}</td>
                                        <td id="email-name-{{$email->nome_campanha}}"><a
                                                href="/email-marketing-unico-html/{{ $email->id }}"
                                                target="_blank">{{ $email->nome_campanha }}</a></td>
                                        <td id="email-cliente-{{$email->nome}}">{{ $email->nome}}</td>
                                        <td id="email-foto-{{$email->id}}">
                                            <div class="foto-solicitante"><img
                                                    src="https://admin.yooper.com.br/images/fotos-funcionarios/{{ $email->foto_usuario }}">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 tabela-cadastrados">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center justify-content-center justify-content-lg-start">
                            <h3 class="mt-1 mb-1 ml-2 text-center text-lg-left">URL Builder</h3>
                        </div>
                    </div>
                    <div class="card-body bg-secondary">
                        <iframe src="https://utmtagbuilder.com/" title="URL Builder" style="border:none;" width="100%"
                            height="1000"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
