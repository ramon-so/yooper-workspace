<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use App\CandidatoParecer;
use App\Candidatos;
use App\Mail\EnviarSolicitacao;
use App\ProcessoParecer;
use App\ProcessoSeletivo;
use App\ProcessoSeletivoCandidatos;
use App\RespostaCandidato;
use App\StatusProcessoSeletivo;
use App\Services\FuncionarioInfo;
use App\Services\ListarCaptacoes;
use App\Services\ListarCargos;
use App\Services\ListarDepartamentos;
use App\Services\ListarFuncionarios;
use App\Services\ListarStatus;
use App\Services\ListarStatusCandidatos;
use App\Services\ListarStatusProcesso;
use App\Services\ListarSubDepartamentos;
use App\Solicitacao;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use stdClass;
use Symfony\Component\Console\Input\Input;

class RecrutamentoController extends Controller
{

    public function solicitacao_view(ListarSubDepartamentos $listarSubDepartamentos, ListarDepartamentos $listarDepartamentos, ListarCargos $listarCargos, ListarStatusProcesso $listarStatusProcesso, ListarFuncionarios $listarFuncionarios, Request $request, FuncionarioInfo $funcionarioInfo)
    {

        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);



        $listaDp = $listarDepartamentos->listarDepartamentos();
        $listaSdp = $listarSubDepartamentos->listarSubDepartamentos();
        $listaCg = $listarCargos->listarCargos();
        $listaPs = $listarStatusProcesso->listarStatusProcesso();
        $listaFc = $listarFuncionarios->listarUsuariosAtivos();

        if ($infos_func[0]['acesso'] == 'Head' || $infos_func[0]['acesso'] == 'RH') {
            $processos = Solicitacao::select(
                'departamentos.departamento AS departamento_nome',
                // 'rh_solicitacaos.subdepartamento_id AS subdepartamento_id',
                // 'rh_cargos.nome AS cargo_nome',
                'rh_solicitacaos.titulo',
                'rh_solicitacaos.id',
                'rh_solicitacaos.nivel_de',
                'rh_solicitacaos.nivel_para',
                // 'rh_solicitacaos.motivo',
                'rh_solicitacaos.status',
                'rh_solicitacaos.prioridade',
                'usuarios.foto_usuario AS usuario_foto',
                'usuarios.nome AS usuario_nome',
                'usuarios.id AS usuario_id',
                'rh_solicitacaos.created_at',
                'departamentos.id AS departamento_id',
                // 'rh_cargos.id AS cargo_id',

            )->join('departamentos', 'departamentos.id', '=', 'rh_solicitacaos.departamento_id')
                ->join('usuarios', 'usuarios.id', '=', 'rh_solicitacaos.user_id')
                // ->join('rh_cargos', 'rh_cargos.id', '=', 'rh_solicitacaos.cargo_id')
                ->where('usuarios.id', '=', Auth::user()->id)->get();
        } elseif ($infos_func[0]['acesso'] == 'Master' || Auth::user()->acesso == 'Master-RH') {
            $processos = Solicitacao::select(
                'departamentos.departamento AS departamento_nome',
                // 'rh_solicitacaos.subdepartamento_id AS subdepartamento_id',
                // 'rh_cargos.nome AS cargo_nome',
                'rh_solicitacaos.titulo',
                'rh_solicitacaos.id',
                'rh_solicitacaos.nivel_de',
                'rh_solicitacaos.nivel_para',
                // 'rh_solicitacaos.motivo',
                'rh_solicitacaos.status',
                'rh_solicitacaos.prioridade',
                'usuarios.foto_usuario AS usuario_foto',
                'usuarios.nome AS usuario_nome',
                'usuarios.id AS usuario_id',
                'rh_solicitacaos.created_at',
                'departamentos.id AS departamento_id',
                // 'rh_cargos.id AS cargo_id',

            )->join('departamentos', 'departamentos.id', '=', 'rh_solicitacaos.departamento_id')
                ->join('usuarios', 'usuarios.id', '=', 'rh_solicitacaos.user_id')
                // ->join('rh_cargos', 'rh_cargos.id', '=', 'rh_solicitacaos.cargo_id')
                ->get();
        }

        // if($processos[0]->subdepartamento_id) {
        //     $processos[0]->subdepartamento_id;
        // } else {
        //     'vazio';
        // }

        $avaliacoes = Avaliacao::select(
            'rh_avaliacaos.id as avaliacao_id',
            'rh_avaliacaos.nome as avaliacao_nome',
            'rh_avaliacaos.tipo as avaliacao_tipo',
            'rh_avaliacaos.departamento_id as avaliacao_departamento',
            'rh_avaliacaos.status as avaliacao_status',

        )->orderby('rh_avaliacaos.id', 'DESC')->get();

        return view('layouts.recrutamento.solicitacao', compact('listaDp', 'listaSdp', 'listaPs', 'listaFc', 'processos', 'listaCg', 'infos_func', 'avaliacoes'));
    }

    public function solicitacao_cadastrar(Request $request)
    {

        $solicitacao_create =  Solicitacao::create($request->all());

        $solicitacao = Solicitacao::select(
            'rh_solicitacaos.titulo as solicitacao_titulo',
            'rh_solicitacaos.prioridade as solicitacao_prioridade',
            'rh_solicitacaos.status as solicitacao_status',
            'departamentos.departamento as solicitacao_departamento',
            'usuarios.nome as solicitacao_solicitante',
            // 'rh_cargos.nome as solicitacao_cargo',
        )
            ->join('departamentos', 'departamentos.id', '=', 'rh_solicitacaos.departamento_id')
            //    ->join('rh_cargos', 'rh_cargos.id', '=', 'rh_solicitacaos.cargo_id')
            ->join('usuarios', 'usuarios.id', '=', 'rh_solicitacaos.user_id')
            ->where('rh_solicitacaos.id', '=', $solicitacao_create->id)->get();


        // $email = new EnviarSolicitacao($solicitacao[0]);

        // try {
        //     Mail::to('aprovacao-de-vagas@yooper.com.br')->send($email);
        // } catch (\Throwable $th) {
        //     throw $th;
        // }

        //Mail::to('aprovacao-de-vagas@yooper.com.br')->send($email);

        // mail(
        //     $to = 'aprovacao-de-vagas@yooper.com.br',
        //     'Solicitação de recrutamento',
        //     strval($email)
        // );

        return redirect('/solicitacao')->with('msg', 'Solicitação cadastrada com sucesso!');
    }

    public function solicitacao_editar(Request $request, $id)
    {
        $processoSeletivo = Solicitacao::find($id);
        $processoSeletivo->update([
            'titulo' => $request->titulo,
            'nivel_de' => $request->nivel_de,
            'nivel_para' => $request->nivel_para,
            // 'motivo' => $request->motivo,
            'prioridade' => $request->prioridade,
            'status' => $request->status,
        ]);
        return redirect('/solicitacao')->with('msg', 'Solicitação atualizada com sucesso!');
    }

    public function solicitacao_aprovar(Request $request, $id)
    {

        $avaliacoes = implode(",", $request->avaliacao);

        $processoSeletivo = ProcessoSeletivo::create([
            'titulo' => $request->titulo,
            'nivel_de' => $request->nivel_de,
            'nivel_para' => $request->nivel_para,
            'motivo' => $request->motivo,
            'departamento_id' => $request->departamento_id,
            'subdepartamento_id' => $request->subdepartamento_id,
            // 'cargo_id' => $request->cargo_id,
            'prioridade' => $request->prioridade,
            'status_id' => $request->status_id,
            'data_vencimento' => $request->data_vencimento,
            'avaliacao_tecnico_ids' => $avaliacoes,
            'user_id' => $request->user_id,
            'recrutador_funcionario_id' => $request->recrutador_funcionario_id,
        ]);

        $solicitacao = Solicitacao::find($id);
        $solicitacao->delete();

        return redirect('/solicitacao')->with('msg', 'Solicitação salva com sucesso!');
    }

    public function processo_seletivo_view(FuncionarioInfo $funcionarioInfo, Request $request, ListarStatus $listarStatus, ListarCargos $listarCargos, ListarStatusProcesso $listarStatusProcesso, ListarFuncionarios $listarFuncionarios)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $listaSt = $listarStatus->listarStatus();
        $listaCg = $listarCargos->listarCargos();
        $listaPs = $listarStatusProcesso->listarStatusProcesso();
        $listaFc = $listarFuncionarios->listarUsuariosAtivos();

        if ($infos_func[0]['acesso'] == 'Master' || Auth::user()->acesso == 'Master-RH') {
            $processosSeletivo = ProcessoSeletivo::select(
                'departamentos.id AS departamento_id',
                'departamentos.departamento AS departamento_nome',
                // 'rh_cargos.id AS cargo_id',
                // 'rh_cargos.nome AS cargo_nome',
                'usuarios.foto_usuario AS usuario_foto',
                'usuarios.nome AS usuario_nome',
                'usuarios.id AS usuario_id',
                'rh_processo_seletivos.salario_de',
                'rh_processo_seletivos.salario_ate',
                'rh_processo_seletivos.salario_slot',
                'rh_processo_seletivos.status_fechamento',
                'rh_processo_seletivos.data_fechamento',
                'rh_processo_seletivo_status.id AS status_id',
                'rh_processo_seletivo_status.nome AS status_nome',
                'rh_processo_seletivos.titulo',
                'rh_processo_seletivos.id',
                'rh_processo_seletivos.status_id AS status_processo',
                'rh_processo_seletivos.nivel_de',
                'rh_processo_seletivos.nivel_para',
                'rh_processo_seletivos.motivo',
                'rh_processo_seletivos.seguranca',
                'rh_processo_seletivos.prioridade',
                'rh_processo_seletivos.data_vencimento',
                'rh_processo_seletivos.created_at',
                'funcionarios.nome AS nome_recrutador',
                'rh_processo_seletivos.recrutador_funcionario_id',
                // 'subdepartamentos.nome AS subdepartamento_nome',
                // 'rh_processo_seletivos.subdepartamento_id AS subdepartamento_id',

            )->join('departamentos', 'departamentos.id', '=', 'rh_processo_seletivos.departamento_id')
                // ->join('subdepartamentos', 'subdepartamentos.id', '=', 'rh_processo_seletivos.subdepartamento_id')
                ->join('usuarios', 'usuarios.id', '=', 'rh_processo_seletivos.user_id')
                ->join('rh_processo_seletivo_status', 'rh_processo_seletivo_status.id', '=', 'rh_processo_seletivos.status_id')
                // ->join('rh_cargos', 'rh_cargos.id', '=', 'rh_processo_seletivos.cargo_id')
                ->join('funcionarios', 'funcionarios.id', '=', 'rh_processo_seletivos.recrutador_funcionario_id')->orderby('rh_processo_seletivos.id', 'DESC')->get();
        } elseif ($infos_func[0]['acesso'] == 'RH') {
            $processosSeletivo = ProcessoSeletivo::select(
                'departamentos.id AS departamento_id',
                'departamentos.departamento AS departamento_nome',
                // 'rh_cargos.id AS cargo_id',
                // 'rh_cargos.nome AS cargo_nome',
                'usuarios.foto_usuario AS usuario_foto',
                'usuarios.nome AS usuario_nome',
                'usuarios.id AS usuario_id',
                'rh_processo_seletivo_status.id AS status_id',
                'rh_processo_seletivo_status.nome AS status_nome',
                'rh_processo_seletivos.salario_de',
                'rh_processo_seletivos.salario_ate',
                'rh_processo_seletivos.salario_slot',
                'rh_processo_seletivos.status_fechamento',
                'rh_processo_seletivos.data_fechamento',
                'rh_processo_seletivos.titulo',
                'rh_processo_seletivos.id',
                'rh_processo_seletivos.status_id AS status_processo',
                'rh_processo_seletivos.nivel_de',
                'rh_processo_seletivos.nivel_para',
                'rh_processo_seletivos.motivo',
                'rh_processo_seletivos.seguranca',
                'rh_processo_seletivos.prioridade',
                'rh_processo_seletivos.data_vencimento',
                'rh_processo_seletivos.created_at',
                'funcionarios.nome AS nome_recrutador',
                'rh_processo_seletivos.recrutador_funcionario_id',
                // 'subdepartamentos.nome AS subdepartamento_nome',
                // 'rh_processo_seletivos.subdepartamento_id AS subdepartamento_id',
                'rh_processo_seletivos.user_id',

            )->join('departamentos', 'departamentos.id', '=', 'rh_processo_seletivos.departamento_id')
                // ->join('subdepartamentos', 'subdepartamentos.id', '=', 'rh_processo_seletivos.subdepartamento_id')
                ->join('usuarios', 'usuarios.id', '=', 'rh_processo_seletivos.user_id')
                ->join('rh_processo_seletivo_status', 'rh_processo_seletivo_status.id', '=', 'rh_processo_seletivos.status_id')
                // ->join('rh_cargos', 'rh_cargos.id', '=', 'rh_processo_seletivos.cargo_id')
                ->join('funcionarios', 'funcionarios.id', '=', 'rh_processo_seletivos.recrutador_funcionario_id')->orderby('rh_processo_seletivos.id', 'DESC')->where('rh_processo_seletivos.recrutador_funcionario_id', '=', Auth::user()->funcionario_id)->get();
        } elseif ($infos_func[0]['acesso'] == 'Head') {
            $processosSeletivo = ProcessoSeletivo::select(
                'departamentos.id AS departamento_id',
                'departamentos.departamento AS departamento_nome',
                // 'rh_cargos.id AS cargo_id',
                // 'rh_cargos.nome AS cargo_nome',
                'usuarios.foto_usuario AS usuario_foto',
                'usuarios.nome AS usuario_nome',
                'usuarios.id AS usuario_id',
                'rh_processo_seletivo_status.id AS status_id',
                'rh_processo_seletivo_status.nome AS status_nome',
                'rh_processo_seletivos.titulo',
                'rh_processo_seletivos.id',
                'rh_processo_seletivos.status_id AS status_processo',
                'rh_processo_seletivos.nivel_de',
                'rh_processo_seletivos.nivel_para',
                'rh_processo_seletivos.motivo',
                'rh_processo_seletivos.seguranca',
                'rh_processo_seletivos.prioridade',
                'rh_processo_seletivos.data_vencimento',
                'rh_processo_seletivos.created_at',
                'funcionarios.nome AS nome_recrutador',
                'rh_processo_seletivos.recrutador_funcionario_id',
                // 'subdepartamentos.nome AS subdepartamento_nome',
                // 'rh_processo_seletivos.subdepartamento_id AS subdepartamento_id',
                'rh_processo_seletivos.user_id',

            )->join('departamentos', 'departamentos.id', '=', 'rh_processo_seletivos.departamento_id')
                // ->join('subdepartamentos', 'subdepartamentos.id', '=', 'rh_processo_seletivos.subdepartamento_id')
                ->join('usuarios', 'usuarios.id', '=', 'rh_processo_seletivos.user_id')
                ->join('rh_processo_seletivo_status', 'rh_processo_seletivo_status.id', '=', 'rh_processo_seletivos.status_id')
                // ->join('rh_cargos', 'rh_cargos.id', '=', 'rh_processo_seletivos.cargo_id')
                ->join('funcionarios', 'funcionarios.id', '=', 'rh_processo_seletivos.recrutador_funcionario_id')->orderby('rh_processo_seletivos.id', 'DESC')->where('rh_processo_seletivos.user_id', '=', Auth::user()->id)->get();
        }

        $recrutadores = ProcessoSeletivo::select(
            'usuarios.foto_usuario AS recrutador_foto',
            'usuarios.id AS usuario_id',
            'usuarios.funcionario_id as recrutador_id',
            'usuarios.nome as recrutador_nome'

        )->join('usuarios', 'usuarios.funcionario_id', '=', 'rh_processo_seletivos.recrutador_funcionario_id')->groupby('recrutador_foto', 'recrutador_id', 'usuario_id', 'recrutador_nome')->orderby('recrutador_id', 'ASC')->get();

        return view('layouts.recrutamento.processo-seletivo', compact('infos_func', 'listaCg', 'listaPs', 'listaFc', 'recrutadores', 'processosSeletivo', 'listaSt'));
    }

    public function processo_seletivo_editar(Request $request, $id)
    {
        $processoSeletivo = ProcessoSeletivo::find($id);
        $processoSeletivo->update([
            'titulo' => $request->titulo,
            'departamento_id' => $request->departamento_id,
            // 'cargo_id' => $request->cargo_id,
            'nivel_de' => $request->nivel_de,
            'nivel_para' => $request->nivel_para,
            'motivo' => $request->motivo,
            'prioridade' => $request->prioridade,
            'user_id' => $request->user_id,
            'data_vencimento' => $request->data_vencimento,
            'avaliacao_tecnico_ids' => $request->avaliacao_tecnico_ids,
            'recrutador_funcionario_id' => $request->recrutador_funcionario_id,
        ]);
        return redirect('/processo-seletivo')->with('msg', 'Processo atualizado com sucesso!');
    }

    public function candidatos_view(FuncionarioInfo $funcionarioInfo, Request $request, $id, ListarStatusCandidatos $listarStatusCandidatos, ListarCaptacoes $listarCaptacoes)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $processoSeletivo = ProcessoSeletivo::find($id);

        $listaStc = $listarStatusCandidatos->listarStatusCandidatos();
        $listaCp = $listarCaptacoes->listarCaptacoes();

        $processosSeletivo = ProcessoSeletivo::select(
            'departamentos.id AS departamento_id',
            'departamentos.departamento AS departamento_nome',
            // 'rh_cargos.id AS cargo_id',
            // 'rh_cargos.nome AS cargo_nome',
            'usuarios.foto_usuario AS usuario_foto',
            'usuarios.nome AS usuario_nome',
            'usuarios.id AS usuario_id',
            'rh_processo_seletivo_status.id AS status_id',
            'rh_processo_seletivo_status.nome AS status_nome',
            'rh_processo_seletivos.titulo as processo_titulo',
            'rh_processo_seletivos.id as processo_id',
            'rh_processo_seletivos.status_id AS status_processo',
            'rh_processo_seletivos.salario_de',
            'rh_processo_seletivos.salario_ate',
            'rh_processo_seletivos.salario_slot',
            'rh_processo_seletivos.status_fechamento',
            'rh_processo_seletivos.data_fechamento',
            'rh_processo_seletivos.nivel_de',
            'rh_processo_seletivos.nivel_para',
            'rh_processo_seletivos.motivo',
            'rh_processo_seletivos.seguranca',
            'rh_processo_seletivos.prioridade',
            'rh_processo_seletivos.data_vencimento',
            'rh_processo_seletivos.created_at',
            'funcionarios.nome AS nome_recrutador',
            'rh_processo_seletivos.recrutador_funcionario_id',
            'rh_processo_seletivos.avaliacao_tecnico_ids as avaliacao_tecnico_ids',
            // 'subdepartamentos.nome AS subdepartamento_nome',
            // 'rh_processo_seletivos.subdepartamento_id AS subdepartamento_id',

        )->join('departamentos', 'departamentos.id', '=', 'rh_processo_seletivos.departamento_id')
            // ->join('subdepartamentos', 'subdepartamentos.id', '=', 'rh_processo_seletivos.subdepartamento_id')
            ->join('usuarios', 'usuarios.id', '=', 'rh_processo_seletivos.user_id')
            ->join('rh_processo_seletivo_status', 'rh_processo_seletivo_status.id', '=', 'rh_processo_seletivos.status_id')
            // ->join('rh_cargos', 'rh_cargos.id', '=', 'rh_processo_seletivos.cargo_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'rh_processo_seletivos.recrutador_funcionario_id')->where('rh_processo_seletivos.id', '=', $id)->orderby('rh_processo_seletivos.id', 'DESC')->get();


        $avaliacoes_ids = explode(',', $processosSeletivo[0]->avaliacao_tecnico_ids);

        $avaliacoes = array();
        for ($i = 0; $i < count($avaliacoes_ids); $i++) {
            $avaliacao = Avaliacao::select(
                'rh_avaliacaos.nome as nome',
                'rh_avaliacaos.tipo'

            )->where('rh_avaliacaos.id', "=", $avaliacoes_ids[$i])
                ->orderby('rh_avaliacaos.id', 'DESC')->get();

            array_push($avaliacoes, $avaliacao);
        }

        $processoCandidatos = ProcessoSeletivoCandidatos::select(
            'usuarios.foto_usuario AS usuario_foto',
            'usuarios.nome AS usuario_nome',
            'usuarios.id AS usuario_id',
            'rh_candidato.id as candidato_id',
            'rh_candidato.nome as candidato_nome',
            'rh_candidato.email as candidato_email',
            'rh_candidato.telefone as candidato_telefone',
            'rh_candidato.linkedin_link as candidato_linkedin',
            'rh_candidato.curriculo_anexo as candidato_curriculo',
            'rh_processo_seletivo_candidatos.id',
            'rh_processo_seletivos.titulo as processo_nome',
            'rh_processo_seletivos.id as processo_id',
            'rh_processo_seletivo_candidatos.status_id as status_id',
            'rh_candidatos_status.nome AS status_nome',
            'rh_candidato.curriculo_anexo AS curriculo',
            'rh_fonte_captacaos.nome as captacao_nome',
            'rh_fonte_captacaos.id as captacao_id',
            'rh_candidato.captacao_id',

        )->join('usuarios', 'usuarios.id', '=', 'rh_processo_seletivo_candidatos.user_id')
            ->join('rh_candidatos_status', 'rh_candidatos_status.id', '=', 'rh_processo_seletivo_candidatos.status_id')
            ->join('rh_candidato', 'rh_candidato.id', '=', 'rh_processo_seletivo_candidatos.candidato_id')
            ->join('rh_fonte_captacaos', 'rh_fonte_captacaos.id', '=', 'rh_candidato.captacao_id')
            ->join('rh_processo_seletivos', 'rh_processo_seletivos.id', '=', 'rh_processo_seletivo_candidatos.processo_seletivo_id')->orderby('rh_processo_seletivo_candidatos.id', 'DESC')->get();


        $candidatos_loop = Candidatos::select(
            'usuarios.foto_usuario AS usuario_foto',
            'usuarios.nome AS usuario_nome',
            'usuarios.id AS usuario_id',
            'rh_candidato.id as candidato_id',
            'rh_candidato.nome as candidato_nome',
            'rh_candidato.email as candidato_email',
            'rh_candidato.telefone as candidato_telefone',
            'rh_candidato.linkedin_link as candidato_linkedin',
            'rh_candidato.curriculo_anexo as curriculo',
            'rh_fonte_captacaos.id as captacao_id',
            'rh_fonte_captacaos.nome as captacao_nome',

        )->join('usuarios', 'usuarios.id', '=', 'rh_candidato.user_id')
            ->join('rh_fonte_captacaos', 'rh_fonte_captacaos.id', '=', 'rh_candidato.captacao_id')
            ->orderby('rh_candidato.id', 'DESC')->get();

        $processoParecers = ProcessoParecer::select(
            'usuarios.foto_usuario AS usuario_foto',
            'usuarios.nome AS usuario_nome',
            'usuarios.id AS usuario_id',
            'rh_processo_seletivos.id AS parecer_processo_id',
            'rh_processo_seletivos.titulo AS parecer_processo_titulo',
            'rh_processo_parecers.id',
            'rh_processo_parecers.processo_id',
            'rh_processo_parecers.parecer as processo_parecer',
            'rh_processo_parecers.created_at',


        )->join('usuarios', 'usuarios.id', '=', 'rh_processo_parecers.user_id')
            ->join('rh_processo_seletivos', 'rh_processo_seletivos.id', '=', 'rh_processo_parecers.processo_id')
            ->orderby('rh_processo_parecers.id', 'DESC')->where('rh_processo_parecers.processo_id', '=', $id)->get();


        return view('layouts.recrutamento.candidatos', compact('infos_func', 'processosSeletivo', 'processoCandidatos', 'listaStc', 'candidatos_loop', 'processoParecers', 'avaliacoes', 'listaCp'));
    }

    public function candidatos_criar(Request $request, $id)
    {
        $candidato = Candidatos::select('*')->where('email', '=', $request->email)->get();
        $processoSeletivo = ProcessoSeletivo::find($id);


        if (count($candidato) > 0) {
            return redirect("/processo-seletivo/$id")->with('msgf', 'Candidato já está cadastrado na base de dados!');
        } else {

            if (empty($_FILES['curriculo_anexo']['name'])) {
                $candidatos = Candidatos::create([  
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'linkedin_link' => $request->linkedin_link,
                    'curriculo_anexo' => '',
                    'user_id' => $request->user_id,
                    'captacao_id' => $request->captacao_id,
                ]);

                $avaliacoes_ids = explode(',', $processoSeletivo->avaliacao_tecnico_ids);

                $vincularCandidato = ProcessoSeletivoCandidatos::create([
                    'candidato_id' => $candidatos->id,
                    'processo_seletivo_id' => $id,
                    'user_id' => Auth::user()->id,
                    'status_id' => 1,
                ]);


                for ($i = 0; $i < count($avaliacoes_ids); $i++) {
                    $avaliacao = RespostaCandidato::create([
                        'avaliacao_id' =>  $avaliacoes_ids[$i],
                        'candidato_id' => $candidatos->id,
                        'processo_id' =>  $id,
                    ]);
                }

            } else {

                $candidatos = Candidatos::create([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'linkedin_link' => $request->linkedin_link,
                    'curriculo_anexo' => '',
                    'user_id' => $request->user_id,
                    'captacao_id' => $request->captacao_id,
                ]);

                $curriculo = Candidatos::find($candidatos->id);
                $curriculo->update([
                    'curriculo_anexo' => $request->curriculo_anexo->storeAs('candidato', "candidato" . $candidatos->id . ".pdf"),
                ]);


                $avaliacoes_ids = explode(',', $processoSeletivo->avaliacao_tecnico_ids);

                $vincularCandidato = ProcessoSeletivoCandidatos::create([
                    'candidato_id' => $candidatos->id,
                    'processo_seletivo_id' => $id,
                    'user_id' => Auth::user()->id,
                    'status_id' => 1,
                ]);


                for ($i = 0; $i < count($avaliacoes_ids); $i++) {
                    $avaliacao = RespostaCandidato::create([
                        'avaliacao_id' =>  $avaliacoes_ids[$i],
                        'candidato_id' => $candidatos->id,
                        'processo_id' =>  $id,
                    ]);
                }
            }
            return redirect("/processo-seletivo/$id")->with('msg', 'Candidato cadastrado com sucesso!');
        }
    }

    public function candidatos_editar(Request $request, int $processo_id, int $id)
    {

        $candidato = Candidatos::find($id);

        if (empty($_FILES['curriculo_anexo']['name'])) {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'user_id' => $request->user_id,
                'captacao_id' => $request->captacao_id,
            ]);
        } else {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'curriculo_anexo' => $request->curriculo_anexo->storeAs('candidato', "candidato" . $id . ".pdf"),
                'user_id' => $request->user_id,
                'captacao_id' => $request->captacao_id,
            ]);
        }

        return redirect("/processo-seletivo/$processo_id")->with('msg', 'Candidato atualizado com sucesso!');
    }

    public function candidatos_aprovar(Request $request, int $processo_id, int $id)
    {

        $processoSeletivoCandidato = ProcessoSeletivoCandidatos::select(
            'id'
        )->where('candidato_id', '=', $id)->where('processo_seletivo_id', '=', $processo_id)->get();

        $processoSeletivoCandidato = ProcessoSeletivoCandidatos::find($processoSeletivoCandidato[0]->id);

        $processoSeletivoCandidato->update([
            'status_id' => $request->status_id,
        ]);

        $candidatoParecer = CandidatoParecer::create([
            'candidato_id' => $request->candidato_id,
            'parecer' => $request->parecer,
            'user_id' => $request->user_id,
            'processo_id' => $request->processo_id,
        ]);

        return redirect("/processo-seletivo/$processo_id")->with('msg', 'Candidato atualizado com sucesso!');
    }

    public function vincular_candidato(Request $request, int $processo_id)
    {


        $candidato = Candidatos::select(
            'id'
        )->where('email', '=', $request->email)->get();

        if (count($candidato) > 0) {
            $processoSeletivoCandidato = ProcessoSeletivoCandidatos::select(
                'id'
            )->where('candidato_id', '=', $candidato[0]->id)->where('processo_seletivo_id', '=', $processo_id)->get();

            if (count($processoSeletivoCandidato) > 0) {
                return redirect("/processo-seletivo/$processo_id")->with('msgf', 'Candidato já está vinculado com o processo!');
            } else {

                $processo = ProcessoSeletivo::find($processo_id);

                $avaliacoes_ids = explode(',', $processo->avaliacao_tecnico_ids);

                $vincularCandidato = ProcessoSeletivoCandidatos::create([
                    'candidato_id' => $candidato[0]->id,
                    'processo_seletivo_id' => $processo_id,
                    'user_id' => Auth::user()->id,
                    'status_id' => 1,
                ]);


                for ($i = 0; $i < count($avaliacoes_ids); $i++) {
                    $avaliacao = RespostaCandidato::create([
                        'avaliacao_id' =>  $avaliacoes_ids[$i],
                        'candidato_id' => $candidato[0]->id,
                        'processo_id' =>  $processo_id,
                    ]);
                }

                return redirect("/processo-seletivo/$processo_id")->with('msg', 'Candidato vinculado com sucesso!');
            }
        } else {
            return redirect("/processo-seletivo/$processo_id")->with('msgf', 'Candidato precisa ser cadastrado!');
        }
    }

    public function perfil_candidato(ListarStatusProcesso $listarStatusProcesso, ListarCaptacoes $listarCaptacoes, FuncionarioInfo $funcionarioInfo, int $processo_id, int $id)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        // Busca o candidato
        $candidatos = Candidatos::find($id);

        // Lista o status do processo seletivo
        $listaPs = $listarStatusProcesso->listarStatusProcesso();
        $listaCp = $listarCaptacoes->listarCaptacoes();


        $processosSeletivo = ProcessoSeletivo::select(
            'rh_processo_seletivos.titulo as processo_titulo',
            'rh_processo_seletivos.id as processo_id',

        )->where('rh_processo_seletivos.id', '=', $processo_id)->orderby('rh_processo_seletivos.id', 'DESC')->get();

        $candidatos = Candidatos::select(
            'rh_candidato.id as candidato_id',
            'rh_candidato.nome as candidato_nome',
            'rh_candidato.email as candidato_email',
            'rh_candidato.telefone as candidato_telefone',
            'rh_candidato.linkedin_link as candidato_linkedin',
            'rh_candidato.curriculo_anexo as curriculo',
            'rh_candidato.user_id',
            'rh_candidato.created_at',
            'usuarios.nome as solicitante',
            'rh_fonte_captacaos.nome as captacao_nome',
            'rh_fonte_captacaos.id as captacao_id',

        )->join('usuarios', 'usuarios.id', '=', 'rh_candidato.user_id')
            ->join('rh_fonte_captacaos', 'rh_fonte_captacaos.id', '=', 'rh_candidato.captacao_id')
            ->where('rh_candidato.id', '=', $id)->get();

        $candidatoParecers = CandidatoParecer::select(
            'usuarios.foto_usuario AS usuario_foto',
            'usuarios.nome AS usuario_nome',
            'usuarios.id AS usuario_id',
            'rh_candidato.id AS parecer_candidato_id',
            'rh_candidato.nome AS parecer_candidato_nome',
            'rh_processo_candidato_parecers.id',
            'rh_processo_candidato_parecers.candidato_id',
            'rh_processo_candidato_parecers.parecer as candidato_parecer',
            'rh_processo_candidato_parecers.created_at',
            'rh_processo_seletivos.id AS parecer_processo_id',
            'rh_processo_seletivos.titulo AS parecer_processo_titulo',
        )->join('usuarios', 'usuarios.id', '=', 'rh_processo_candidato_parecers.user_id')
            ->join('rh_candidato', 'rh_candidato.id', '=', 'rh_processo_candidato_parecers.candidato_id')
            ->join('rh_processo_seletivos', 'rh_processo_seletivos.id', '=', 'rh_processo_candidato_parecers.processo_id')
            ->orderby('rh_processo_candidato_parecers.id', 'DESC')->where('rh_processo_candidato_parecers.candidato_id', '=', $id)->where('rh_processo_candidato_parecers.processo_id', '=', $processo_id)->get();

        $respostas = RespostaCandidato::select(
            'rh_candidato.id as candidato_id',
            'rh_avaliacaos.nome as avaliacao_nome',
            'rh_avaliacaos.json_avaliacao as array_avaliacoes',
            'rh_resposta_candidatos.respostas as respostas_avaliacoes',
            'rh_resposta_candidatos.avaliacao_id as avaliacao_id',
            'rh_resposta_candidatos.id as resposta_id',
            'rh_resposta_candidatos.avaliacao_head as avaliacao_head',
            'rh_resposta_candidatos.avaliacao_gyg as avaliacao_gyg',
            'rh_resposta_candidatos.observacao_head as observacao_head',
            'rh_resposta_candidatos.observacao_gyg as observacao_gyg',


        )->join('rh_candidato', 'rh_candidato.id', '=', 'rh_resposta_candidatos.candidato_id')
            ->join('rh_avaliacaos', 'rh_avaliacaos.id', '=', 'rh_resposta_candidatos.avaliacao_id')
            ->join('rh_processo_seletivos', 'rh_processo_seletivos.id', '=', 'rh_resposta_candidatos.processo_id')
            ->where('rh_resposta_candidatos.candidato_id', '=', $id)
            ->where('rh_resposta_candidatos.processo_id', '=', $processo_id)->get();

        $respostas_array = array();

        for ($i = 0; $i < count($respostas); $i++) {
            $resposta = array();
            $respostas[$i]->avaliacao_head != null ? $respostas[$i]['head'] = $respostas[$i]->avaliacao_head : $respostas[$i]['head'] = null;
            $respostas[$i]->observacao_head != null ? $respostas[$i]['head_parecer'] = $respostas[$i]->observacao_head : $respostas[$i]['head_parecer'] = null;
            $respostas[$i]->avaliacao_gyg != null ? $respostas[$i]['gyg'] = $respostas[$i]->avaliacao_gyg : $respostas[$i]['gyg'] = null;
            $respostas[$i]->observacao_gyg != null ? $respostas[$i]['gyg_parecer'] = $respostas[$i]->observacao_gyg : $respostas[$i]['gyg_parecer'] = null;
            $resposta = [
                'avaliacao_nome' => $respostas[$i]->avaliacao_nome,
                'questoes' => json_decode($respostas[$i]->array_avaliacoes),
                'respostas' => json_decode($respostas[$i]->respostas_avaliacoes)
            ];
            array_push($respostas_array, $resposta);
        }

        // dd($respostas_array);

        // var_dump(count($respostas));
        // exit();

        return view('layouts.recrutamento.processo-seletivo-candidato', compact('infos_func', 'candidatos', 'listaPs', 'candidatoParecers', 'processosSeletivo', 'listaCp', 'respostas', 'respostas_array'));
    }

    public function avaliar_head(Request $request, int $processo_id, int $candidato_id, int $resposta_id)
    {

        $respostas = RespostaCandidato::find($resposta_id);

        $avaliacoes = implode(",", $request->avaliacao);
        $respostas->update([
            'avaliacao_head' => $avaliacoes,
            'observacao_head' => $request->observacao_head,
        ]);

        return redirect("/processo-seletivo/$processo_id/candidato/$candidato_id")->with('msg', 'Teste avaliado pelo Head com sucesso.');
    }

    public function avaliar_gyg(Request $request, int $processo_id, int $candidato_id, int $resposta_id)
    {

        $respostas = RespostaCandidato::find($resposta_id);

        $avaliacoes = implode(",", $request->avaliacao);

        $respostas->update([
            'avaliacao_gyg' => $avaliacoes,
            'observacao_gyg' => $request->observacao_gyg,
        ]);

        return redirect("/processo-seletivo/$processo_id/candidato/$candidato_id")->with('msg', 'Teste avaliado por Gente Y Gestão com sucesso.');
    }

    public function candidato_view(ListarStatusProcesso $listarStatusProcesso, ListarCaptacoes $listarCaptacoes, FuncionarioInfo $funcionarioInfo, int $id)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);
        $candidatos = Candidatos::find($id);

        $listaPs = $listarStatusProcesso->listarStatusProcesso();
        $listaCp = $listarCaptacoes->listarCaptacoes();


        $processoSeletivoCandidatos = ProcessoSeletivoCandidatos::select(
            'rh_processo_seletivo_candidatos.candidato_id',
            'rh_processo_seletivos.id as processo_id',
            'rh_processo_seletivos.titulo as processo_nome',
            'rh_candidato.nome as candidato_nome',
            'rh_candidatos_status.nome as status_nome',

        )->join('rh_candidato', 'rh_candidato.id', '=', 'rh_processo_seletivo_candidatos.candidato_id')
            ->join('rh_candidatos_status', 'rh_candidatos_status.id', '=', 'rh_processo_seletivo_candidatos.status_id')
            ->join('rh_processo_seletivos', 'rh_processo_seletivos.id', '=', 'rh_processo_seletivo_candidatos.processo_seletivo_id')
            ->where('rh_processo_seletivo_candidatos.candidato_id', '=', $id)->orderby('rh_processo_seletivo_candidatos.id', 'DESC')->get();

        $candidatos = Candidatos::select(
            'rh_candidato.id as candidato_id',
            'rh_candidato.nome as candidato_nome',
            'rh_candidato.email as candidato_email',
            'rh_candidato.telefone as candidato_telefone',
            'rh_candidato.linkedin_link as candidato_linkedin',
            'rh_candidato.curriculo_anexo as curriculo',
            'rh_candidato.user_id',
            'rh_candidato.created_at',
            'usuarios.nome as solicitante',
            'rh_fonte_captacaos.id as captacao_id',
            'rh_fonte_captacaos.nome as captacao_nome',

        )->join('usuarios', 'usuarios.id', '=', 'rh_candidato.user_id')
            ->join('rh_fonte_captacaos', 'rh_fonte_captacaos.id', '=', 'rh_candidato.captacao_id')
            ->where('rh_candidato.id', '=', $id)->get();

        return view('layouts.recrutamento.candidato', compact('infos_func', 'candidatos', 'listaPs', 'processoSeletivoCandidatos', 'listaCp'));
    }

    public function processo_candidato_editar(Request $request, int $processo_id, int $id)
    {

        $candidato = Candidatos::find($id);

        if (empty($_FILES['curriculo_anexo']['name'])) {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'user_id' => $request->user_id,
                'captacao_id' => $request->captacao_id,
            ]);
        } else {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'curriculo_anexo' => $request->curriculo_anexo->storeAs('candidato', "candidato" . $id . ".pdf"),
                'user_id' => $request->user_id,
                'captacao_id' => $request->captacao_id,
            ]);
        }

        return redirect("/processo-seletivo/$processo_id/candidato/$id")->with('msg', 'Candidato atualizado com sucesso!');
    }

    public function candidato_editar(Request $request, int $id)
    {

        $candidato = Candidatos::find($id);

        if (empty($_FILES['curriculo_anexo']['name'])) {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'user_id' => $request->user_id,
                'captacao_id' => $request->captacao_id,
            ]);
        } else {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'curriculo_anexo' => $request->curriculo_anexo->storeAs('candidato', "candidato" . $id . ".pdf"),
                'user_id' => $request->user_id,
                'captacao_id' => $request->captacao_id,
            ]);
        }

        return redirect("/candidato/$id")->with('msg', 'Candidato atualizado com sucesso!');
    }

    public function banco_de_candidatos_view(FuncionarioInfo $funcionarioInfo, ListarCaptacoes $listarCaptacoes)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $listaCp = $listarCaptacoes->listarCaptacoes();

        $candidatos = Candidatos::select(
            'usuarios.foto_usuario AS usuario_foto',
            'usuarios.nome AS usuario_nome',
            'usuarios.id AS usuario_id',
            'rh_candidato.id as candidato_id',
            'rh_candidato.nome as candidato_nome',
            'rh_candidato.email as candidato_email',
            'rh_candidato.telefone as candidato_telefone',
            'rh_candidato.linkedin_link as candidato_linkedin',
            'rh_candidato.curriculo_anexo as curriculo',
            'rh_candidato.created_at',
            'rh_fonte_captacaos.id as captacao_id',
            'rh_fonte_captacaos.nome as captacao_nome',

        )->join('usuarios', 'usuarios.id', '=', 'rh_candidato.user_id')
            ->join('rh_fonte_captacaos', 'rh_fonte_captacaos.id', '=', 'rh_candidato.captacao_id')
            ->orderby('rh_candidato.id', 'DESC')->get();

        return view('layouts.recrutamento.banco-de-candidatos', compact('infos_func', 'candidatos', 'listaCp'));
    }

    public function banco_candidatos_editar(Request $request, int $id)
    {

        $candidato = Candidatos::find($id);

        if (empty($_FILES['curriculo_anexo']['name'])) {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'captacao_id' => $request->captacao_id,
            ]);
        } else {
            $candidato->update([
                'nome' => $request->nome,
                'email' => $request->email,
                'telefone' => $request->telefone,
                'linkedin_link' => $request->linkedin_link,
                'curriculo_anexo' => $request->curriculo_anexo->storeAs('candidato', "candidato" . $id . ".pdf"),
                'captacao_id' => $request->captacao_id,
            ]);
        }

        return redirect("/banco-de-candidatos")->with('msg', 'Candidato atualizado com sucesso!');
    }

    public function banco_candidatos_cadastrar(Request $request)
    {
        $candidato = Candidatos::select('*')->where('email', '=', $request->email)->get();


        if (count($candidato) > 0) {
            return redirect("/banco-de-candidatos")->with('msgf', 'Candidato já está cadastrado na base de dados!');
        } else {

            if (empty($_FILES['curriculo_anexo']['name'])) {

                $candidatos = Candidatos::create([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'linkedin_link' => $request->linkedin_link,
                    'curriculo_anexo' => '',
                    'user_id' => $request->user_id,
                    'captacao_id' => $request->captacao_id,
                ]);

                $processoCadidatos = ProcessoSeletivoCandidatos::create([
                    'candidato_id' => $candidatos->id,
                    'processo_seletivo_id' => $request->processo_seletivo_id,
                    'user_id' => $request->user_id,
                    'status_id' => $request->status_id,
                ]);
            } else {
                $candidatos = Candidatos::create([
                    'nome' => $request->nome,
                    'email' => $request->email,
                    'telefone' => $request->telefone,
                    'linkedin_link' => $request->linkedin_link,
                    'curriculo_anexo' => '',
                    'user_id' => $request->user_id,
                    'captacao_id' => $request->captacao_id,
                ]);

                $curriculo = Candidatos::find($candidatos->id);
                $curriculo->update([
                    'curriculo_anexo' => $request->curriculo_anexo->storeAs('candidato', "candidato" . $candidatos->id . ".pdf"),
                ]);
            }
            return redirect("/banco-de-candidatos")->with('msg', 'Candidato cadastrado com sucesso!');
        }
    }

    public function cadastro_avaliacao_view(ListarDepartamentos $listarDepartamentos, FuncionarioInfo $funcionarioInfo, Request $request)
    {
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $listaDp = $listarDepartamentos->listarDepartamentos();

        $avaliacoes = Avaliacao::select(
            'rh_avaliacaos.id',
            'rh_avaliacaos.nome as nome_avaliacao',
            'rh_avaliacaos.tipo as tipo_avaliacao',
            'rh_avaliacaos.status as status',
            'rh_avaliacaos.qtd_dissertativa as qtd_dissertativa',
            'rh_avaliacaos.qtd_alternativa as qtd_alternativa',
            'rh_avaliacaos.created_at',
            'rh_avaliacaos.departamento_id',
            'departamentos.departamento as departamento',

        )->join('departamentos', 'departamentos.id', '=', 'rh_avaliacaos.departamento_id')
            ->orderby('rh_avaliacaos.id', 'DESC')->get();


        return view('layouts.recrutamento.cadastro-de-avaliacao', compact('infos_func', 'listaDp', 'avaliacoes'));
    }

    public function cadastrar_avaliacao(Request $request)
    {

        $nome = $request->nome;
        $tipo = $request->tipo;
        $qtd_dissertativa = $request->qtd_dissertativa;
        $qtd_alternativa = $request->qtd_alternativa;
        $filesAlternativa = $request->file('alternativaFile');
        $imgsAlternativas = "";
        foreach ($filesAlternativa as $arquivoAlternativa) {
            if ($arquivoAlternativa != null) {
                $path = $arquivoAlternativa->storeAs(
                    'imgQuestoes',
                    'questao' . $arquivoAlternativa->getClientOriginalName(),
                    ['disk' => 'public']
                );
                $imgsAlternativas .= $path . ";";
            }
        }
        $filesDissertativa = $request->file('dissertativaFile');
        $imgsDissertativas = "";
        foreach ($filesAlternativa as $arquivoAlternativa) {
            if ($arquivoAlternativa != null) {
                $path = $filesDissertativa->storeAs(
                    'imgQuestoes',
                    'questao' . $arquivoAlternativa->getClientOriginalName(),
                    ['disk' => 'public']
                );
                $imgsDissertativas .= $path . ";";
            }
        }
        $questaoDissertativa = $request->dissertativa;
        $questaoAlternativa = $request->questao_alternativa;
        $alternativas = array();

        if ($questaoAlternativa) {
            for ($i = 0; $i < count($questaoAlternativa); $i++) {
                $alternativa = array();
                $alternativa = [
                    'questao' => $questaoAlternativa[$i],
                    'alternativa' => $request->alternativa[$i],
                    'alternativa_correta' => $request->alternativa_correta[$i],
                ];
                array_push($alternativas, $alternativa);
            }
        }

        $questoes_array = [
            'respostas_dissertativas' => $questaoDissertativa,
            'alternativas' => $alternativas,
            'imgsAlternativas' => $imgsAlternativas,
            'imgsDissertativas' => $imgsDissertativas,
        ];


        $questoes = json_encode($questoes_array);

        $avaliacao = Avaliacao::create([
            'nome' => $request->nome,
            'tipo' => $request->tipo,
            'departamento_id' => $request->departamento_id,
            'qtd_dissertativa' => $request->qtd_dissertativa,
            'qtd_alternativa' => $request->qtd_alternativa,
            'json_avaliacao' => $questoes,
            'status' => $request->status,
        ]);

        return redirect("/cadastro-de-avaliacao")->with('msg', 'Avaliação cadastrada com sucesso!');
    }

    public function processos_aprovar(Request $request, int $id)
    {

        $processoSeletivo = ProcessoSeletivo::find($id);

        $processoSeletivo->update([
            'status_id' => $request->status_id,
        ]);

        $processoParecer = ProcessoParecer::create([
            'processo_id' => $request->processo_id,
            'parecer' => $request->parecer,
            'user_id' => $request->user_id,
        ]);

        return redirect("/processo-seletivo")->with('msg', 'Processo seletivo atualizado com sucesso!');
    }

    public function processos_fechamento(Request $request, int $id)
    {

        $processoSeletivo = ProcessoSeletivo::find($id);

        $processoSeletivo->update([
            'status_fechamento' => $request->status_fechamento,
            'data_fechamento' => $request->data_fechamento,
            'status_id' => 5
        ]);

        // dd($request->status_fechamento);

        return redirect("/processo-seletivo")->with('msg', 'Processo seletivo finalizado com sucesso!');
    }


    public function processo_adicionar_parecer(Request $request, int $id)
    {


        $processoParecer = ProcessoParecer::create([
            'processo_id' => $request->processo_id,
            'parecer' => $request->parecer,
            'user_id' => $request->user_id,
        ]);

        return redirect("/processo-seletivo/$id")->with('msg', 'Parecer adicionado com sucesso!');
    }

    public function candidato_adicionar_parecer(Request $request, int $processo_id, int $candidato_id)
    {


        $candidatoParecer = CandidatoParecer::create([
            'processo_id' => $request->processo_id,
            'candidato_id' => $request->candidato_id,
            'parecer' => $request->parecer,
            'user_id' => $request->user_id,
        ]);

        return redirect("/processo-seletivo/$processo_id/candidato/$candidato_id")->with('msg', 'Parecer adicionado com sucesso!');
    }
}
