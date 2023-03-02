<?php

namespace App\Http\Controllers;

use App\Captacao;
use App\Departamento;
use App\Http\Requests\CaptacaoFormRequest;
use App\Http\Requests\DepartamentoFormRequest;
use App\Http\Requests\ServicosFormRequest;
use App\Http\Requests\StatusCandidatosFormRequest;
use App\Http\Requests\StatusProcessoSeletivoFormRequest;
use App\Http\Requests\SubDepartamentosFormRequest;
use App\Services\FuncionarioInfo;
use App\Services\ListarDepartamentos;
use App\Servicos;
use App\StatusCandidatos;
use App\StatusProcessoSeletivo;
use App\SubDepartamentos;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParametrosController extends Controller
{

    //DEPARTAMENTO
    public function departamento_view(Request $request, FuncionarioInfo $funcionarioInfo){
        $departamentos = Departamento::query()
            ->orderBy('departamento')
            ->get();

        $mensagem = $request->session()->get('mensagem');

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.parametros.departamento', compact('departamentos', 'mensagem', 'infos_func'));
    }

    public function departamento_criar(DepartamentoFormRequest $request){
        $departamento = Departamento::create($request->all());

        $request->session()->
            flash(
                'mensagem', 
                "Departamento de {$departamento->departamento} cadastrado com sucesso!"
            );
        return redirect('/departamento');

    }

    public function departamento_editar(int $id, DepartamentoFormRequest $request){
        $departamento = Departamento::find($id);
        $nome = $request->departamento;
        $departamento->departamento = $nome;
        $departamento->save();

        return redirect('/departamento')->with('msg', 'Departamento editado com sucesso!');
    }

    public function ativar_inativar_depto(int $id, Request $request){
        $departamento = Departamento::find($id);
        $ativo = $request->ativo;
        $departamento->ativo = $ativo;
        $departamento->save();
    }

    //STATUS PROCESSO SELETIVO

    public function status_processo_seletivo_view(Request $request, FuncionarioInfo $funcionarioInfo){
        $status_processo_seletivos = StatusProcessoSeletivo::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()->get('mensagem');

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.parametros.status-processo-seletivo', compact('status_processo_seletivos', 'mensagem', 'infos_func'));
    }

    public function status_processo_seletivo_criar(StatusProcessoSeletivoFormRequest $request){
        $status_processo_seletivo = StatusProcessoSeletivo::create($request->all());

        $request->session()->
            flash(
                'mensagem', 
                "Status cadastrado com sucesso!"
            );
        return redirect('/status-processo-seletivo');

    }

    public function status_processo_seletivo_editar(int $id, StatusProcessoSeletivoFormRequest $request){
        $status_processo_seletivo = StatusProcessoSeletivo::find($id);
        $nome = $request->nome;
        $status_processo_seletivo->nome = $nome;
        $status_processo_seletivo->save();

        return redirect('/status-processo-seletivo')->with('msg', 'Status editado com sucesso!');
    }

    public function ativar_inativar_status_processo_seletivo(int $id, Request $request){
        $status_processo_seletivo = StatusProcessoSeletivo::find($id);
        $ativo = $request->ativo;
        $status_processo_seletivo->ativo = $ativo;
        $status_processo_seletivo->save();
    }

    //STATUS CANDIDATOS

    public function status_candidatos_view(Request $request, FuncionarioInfo $funcionarioInfo){
        $status_candidatos = StatusCandidatos::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()->get('mensagem');

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.parametros.status-candidatos', compact('status_candidatos', 'mensagem', 'infos_func'));
    }

    public function status_candidatos_criar(StatusCandidatosFormRequest $request){
        $status_candidato = StatusCandidatos::create($request->all());

        $request->session()->
            flash(
                'mensagem', 
                "Status cadastrado com sucesso!"
            );
        return redirect('/status-candidatos');

    }

    public function status_candidatos_editar(int $id, StatusCandidatosFormRequest $request){
        $status_candidato = StatusCandidatos::find($id);
        $nome = $request->nome;
        $status_candidato->nome = $nome;
        $status_candidato->save();

        return redirect('/status-candidatos')->with('msg', 'Status editado com sucesso!');
    }

    public function ativar_inativar_status_candidatos(int $id, Request $request){
        $status_candidato = StatusCandidatos::find($id);
        $ativo = $request->ativo;
        $status_candidato->ativo = $ativo;
        $status_candidato->save();
    }

    //SERVIÇOS

    public function servicos_view(Request $request, FuncionarioInfo $funcionarioInfo){
        $servicos = Servicos::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()->get('mensagem');

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.parametros.servicos', compact('servicos', 'mensagem', 'infos_func'));
    }

    public function servicos_criar(ServicosFormRequest $request){
        $servico = Servicos::create($request->all());

        $request->session()->
            flash(
                'mensagem', 
                "Serviço cadastrado com sucesso!"
            );
        return redirect('/servicos');

    }

    public function servicos_editar(int $id, ServicosFormRequest $request){
        $servico = Servicos::find($id);
        $nome = $request->nome;
        $servico->nome = $nome;
        $servico->save();

        return redirect('/servicos')->with('msg', 'Serviço editado com sucesso!');
    }

    public function ativar_inativar_servicos(int $id, Request $request){
        $servico = Servicos::find($id);
        $ativo = $request->ativo;
        $servico->ativo = $ativo;
        $servico->save();
    }

    //SUB DEPARTAMENTOS

    public function subdepartamentos_view(Request $request, FuncionarioInfo $funcionarioInfo, ListarDepartamentos $listarDepartamentos){

        $mensagem = $request->session()->get('mensagem');

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        
        $listaDp = $listarDepartamentos->listarDepartamentosAtivos();

        $subdepartamentos = SubDepartamentos::select(
            'departamentos.departamento AS departamento_nome',
            'subdepartamentos.created_at',
            'subdepartamentos.ativo',
            'subdepartamentos.nome',
            'subdepartamentos.id',
            'departamentos.id AS departamento_id',
            
        )->join('departamentos', 'departamentos.id', '=', 'subdepartamentos.departamento_id')->get();

        return view('layouts.parametros.subdepartamentos', compact('listaDp', 'subdepartamentos', 'mensagem', 'infos_func'));
    }


    public function subdepartamentos_criar(SubDepartamentosFormRequest $request){
        $subdepartamentos = SubDepartamentos::create($request->all());

        $request->session()->
            flash(
                'mensagem', 
                "Sub departamento cadastrado com sucesso!"
            );
        return redirect('/subdepartamentos');

    }

    public function subdepartamentos_editar(int $id, SubDepartamentosFormRequest $request){
        $subdepartamentos = SubDepartamentos::find($id);
        $nome = $request->nome;
        $departamento = $request->departamento_id;
        $subdepartamentos->nome = $nome;
        $subdepartamentos->departamento_id = $departamento;
        $subdepartamentos->save();

        return redirect('/subdepartamentos')->with('msg', 'Sub departamento editado com sucesso!');
    }

    public function ativar_inativar_subdepartamentos(int $id, Request $request){
        $subdepartamentos = SubDepartamentos::find($id);
        $ativo = $request->ativo;
        $subdepartamentos->ativo = $ativo;
        $subdepartamentos->save();
    }

    //CAPTACAO
    public function captacao_view(Request $request, FuncionarioInfo $funcionarioInfo){
        $captacoes = Captacao::query()
            ->orderBy('nome')
            ->get();

        $mensagem = $request->session()->get('mensagem');

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        return view('layouts.parametros.captacao', compact('captacoes', 'mensagem', 'infos_func'));
    }

    public function captacao_criar(CaptacaoFormRequest $request){
        $captacao = Captacao::create($request->all());

        $request->session()->
            flash(
                'mensagem', 
                "Fonte de captação {$captacao->nome} cadastrada com sucesso!"
            );
        return redirect('/captacao');

    }

    public function captacao_editar(int $id, CaptacaoFormRequest $request){
        $captacao = Captacao::find($id);
        $nome = $request->nome;
        $captacao->nome = $nome;
        $captacao->save();

        return redirect('/captacao')->with('msg', 'Fonte de captacão editada com sucesso!');
    }

    public function ativar_inativar_cp(int $id, Request $request){
        $captacao = Captacao::find($id);
        $ativo = $request->ativo;
        $captacao->ativo = $ativo;
        $captacao->save();
    }
}

?>
