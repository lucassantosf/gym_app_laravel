<?php

Route::get('/', 'LoginController@index') ;
//Direcionamento do Logout
Route::get('logout', 'LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin.dash');

Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');

Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::middleware(['auth'])->group(function () {
	// Cadastros
	Route::get('/cadastros/users','CadastrosController@indexUser');
	Route::get('/cadastros/user/{id}/edit','CadastrosController@formUserEdit');
	Route::post('/cadastros/user/{id}/edit','CadastrosController@postFormUserEdit');
	Route::get('/cadastros/user/{id}/delete','CadastrosController@destroyUser');
	Route::get('/cadastros/formUser','CadastrosController@formUser');
	Route::post('/cadastros/formUser','CadastrosController@postFormUser');

	Route::get('/cadastros/plans','CadastrosController@indexPlans');
	Route::get('/cadastros/products','CadastrosController@indexProducts');
	Route::get('/cadastros/modals','ModalidadeController@indexModals');
	Route::get('/cadastros/formModal','ModalidadeController@formModal');
	Route::post('/cadastros/formModal','ModalidadeController@postFormModal');
	Route::get('/cadastros/modal/{id}/edit','ModalidadeController@formModalEdit');
	Route::post('/cadastros/modal/{id}/edit','ModalidadeController@postformModalEdit');
	Route::get('/cadastros/modal/{id}/delete','ModalidadeController@destroyModal');

	Route::get('/cadastros/products','ProdutoController@indexProds');
	Route::get('/cadastros/formProd','ProdutoController@formProd');
	Route::post('/cadastros/formProd','ProdutoController@postformProd');
	Route::get('/cadastros/prod/{id}/edit','ProdutoController@formProdEdit');
	Route::post('/cadastros/prod/{id}/edit','ProdutoController@postformProdEdit');
	Route::get('/cadastros/prod/{id}/delete','ProdutoController@destroyProd');

	Route::get('/cadastros/plans','PlanoController@indexPlans');
	Route::get('/cadastros/formPlan','PlanoController@formPlan');
	Route::post('/cadastros/formPlan','PlanoController@postFormPlan');
	Route::get('/cadastros/plan/{id}/edit','PlanoController@formPlanEdit');
	Route::post('/cadastros/plan/{id}/edit','PlanoController@postformPlanEdit');
	Route::get('/cadastros/plan/{id}/delete','PlanoController@destroyPlan');
	Route::get('/cadastros/plans/{id}/details','PlanoController@detailsPlans');
	Route::post('/cadastros/plans/postConferirNeg','PlanoController@postConferirNeg'); 
	Route::post('/cadastros/plans/postVenda','PlanoController@postVenda');
 
	Route::get('/cadastros/turmas','TurmaController@indexTurmas');
	Route::get('/cadastros/formTurma','TurmaController@formTurma');
	Route::post('/cadastros/formTurma','TurmaController@postFormTurma'); 
	Route::get('/cadastros/turmas/{id}/edit','TurmaController@formTurmaEdit'); 
	Route::get('/cadastros/turmas/{id}/delete','TurmaController@destroyTurma');
	Route::post('/cadastros/turmas/{id}/edit','TurmaController@postformTurmaEdit');
	Route::get('/home/turmas/gestaoturmasview','TurmaController@gestaoTurmasView');
	Route::get('/home/turmas/gestaoturmasview/consultarTurmasFromModalId/{id}','TurmaController@getTurmasFromModalId');
	Route::get('/home/turmas/gestaoturmasview/consultarItensFromTurmaId/{id}','TurmaController@getItensFromTurmaId'); 
 	
	Route::get('/cadastros/fornecedores','FornecedorController@indexFornecedores');
	Route::get('/cadastros/formFornecedor','FornecedorController@formFornecedor');
	Route::post('/cadastros/formFornecedor','FornecedorController@postFormFornecedor');
	Route::get('/cadastros/fornecedor/{id}/edit','FornecedorController@formFornecedorEdit'); 
	Route::post('/cadastros/fornecedor/{id}/edit','FornecedorController@postFormFornecedorEdit'); 
	Route::get('/cadastros/fornecedor/{id}/delete','FornecedorController@destroyFornecedor');

	//Gestão de Estoque compras
	Route::get('/estoque/compras','CompraController@indexCompras');
	Route::get('/estoque/formCompra','CompraController@formCompra');
	Route::post('/estoque/formCompra','CompraController@postFormCompra');
	Route::get('/estoque/compra/{id}/delete','CompraController@destroyCompra');
	Route::get('/estoque/posicaoEstoque','PosicaoEstoqueController@indexPosicaoEstoque');

	//balanço
	Route::get('/estoque/balanco','BalancoController@indexBalancos');
	Route::get('/estoque/formBalanco','BalancoController@formBalanco');
	Route::post('/estoque/formBalanco','BalancoController@postFormBalanco');
	Route::get('/estoque/balanco/{id}/delete','BalancoController@destroyBalanco');

	//cardex
	Route::get('/estoque/cardex','CardexController@indexCardex');
	Route::get('/estoque/cardex/{from}/{to}/{produto_id}','CardexController@searchCardex'); 

	// Clientes e Incluir Clientes
	Route::get('/clients','ClienteController@indexClients');
	Route::get('/incluir/clients','ClienteController@indexClientsAdd');
	Route::post('/incluir/clients','ClienteController@postClientsAdd');
	Route::post('/incluir/clientsEdit','ClienteController@postClientsEdit');
	Route::get('/clients/{id}/show','ClienteController@showClient');
	Route::get('/clients/novoContrato/{id}','ClienteController@newContract');
	Route::get('/clients/estornarContrato/{id_venda}/{id_pessoa}','ClienteController@estornarContract');

	//Parcelas
	Route::get('/clients/buscarParcelas/{id}','ParcelaController@showParcelasVenda');
	Route::get('/clients/buscarParcelas','ParcelaController@mostrarParcelas');
	Route::get('/clients/buscarParcelasAberto/{nome}','ParcelaController@buscarParcelasAberto');
	Route::get('/clients/pagarParcela/{id}/{hasContrato}','ParcelaController@payParcela');
	Route::get('/clients/pagarParcelaVA/{id}/{hasVenda}','ParcelaController@payParcelaVA'); 
	Route::get('/clients/getRecibo/{id}','ParcelaController@getRecibo');
	Route::get('/clients/estornarRecibo/{id}','ParcelaController@estornarRecibo');
	Route::get('/clients/caixaAberto/{id}','ParcelaController@parcelasEmAberto');
	Route::post('/clients/caixaAberto/pagarParcela','ParcelaController@pagarParcelas');
	Route::post('/clients/caixaAberto/post','ParcelaController@postCaixaAberto'); 

	//Vendas e Vendas Avulsas
	Route::get('/vendas/view','VendaController@returnView'); 
	Route::post('/vendas/viewPost','VendaAvulsaController@postVendaAvulsa');
	Route::get('/vendas/estornarVendaAvulsa/{id}','VendaAvulsaController@estornarVendaAvulsa');
	Route::get('/vendas/viewWithClient/{id}/{name}','VendaController@returnViewWithClient');
	Route::get('/vendas/searchClientByName/{name}','VendaController@getClientsName');
	Route::get('/vendas/searchProdByName/{name}','VendaController@getProdsName');

	//Relatórios
	Route::get('/relatorios/clients','RelatorioController@viewRelatorioClientes');
	Route::get('/relatorios/clients/search','RelatorioController@searchRelatorioClientes');
	Route::get('/relatorios/faturamento','RelatorioController@viewRelatorioFaturamento');
	Route::get('/relatorios/faturamento/search','RelatorioController@searchRelatorioFaturamento');
	Route::get('/relatorios/receita','RelatorioController@viewRelatorioReceita');
	Route::get('/relatorios/receita/search','RelatorioController@searchRelatorioReceita');
	Route::get('/relatorios/parcelas','RelatorioController@viewRelatorioParcelas');
	Route::get('/relatorios/parcelas/search','RelatorioController@searchRelatorioParcelas'); 
});  