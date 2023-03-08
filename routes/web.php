<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*

Route::middleware('Colaborador')->group(function() {

	//CRM 
	Route::get('/email-marketing-unico', 'EmailMarketingUnicoController@index')->name('email_marketing_unico'); 
	Route::post('/email-marketing-unico/criar', 'EmailMarketingUnicoController@store')->name('gerar_html'); 
	Route::get('/email-marketing-unico-html/{id}', 'EmailMarketingUnicoController@view_html')->name('view_html'); 

	Route::get('/email-marketing-news', 'EmailMarketingNewsController@index')->name('email_marketing_news'); 

	Route::post('/email-marketing-news/criar', 'EmailMarketingNewsController@store')->name('criar_email_news'); 

	Route::get('/email-marketing-news-informacoes/{cliente_id}/{cliente_nome}/{id}', 'EmailMarketingNewsController@editar_email')->name('editar_email'); 

	Route::post('/email-marketing-news-informacoes/{id}/alterar_infos','EmailMarketingNewsController@alterar_infos'); 

	Route::get('/email-marketing-news-lista','EmailMarketingNewsController@listar')->name('listar_news'); 

	Route::get('/email-marketing-news-html/{id}', 'EmailMarketingNewsController@view_html')->name('view_html'); 
});


*/

Route::middleware('Master')->group(function () {
	Route::get('/cadastrar-funcionario','CadastrarFuncionarioController@cadastrar_funcionario_view')->name('pagina_cadastrar_funcionarios'); 
	Route::post('/cadastrar-funcionario/criar','CadastrarFuncionarioController@cadastrar_funcionario')->name('criar_funcionario'); 
	Route::get('/cadastrar-usuarios','UsuariosController@index')->name('pagina_cadastrar_usuarios'); 
	Route::post('/cadastrar-usuarios/criar', 'UsuariosController@store')->name('criar_usuario'); 
	Route::get('/usuarios', 'UsuariosController@listarUsuarios')->name('exibir_usuarios'); 
	Route::post('/usuario/{id}/ativar_inativar', 'UsuariosController@ativar_inativar'); 
	Route::post('/usuario/{id}/{func_id}/editar', 'UsuariosController@editar_usuario'); 
	
	Route::get('/status-processo-seletivo','ParametrosController@status_processo_seletivo_view')->name('pagina_cadastrar_status_processo_seletivo'); 
	Route::post('/status-processo-seletivo/criar','ParametrosController@status_processo_seletivo_criar')->name('criar_status_processo_seletivo'); 
	Route::post('/status-processo-seletivo/{id}/editar','ParametrosController@status_processo_seletivo_editar'); 
	Route::post('/status-processo-seletivo/{id}/ativar_inativar','ParametrosController@ativar_inativar_status_processo_seletivo'); 

	Route::get('/status-candidatos','ParametrosController@status_candidatos_view')->name('pagina_cadastrar_status_candidatos'); 
	Route::post('/status-candidatos/criar','ParametrosController@status_candidatos_criar')->name('criar_status_candidatos'); 
	Route::post('/status-candidatos/{id}/editar','ParametrosController@status_candidatos_editar'); 
	Route::post('/status-candidatos/{id}/ativar_inativar','ParametrosController@ativar_inativar_status_candidatos'); 

	Route::get('/servicos','ParametrosController@servicos_view')->name('pagina_cadastrar_servicos'); 
	Route::post('/servicos/criar','ParametrosController@servicos_criar')->name('criar_servicos'); 
	Route::post('/servicos/{id}/editar','ParametrosController@servicos_editar'); 
	Route::post('/servicos/{id}/ativar_inativar','ParametrosController@ativar_inativar_servicos'); 

	Route::get('/heads','HeadsController@heads_view')->name('pagina_cadastrar_heads'); 
	Route::post('/heads/criar','HeadsController@heads_criar')->name('criar_heads'); 
	Route::post('/heads/{id}/editar','HeadsController@heads_editar'); 
	Route::post('/heads/{id}/ativar_inativar','HeadsController@ativar_inativar_heads'); 

	Route::post('/yoodash/{id}/inativar','YooDashController@inativar_dashboard'); 
	Route::post('/yoodash/{id}/ativar','YooDashController@ativar_dashboard'); 
	Route::post('/yoodash/cadastrar-dashboard','YooDashController@cadastrar_dashboard')->name('cadastrar-dashboard'); 
	Route::post('/yoodash/cadastrar-usuarios','YooDashController@cadastrar_usuarios')->name('cadastrar-usuarios'); 
	Route::post('/yoodash/editar/{id}','YooDashController@editar_dashboard')->name('editar_dashboard'); 
	
	Route::post('/clientes/cadastrar-cliente','GestaoClientesController@cliente_store')->name('cadastrar-cliente'); 
	Route::post('/contratos/cadastrar-contrato','GestaoClientesController@contrato_store')->name('cadastrar-contrato'); 
	Route::post('/contrato/{id}/ativar', 'GestaoClientesController@ativar_contrato')->name('ativar_contrato');
	Route::post('/contrato/{id}/cancelar', 'GestaoClientesController@cancelar_contrato')->name('cancelar_contrato');

	Route::get('/subdepartamentos','ParametrosController@subdepartamentos_view')->name('pagina_cadastrar_subdepartamentos'); 
	Route::post('/subdepartamentos/criar','ParametrosController@subdepartamentos_criar')->name('criar_subdepartamentos'); 
	Route::post('/subdepartamentos/{id}/editar','ParametrosController@subdepartamentos_editar'); 
	Route::post('/subdepartamentos/{id}/ativar_inativar','ParametrosController@ativar_inativar_subdepartamentos'); 

	
});

Route::middleware('Master-RH')->group(function () {
	Route::get('/captacao','ParametrosController@captacao_view')->name('pagina_cadastrar_captacao'); 
	Route::post('/captacao/criar','ParametrosController@captacao_criar')->name('criar_captacao'); 
	Route::post('/captacao/{id}/editar','ParametrosController@captacao_editar'); 
	Route::post('/captacao/{id}/ativar_inativar','ParametrosController@ativar_inativar_cp');
});
Route::middleware('Financeiro')->group(function(){
	Route::get('/clientes', 'GestaoClientesController@gestao_clientes_view')->name('gestao_clientes_view');
	Route::get('/cliente/{id}', 'GestaoClientesController@cliente_view')->name('cliente_view');
	Route::get('/clientes-ativos', 'GestaoClientesController@visao_ativos_view')->name('clientes_ativos');
	Route::post('/cliente/atualizar', 'GestaoClientesController@atualizar_cliente')->name('atualizar_cliente');
});

Route::middleware('Head')->group(function () {
	Route::get('/departamento','ParametrosController@departamento_view')->name('pagina_cadastrar_departamentos'); 
	Route::post('/departamento/criar','ParametrosController@departamento_criar')->name('criar_departamento'); 
	Route::post('/departamento/{id}/editar','ParametrosController@departamento_editar'); 
	Route::post('/departamento/{id}/ativar_inativar','ParametrosController@ativar_inativar_depto');
	
	Route::get('/carteiras', 'CarteirasController@carteiras_view')->name('carteiras_view');
	Route::post('/carteiras/adicionar-cliente', 'CarteirasController@adicionar_cliente_carteira')->name('adicionar_cliente_carteira');
	Route::post('/carteiras/excluir-carteira', 'CarteirasController@excluir_carteira')->name('excluir_carteira');
	Route::post('/carteiras/excluir-cliente-carteira', 'CarteirasController@excluir_cliente_carteira')->name('excluir_cliente_carteira');
	
	Route::post('/contratos/atualizar', 'GestaoClientesController@atualizar_contrato')->name('atualizar_contrato');
	Route::post('/contratos/alocar', 'GestaoClientesController@alocar_servico')->name('alocar_servico');
	Route::post('/cliente/atualizar', 'GestaoClientesController@atualizar_cliente')->name('atualizar_cliente');

	Route::post('/contrato/excluir', 'GestaoClientesController@excluir_contrato')->name('excluir_contrato');

	Route::post('/cliente/atualizar-tabela', 'GestaoClientesController@upload_tabela_financeira')->name('atualizar_tabela');
	Route::post('/cliente/atualizar-briefing', 'GestaoClientesController@upload_briefing')->name('atualizar_briefing');
	Route::post('/cliente/atualizar-escopo', 'GestaoClientesController@upload_escopo')->name('atualizar_escopo');
	Route::get('/relatorio-net', 'GestaoClientesController@relatorio_net_view')->name('relatorio_net');
	Route::get('/clientes-classificacoes', 'GestaoClientesController@classificacoes_view')->name('clientes_classificacoes');
	Route::get('/net-contratos', 'GestaoClientesController@contratos_view')->name('contratos_view');
	Route::get('/contrato_assinados', 'GestaoClientesController@contrato_assinados')->name('contrato_assinados');
	Route::get('/atualizar-classificacoes', 'GestaoClientesController@atualizar_classificacoes')->name('atualizar_classificacoes');
});

Route::middleware('RH')->group(function () {
	Route::get('/solicitacao','RecrutamentoController@solicitacao_view')->name('processo-seletivo-solicitacao'); 
	Route::post('/solicitacao/cadastrar','RecrutamentoController@solicitacao_cadastrar')->name('processo-seletivo-solicitacao-cadastrar'); 
	Route::post('/solicitacao/editar/{id}','RecrutamentoController@solicitacao_editar')->name('processo-seletivo-solicitacao-editar'); 
	Route::post('/solicitacao/aprovar/{id}','RecrutamentoController@solicitacao_aprovar')->name('processo-seletivo-solicitacao-aprovar'); 
	Route::get('/processo-seletivo','RecrutamentoController@processo_seletivo_view')->name('processo-seletivo'); 
	Route::post('/processo-seletivo/editar-processo/{id}','RecrutamentoController@processo_seletivo_editar')->name('processo-seletivo-editar'); 
	Route::get('/processo-seletivo/{id}','RecrutamentoController@candidatos_view')->name('processo-seletivo-candidatos'); 
	Route::post('/processo-seletivo/adicionar/{id}','RecrutamentoController@candidatos_criar')->name('processo-seletivo-adicionar-candidato');
	Route::post('/processo-seletivo/vincular-candidato/{id}','RecrutamentoController@vincular_candidato')->name('processo-seletivo-vincular-candidato');
	Route::post('/processo-seletivo/{processo_id}/editar-candidato/{id}','RecrutamentoController@candidatos_editar')->name('processo-seletivo-editar-candidatos'); 
	Route::post('/processo-seletivo/{processo_id}/aprovar-candidato/{id}','RecrutamentoController@candidatos_aprovar')->name('processo-seletivo-aprovar-candidatos');
	Route::get('/candidato/{id}','RecrutamentoController@candidato_view')->name('candidato-view'); 
	Route::get('/banco-de-candidatos','RecrutamentoController@banco_de_candidatos_view')->name('banco-de-candidatos'); 
	Route::post('/banco-de-candidatos/editar-candidato/{id}','RecrutamentoController@banco_candidatos_editar')->name('banco-de-candidatos-editar'); 
	Route::post('/banco-de-candidatos/cadastrar-candidato','RecrutamentoController@banco_candidatos_cadastrar')->name('banco-de-candidatos-cadastrar');
	Route::get('/cadastro-de-avaliacao','RecrutamentoController@cadastro_avaliacao_view')->name('cadastro-avaliacao'); 
	Route::post('/cadastro-de-avaliacao/cadastrar','RecrutamentoController@cadastrar_avaliacao')->name('cadastrar-avaliacao'); 
	Route::post('/processo-seletivo/aprovar-processo/{id}','RecrutamentoController@processos_aprovar')->name('processo-seletivo-aprovar-processo');

	Route::post('/processo-seletivo/fechamento-processo/{id}','RecrutamentoController@processos_fechamento')->name('processo-seletivo-fechamento-processo');

	Route::post('/processo-seletivo/{id}/adicionar-parecer','RecrutamentoController@processo_adicionar_parecer')->name('processo-seletivo-adicionar-parecer');
	Route::post('/processo-seletivo/{processo_id}/candidato/{candidato_id}/adicionar-parecer','RecrutamentoController@candidato_adicionar_parecer')->name('candidato-adicionar-parecer');

	Route::get('/processo-seletivo/{processo_id}/candidato/{id}','RecrutamentoController@perfil_candidato')->name('processo-seletivo-perfil-candidato'); 

	Route::post('/processo-seletivo/{processo_id}/candidato/{id}/editar','RecrutamentoController@processo_candidato_editar')->name('processo-editar-candidatos'); 

	Route::post('/candidato/{id}/editar','RecrutamentoController@candidato_editar')->name('processo-editar-candidatos'); 
	Route::post('/processo-seletivo/{processo_id}/candidato/{candidato_id}/avaliar-head/{resposta_id}','RecrutamentoController@avaliar_head')->name('avaliar-head'); 

	Route::post('/processo-seletivo/{processo_id}/candidato/{candidato_id}/avaliar-gyg/{resposta_id}','RecrutamentoController@avaliar_gyg')->name('avaliar-gyg'); 
});

Route::middleware('Colaborador')->group(function () {
	Route::get('/cadastrar-plano-integrado', 'PlanoIntegradoController@cadastrar_plano_integrado_view')->name('cadastrar-plano-integrado'); 
	Route::post('/cadastrar-plano-integrado/store', 'PlanoIntegradoController@cadastrar_plano_integrado_store')->name('cadastrar-plano-integrado-store'); 
	Route::get('/plano-integrado/clientes', 'PlanoIntegradoController@clientes')->name('todos-clientes'); 
	Route::get('/plano-integrado/boards-integrados', 'PlanoIntegradoController@boards_integrado_view')->name('boards_integrados'); 
	Route::get('/plano-integrado/cadastrar-demanda', 'PlanoIntegradoController@cadastrar_demanda_view')->name('cadastrar-demanda'); 
	Route::post('/plano-integrado/cadastrar-demanda/store', 'PlanoIntegradoController@cadastrar_demanda_store')->name('cadastrar-demanda-store'); 

	Route::get('/cadastrar-plano-integrado', 'PlanoIntegradoController@cadastrar_plano_integrado_view')->name('cadastrar-plano-integrado'); 

	Route::get('/emails-automatizados','FerramentasController@gerarEmail')->name('gerar_email');
	Route::get('/emails-automatizados/boas-vindas','FerramentasController@emailRhModelo1')->name('email_rh_modelo_1');
	Route::get('/emails-automatizados/modelo-6-meses','FerramentasController@emailRhModelo2')->name('email_rh_modelo_2');
	Route::get('/emails-automatizados/modelo-1-ano','FerramentasController@emailRhModelo3')->name('email_rh_modelo_3');
	Route::get('/emails-automatizados/retorno-proposta','FerramentasController@emailRhModelo4')->name('email_rh_modelo_4');
	Route::get('/emails-automatizados/solicitacao-pendente','FerramentasController@emailRhModelo5')->name('email_rh_modelo_5');
	Route::get('/emails-automatizados/bandeiras-yooper','FerramentasController@emailRhModelo6')->name('email_rh_modelo_6');
	Route::get('/emails-automatizados/acessos','FerramentasController@emailRhModelo7')->name('email_rh_modelo_7');
	Route::get('/emails-automatizados/promocao-colaborador','FerramentasController@emailRhModelo8')->name('email_rh_modelo_8');
	Route::get('/emails-automatizados/comunicado-cliente','FerramentasController@emailRhModelo9')->name('email_rh_modelo_9');
	Route::get('/gerar-email/retorno-proposta-pj','FerramentasController@emailRhModelo10')->name('email_rh_modelo_10')->middleware('autenticador');
	Route::get('/gerar-email/onboarding','FerramentasController@emailRhModelo11')->name('email_rh_modelo_11')->middleware('autenticador');
	Route::get('/gerar-email/boas-vindas-clientes','FerramentasController@emailRhModelo12')->name('email_rh_modelo_12')->middleware('autenticador');
	Route::get('/metas-quarter', 'GenteYGestaoController@metas_view'); 
	Route::post('/adicionar-ferramenta', 'GestaoClientesController@adicionarFerramenta')->name('adicionar_ferramenta');
	
});

Route::middleware('autenticador')->group(function () {
	Route::get('/yoodash', 'YooDashController@dashboards')->name('yoodash');
	Route::get('/yoodash/{conta}','YooDashController@conta_id')->name('conta'); 
	Route::get('/', 'DashboardController@dashboard_view');
	Route::get('/dashboard', 'DashboardController@dashboard_view');
	Route::get('/perfil', 'UsuariosController@perfil')->name('perfil');
	Route::post('/perfil/editar', 'UsuariosController@editar_perfil')->name('editar_perfil');
	Route::get('/receitas-e-consumos', 'GestaoDeMidiaController@receitas_e_consumos_view'); 
});

Route::get('/redefinir', function (){
	return view('layouts.login.redefinir');
});
Route::post('/redefinir', 'LoginController@redefinir_senha');
Route::get('/recuperar-senha', 'LoginController@recuperar_senha_view');
Route::get('/recuperar-senha-resposta', 'LoginController@recuperar_senha_resposta_view')->name('recuperarSenhaResposta');
Route::post('/recuperar-senha', 'LoginController@recuperar_senha');
Route::get('/login', 'LoginController@login_view')->name('login');
Route::post('/login', 'LoginController@entrar');
Route::get('/sair', 'LoginController@logout');
// Erro permissão
Route::get('/acesso-negado', 'LoginController@acessoNegado')->name('acesso-negado');


