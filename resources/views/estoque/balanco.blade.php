@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i == 0)        
            <!-- Inicio card listagem -->
            <div class="col-md-10"> 
                <div class="card"> 
                    <div class="card-header">
                        Balanços Realizadas
                        <a style="float: right" href="/estoque/formBalanco" class="btn btn-outline-info btn-sm">Cadastrar</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-sm table-striped table-borderless table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Cód. Balanço</th> 
                                    <th scope="col">Realizado em</th> 
                                </tr> 
                            </thead> 
                            <tbody> 
                                @if(isset($balancos))
                                    @foreach($balancos as $b)
                                        <tr>
                                            <td>{{$b->id}}</td>
                                            <td>{{$b->dt_balanco}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
            <!-- Fim card listagem --> 
        @endif     
        @if($i == 1)
            <!-- Inicio card Cadastro-->
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header" style="text-align: center">
                        Lançar Balanço
                    </div>
                    <div class="card-body">  
                        <form action="/estoque/formBalanco" method="POST">
                            @csrf        
                            <div class="form-group row">
                                <label class="col-sm-2">Data Balanço</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control form-control-sm datepicker" id="dt_emissao" name="dt_emissao"> 
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2">Produtos</label>
                                <div class="col-sm-7">
                                    <select class="custom-select custom-select-sm" name="produtoSelect" id="produtoSelect">
                                        <option selected></option> 
                                        @if(isset($produtos))
                                            @foreach($produtos as $p)
                                                <option value="{{$p->id}}">{{$p->name}}</option> 
                                            @endforeach
                                        @endif 
                                    </select>      
                                </div>
                            </div>
                            <div class="form-group row"> 
                                <div class="col-sm-2">Dados</div>
                                <div class="col-sm-2">
                                    <input type="text" name="qtdProd" id="qtdProd" class="form-control form-control-sm" placeholder="Qtd">
                                </div> 
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-sm btn-info" onclick="addItemBalanco()">+</button> 
                                </div>
                            </div> 
                            <div class="row">
                                <table class="table table-responsive-sm table-striped">
                                        <thead>
                                            <tr>
                                              <th>Produto</th>
                                              <th>Quantidade no Balanço</th>
                                              <th>Saldo Anterior</th>
                                              <th>Diferença</th>
                                              <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableProducts">
                                            
                                        </tbody>
                                </table>
                            </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button> 
                        <a href="/estoque/compras" class="btn btn-sm btn-danger">Cancelar</a>
                        </form>                    
                    </div>
                </div>
            </div>
            <!-- Fim card Cadastro-->  
        @endif  
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </div>
</div>
@endsection 
@section('javascript') 
    <script type="text/javascript" src="{{asset('js/components/datepicker.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/estoque/balanco.js')}}"></script> 
    <script type="text/javascript"> 
        //Setar obj com os arrays dos prods e qtd_prods
        function setItens(){
            //Se não houver nenhum registro de posição de estoque para os produtos gerar array qtd zerado 
            @if(count($posicao_atual) == 0)
                @foreach($produtos as $p)
                    cod_prod.push({{$p->id}});
                    qtd_prod.push(0); 
                @endforeach 
            @else
                //Se houver registros, inserir dados no array
                @foreach($posicao_atual as $p)
                    cod_prod.push({{$p['produto_id']}});
                    qtd_prod.push({{$p['quantidade_atual']}});  
                @endforeach  
            @endif
            //Setar obj
            obj.produto_id = cod_prod;
            obj.qtd_prod = qtd_prod;
        }  
    </script>
@endsection