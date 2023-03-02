<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;

use App\Cliente;
use App\CrmEmktNews;
use App\CrmEmktModelo;
use App\Services\CriarJson;
use App\Services\EnviarArquivos;
use App\Services\ListarClientes;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailMarketingNewsController extends Controller
{
    public function index(Request $request, ListarClientes $listarClientes, FuncionarioInfo $funcionarioInfo){
        
        // $emails = CrmEmktNews::select('crm_emkt_unicos.*', 'clientes.nome', 'usuarios.foto_usuario',
        // 'clientes.config_nome_pasta_emkt')
        //     ->join('clientes', 'clientes.id', '=', 'crm_emkt_unicos.cliente_id')
        //     ->join('usuarios', 'usuarios.id', '=', 'crm_emkt_unicos.usuario_id')
        //     ->orderBy('crm_emkt_unicos.id', 'desc')
        //     ->limit(20)
        //     ->get();
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $clientes = $listarClientes->listarClientes();
 
        return view('layouts.crm.email-marketing-news', compact('clientes', 'infos_func'));
    }

    static function editarClienteConfig(int $id, $pasta_numero){
        $cliente = Cliente::find($id);
        $cliente->config_numero_pasta_emkt = $pasta_numero + 1;
        $cliente->save();
    }
   




    public function store(Request $request, ListarClientes $listarClientes, EnviarArquivos $enviarArquivos, CriarJson $criarJson){
        $usuario_id = Auth::user()->id;
        $cliente_infos = Cliente::query()->select('id', 'config_numero_pasta_emkt', 'config_nome_pasta_emkt')
            ->where('id', $request->cliente_id)
            ->get();
        foreach ($cliente_infos as $cliente_info) {
            $pasta_numero = $cliente_info->config_numero_pasta_emkt;
            $pasta_nome = $cliente_info->config_nome_pasta_emkt;
        }

        $modelo = CrmEmktModelo::query()->select('qtd_banners', 'qtd_produtos')
            ->where('id', $request->modelo_id)
            ->get();
            foreach ($modelo as $m) {
                $qtd_banners = $m->qtd_banners;
                $qtd_produtos = $m->qtd_produtos;
            }

        $banners = $criarJson->criarJsonBanner($qtd_banners);
        $produtos = $criarJson->criarJsonProdutos($qtd_produtos);
        $email_news = CrmEmktNews::create([
            'cliente_id' => $request->cliente_id,
            'modelo_id' => $request->modelo_id,
            'usuario_id' => $usuario_id,
            'previa' => $request->previa,
            'numero_pasta' => $pasta_numero,
            'nome_campanha' => $request->nome_campanha,
            'utm_source' => $request->utm_source,
            'utm_medium' => $request->utm_medium,
            'utm_campaign' => $request->utm_campaign,
            'banners_json' => $banners,
            'produtos_json'=> $produtos
        ]);

        
        $enviarArquivos->criarPastaNews($pasta_nome, $pasta_numero);
        EmailMarketingNewsController::editarClienteConfig($request->cliente_id, $pasta_numero);

        $request->session()->flash(
            'mensagem',
            "E-mail cadastrado com sucesso!"
        );

        return redirect('/email-marketing-news-informacoes/'.$request->cliente_id.'/'.$pasta_nome.'/'.$email_news->id);
    }

    public function editar_email(Request $request, ListarClientes $listarClientes, FuncionarioInfo $funcionarioInfo){

        $clientes = $listarClientes->listarClientes();
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $emails = CrmEmktNews::select('crm_emkt_news.*', 'clientes.config_nome_pasta_emkt',
        'crm_emkt_modelos.qtd_banners', 'crm_emkt_modelos.qtd_produtos')
            ->where('crm_emkt_news.id', $request->id)
            ->join('clientes', 'clientes.id', '=', 'crm_emkt_news.cliente_id')
            ->join('crm_emkt_modelos', 'crm_emkt_modelos.id', '=', 'crm_emkt_news.modelo_id')
            ->limit(1)
            ->get();

        $cliente_id = $request->cliente_id;
        
        return view('layouts.crm.email-marketing-news-informacoes', compact('clientes', 'emails', 'cliente_id', 'infos_func'));
    }

    public function alterar_infos(int $id, Request $request, ListarClientes $listarClientes, EnviarArquivos $enviarArquivos){
        $email = CrmEmktNews::find($id);
        $modelo = CrmEmktModelo::find($email->modelo_id);

        $cliente_infos = Cliente::query()->select('id', 'config_numero_pasta_emkt',
            'config_nome_pasta_emkt')
            ->where('id', $request->cliente_id)
            ->get();

        foreach ($cliente_infos as $cliente_info) {
            $pasta_nome = $cliente_info->config_nome_pasta_emkt;
        }

        
        $banners = [];
        $produtos = [];

        // Array dos banner
        for($i=0; $i < $modelo->qtd_banners; $i++){

            $date = date('YmdHis');
         
            if($_FILES['banner_'.strval($i+1)]['name'] != ""){
                $extensao = explode(".",$_FILES['banner_'.strval($i+1)]['name']);
                $_FILES['banner_'.strval($i+1)]['name'] = 'banner-'.strval($i+1).'-'.$date.'.'.$extensao[1];
                $image_name = $_FILES['banner_'.strval($i+1)]['name'];
                $enviarArquivos->enviarBannerEmktNews($_FILES, $pasta_nome, $email->numero_pasta, $i+1);
            }else{
                $image_name = $request->input('arquivo_image_banner_'.strval($i+1));
            }
            
            $banner = [     
                "id" => $request->input('id_banner_'.strval($i+1)),
                "nome" => $request->input('nome_banner_'.strval($i+1)),
                "link" => $request->input('link_banner_'.strval($i+1)),
                "image" => $image_name
            ];                        
            
            array_push($banners, $banner);

        }   

        // Array dos produtos
        for($i=0; $i < $modelo->qtd_produtos; $i++){

            $date = date('YmdHis');

            if($_FILES['arquivo_'.strval($i+1)]['name'] != ""){
                $extensao = explode(".",$_FILES['arquivo_'.strval($i+1)]['name']);
                $_FILES['arquivo_'.strval($i+1)]['name'] = 'produto-'.strval($i+1).'-'.$date.'.'.$extensao[1];
                $image_name = $_FILES['arquivo_'.strval($i+1)]['name'];
                $enviarArquivos->enviarArquivoEmktNews($_FILES, $pasta_nome, $email->numero_pasta, $i+1);
            }else{
                $image_name = $request->input('arquivo_image_name_'.strval($i+1));
            }

            

            $produto = [
                "id" => $request->input('id_produto_'.strval($i+1)),
                "nome" => $request->input('nome_produto_'.strval($i+1)),
                "subtitulo" => $request->input('subtitulo_produto_'.strval($i+1)),
                "link" => $request->input('link_produto_'.strval($i+1)),
                "preco_antigo" => $request->input('preco_antigo_produto_'.strval($i+1)),
                "preco_atual" => $request->input('preco_atual_produto_'.strval($i+1)),
                "desconto" => $request->input('desconto_produto_'.strval($i+1)),
                "promocao" => $request->input('promocao_produto_'.strval($i+1)),
                "image" => $image_name


                
            ];


            array_push($produtos, $produto);

        }



        $banners = json_encode($banners);
        $produtos = json_encode($produtos);

        // Salvar dados
        // $funcionario->ativo = $request->ativo;
        $email->previa = $request->previa;
        $email->nome_campanha = $request->nome_campanha;
        $email->utm_source = $request->utm_source;
        $email->utm_medium = $request->utm_medium;
        $email->utm_campaign = $request->utm_campaign;
        $email->banners_json = $banners;
        $email->produtos_json = $produtos;
        $email->save();

        return redirect('/email-marketing-news-lista');
        
    }

    public function listar(ListarClientes $listarClientes, FuncionarioInfo $funcionarioInfo){
        $emails = CrmEmktNews::select('crm_emkt_news.*', 'clientes.nome', 'clientes.config_nome_pasta_emkt',
        'usuarios.foto_usuario',
            'clientes.config_nome_pasta_emkt')
                ->join('clientes', 'clientes.id', '=', 'crm_emkt_news.cliente_id')
                ->join('usuarios', 'usuarios.id', '=', 'crm_emkt_news.usuario_id')
                ->orderBy('crm_emkt_news.updated_at', 'desc')
                ->limit(20)
                ->get();

        $clientes = $listarClientes->listarClientes();
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        return view('layouts.crm.email-marketing-news-lista', compact('clientes', 'emails', 'infos_func'));
    }

    public function view_html(int $id, FuncionarioInfo $funcionarioInfo){

        $emails = CrmEmktNews::select('crm_emkt_news.*', 'clientes.nome',
            'clientes.config_nome_pasta_emkt','usuarios.foto_usuario', 'clientes.config_emkt_color_cta')
            ->where('crm_emkt_news.id', $id)
            ->join('clientes', 'clientes.id', '=', 'crm_emkt_news.cliente_id')
            ->join('usuarios', 'usuarios.id', '=', 'crm_emkt_news.usuario_id')
            ->orderBy('crm_emkt_news.created_at', 'desc')
            ->limit(1)
            ->get();
        $email = [];



        foreach ($emails as $e) {
            if($e->id == $id)
            array_push($email, $e);
            $cliente_id = $e->cliente_id;
        }

        $cliente_infos = Cliente::select('config_nome_pasta_emkt')
            ->where('id', $cliente_id)
            ->get();

        foreach($cliente_infos as $cliente_info){
            $pasta_nome = $cliente_info->config_nome_pasta_emkt;
            // $color_cta = $cliente_info->config_emkt_color_cta;
        }

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.crm.email-marketing.email-marketing-news-html', compact('email','pasta_nome', 'infos_func'));
    }   

}
