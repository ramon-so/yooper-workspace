<?php

namespace App\Http\Controllers;

use App\Services\FuncionarioInfo;
use App\Services\ListarServicos;
use App\Services\ListarClientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Clientes;
use App\Funcionario;
use App\Carteiras;
use App\Contratos;
use App\Heads;
use App\Servicos;
use App\Usuario;
use Hamcrest\Arrays\IsArray;

class CarteirasController extends Controller
{
    public function carteiras_view(FuncionarioInfo $funcionarioInfo){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $departamento = $infos_func[0]->departamento;
        $departamento = DB::select("SELECT * FROM departamentos WHERE departamento = '$departamento'");
        $departamento = $departamento[0];
        $departamento_servicos = DB::select("SELECT servicos.* FROM servicos LEFT JOIN servicos_por_departamento ON servicos_por_departamento.servicos_id = servicos.id WHERE servicos_por_departamento.departamentos_id = '$departamento->id'");
        
        $head = Heads::select("*")->where('heads.departamento_id', $departamento->id)->get();
        $head = $head[0];

        $analistas_inativos = Funcionario::select("*")
            ->where('funcionarios.departamento_id', $departamento->id)
            ->where('funcionarios.id', '!=', $head->funcionario_id)
            ->where('funcionarios.ativo', '=', 'Não')
            ->get();
            
            foreach($analistas_inativos AS $inativo){

                $carteiras_excluidas_funcionario_inativo = Carteiras::select('*')
                    ->where('carteiras.funcionario_id', '=', $inativo->id)
                    ->get();

                foreach($carteiras_excluidas_funcionario_inativo AS $carteira){
                    $carteira->delete();
                }
            }

            $analistas = Funcionario::select("*")
                ->where('funcionarios.departamento_id', $departamento->id)
                ->where('funcionarios.id', '!=', $head->funcionario_id)
                ->where('funcionarios.ativo', '=', 'Sim')
                ->get();

            for($i = 0; $i < count($analistas); $i++){
                $carteira = Carteiras::select(
                    'clientes.razaosocial',
                    'clientes.empresa',
                    'clientes.id AS cliente_id',
                    'contratos.id AS contrato_id'
                )
                ->rightJoin('contratos', 'carteiras.contrato_id', '=', 'contratos.id')
                ->rightJoin('clientes', 'contratos.cliente_id', '=', 'clientes.id')
                ->where('carteiras.funcionario_id', '=', $analistas[$i]->id)
                ->get();
                $analistas[$i]['carteira'] = $carteira;
                $usuario = Usuario::select('*')
                ->where('usuarios.funcionario_id', '=', $analistas[$i]->id)
                ->get();
                $analistas[$i]['usuario'] = $usuario[0];
            }

            $clientes_sem_carteiras = [];

            foreach($departamento_servicos AS $servico){

                    $search = DB::select("SELECT clientes.id, clientes.razaosocial, clientes.empresa, contratos.id AS contrato_id
                    FROM clientes
                    LEFT JOIN contratos ON contratos.cliente_id = clientes.id
                    LEFT JOIN carteiras ON carteiras.contrato_id = contratos.id
                    WHERE contratos.servico_id = '$servico->id' AND carteiras.id IS NULL");
                // $search = DB::table('clientes')->select(
                //     'clientes.id','clientes.razaosocial', 'clientes.empresa', 'contratos.id'
                // )
                //     ->leftJoin('contratos', 'contratos.cliente_id', '=', 'clientes.id')
                //     ->leftJoin('carteiras', 'carteiras.contrato_id', '=', 'contratos.id')
                //     ->where('contratos.servico_id', '=', $servico->id)
                //     ->where('carteiras.id', '=', NULL)
                //     ->get();

                array_push($clientes_sem_carteiras, $search);
            }


            $carteiras = Carteiras::select("*")->get();


        return view('layouts.carteiras.carteiras', compact('infos_func', 'carteiras', 'clientes_sem_carteiras', 'analistas'));
    }

    public function adicionar_cliente_carteira(FuncionarioInfo $funcionarioInfo, Request $request){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $request = $request->all();

        $departamento = $infos_func[0]->departamento;
        $departamento = DB::select("SELECT * FROM departamentos WHERE departamento = '$departamento'");
        $head = Heads::select("*")->where('heads.departamento_id', $departamento[0]->id)->get();

        if($head){

            try {
            
                $carteira = Carteiras::create([
                    'funcionario_id' => $request['analista'],
                    'contrato_id' => $request['contrato_id'],
                    'created_at' => Date('y-m-d')
                ]);

                return redirect()->route('carteiras_view');
            } catch (\Throwable $th) {
                dd($th);
            }
            
        }else{
            return redirect()
                ->back()
                ->withErrors('Usuário sem permissão');
        }
    }

    public function excluir_carteira(FuncionarioInfo $funcionarioInfo, Request $request){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $request = $request->all();

        $departamento = $infos_func[0]->departamento;
        $departamento = DB::select("SELECT * FROM departamentos WHERE departamento = '$departamento'");
        $head = Heads::select("*")->where('heads.departamento_id', $departamento[0]->id)->get();

        if($head){

            try {
            
                $carteiras_excluidas = Carteiras::select('*')
                    ->where('carteiras.funcionario_id', '=', $request['funcionario_id'])
                    ->get();

                foreach($carteiras_excluidas AS $carteira){
                    $carteira->delete();
                }

                return redirect()->route('carteiras_view');
            } catch (\Throwable $th) {
                return redirect()
                ->back()
                ->withErrors('Erro');
            }
            
        }else{
            return redirect()
                ->back()
                ->withErrors('Usuário sem permissão');
        }
    }

    public function excluir_cliente_carteira(FuncionarioInfo $funcionarioInfo, Request $request){
        $infos_func = $funcionarioInfo->funcionario_informacoes(Auth::user()->id);

        $request = $request->all();

        $departamento = $infos_func[0]->departamento;
        $departamento = DB::select("SELECT * FROM departamentos WHERE departamento = '$departamento'");
        $head = Heads::select("*")->where('heads.departamento_id', $departamento[0]->id)->get();

        if($head){

            try {
            
                $carteiras_excluidas = Carteiras::select('*')
                    ->where('carteiras.funcionario_id', '=', $request['funcionario_id_excluir'])
                    ->where('carteiras.contrato_id', '=', $request['contrato_id'])
                    ->get();

                foreach($carteiras_excluidas AS $carteira){
                    $carteira->delete();
                }

                return redirect()->route('carteiras_view');
            } catch (\Throwable $th) {
                return redirect()
                ->back()
                ->withErrors('Erro');
            }
            
        }else{
            return redirect()
                ->back()
                ->withErrors('Usuário sem permissão');
        }
    }

}