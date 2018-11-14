<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Painel\Product;
use App\Http\Requests\Painel\ProductFormRequest;

class ProdutoController extends Controller
{
    private $product;
    public function __construct(Product $product){
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Listagem dos produtos';

        $products = $this->product->all();

        return view('painel.products.index', compact('products','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Produto';
        $categorys = ['eletrônicos', 'moveis', 'limpeza', 'banho'];
        return view('painel.products.create-edit', compact('title', 'categorys'));
    }//fim create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)

    {
        //AULA 21 - REQUESTS
       // dd($request->all());//usado para pegar todos os registros do form
      // dd($request->only(['name','number']));//p/ pegar apenas esse campos - dentro do vetor.
      //dd($request->except('_token','name'));//p/ pegar todos exceto os que estao dentro do vetor
        //dd($request->input('description'));//p/ pegar SOMENTE  o que esta dentro do . UM UNICO VALOR
    //AULA 22 - CADASTRAR DO FORM NO BANCO;
    //pega todos os dados do formulário;
        $dataForm = $request->all();
        //Se não existir o 'active o valor recebido será(0) = false, 
        //caso exista será TRUE=(1);
        $dataForm['active'] = ( !isset ($dataForm['active']) ) ? 0 : 1;
        //AULA 23 - validação de dados;
        //valida os dados
        //$this->validate($request, $this->product->rules); //uma das formas
        //AULA 24 - PERSONALIZAR MSG'S DE ERRO;
        /*
        $messages = [
            'name.required' => 'O campo é de preenchimento obrigatório!',
            'number.numeric' => 'O campo númeor é de preenchimento obrigatórios',
            'number.required' => 'O campo é de preenchimento obrigatório',
        ];
        $validate = Validator::make($dataForm, $this->product->rules, $messages);
        if( $validate->fails() ) {
            return redirect()
                     -> route('produtos.create')
                     ->withErrors($validate)
                     ->withInput();
        }//fim if
        */

        //faz o cadastro
        $insert = $this->product->create($dataForm);//FAZ O CADASTRO

        if( $insert )
            return redirect()->route('produtos.index');
        else
        return redirect()->back();//volta pra onde veio
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->find($id);

        $title = "Produto: {$product->name}";
        
        return view('painel.products.show', compact('product', 'title'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Recupera o produto pelo ID
        $product = $this->product->find($id);

        $title = "Editar Produto: {$product->name}";
        $categorys = ['eletrônicos', 'moveis', 'limpeza', 'banho'];

        return view('painel.products.create-edit', compact('title', 'categorys','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        //recupera todos os dados do formulario
        $dataForm = $request->all();
        //recupera o item para editar
        $product = $this->product->find($id);

        //verifica se o produto está ativado
        $dataForm['active'] = ( !isset($dataForm['active'])) ? 0:1;

        //altera os itens
        $update = $product->update($dataForm);

            //verifica se realmente editou
        if($update)
            return redirect()->route('produtos.index');
        else
            return redirect()->route('produtos.edit', $id)->with(['errors' => 'Falha ao editar']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->find($id);
        
        $delete = $product->delete();

        if( $delete )
            return redirect () ->route('produtos.index');
        else {
            return redirect() ->route('produtos.show', $id)->with(['errors' => 'Falha ao deletar']);
        }
    }
    public function tests(){
        /*
        uma das formas de fazer, porém mais improdutiva
        $prod = $this->product;
        $prod->name = 'Nome do produto';
        $prod->number = 1235248;
        $prod->active = true;
        $prod->category = 'eletrônicos';
        $prod->description = 'Descricao do produto aqui';
        $insert = $prod->save();

        if($insert)
            return 'Inserido com Sucesso';
        else
            return 'Falha ao Inserir';
        */
        /* AULA 16 - INSERIR NO BANCO DE DADOS
        $insert = $this->product->create([
            'name'      =>      'Nome do produto2',
            'number'        =>      45786,
             'active'       =>      false,
            'category'      =>       'eletrônicos',
            'description'       =>      'Descricao vem aqui do produto aqui',
        ]);
        if( $insert )
          return "Inserido com Sucesso, ID: {$insert->id}";//precisa estar entre aspas duplas p funfar
        else
          return 'Falha ao Inserir';
          */
        /*AULA 17 - UPDATE - UMA DAS MANEIRAS; POREM MENOS PRODUTIVA.
          $prod = $this->product->find(5);
          $prod->name = 'Update';
          $prod->number = 789456;
          $prod->active = true;
          $prod->category = 'eletrônicos';
          $prod->description = 'Desc Update';
          $update = $prod->save();

          if($update)
            return 'Alterado com sucesso!';
        else
            return "Falha ao alterar!";

        */
            /*TESTE DE UPDATE  - RECOMENDADO
        $update = $this->product
                    ->where('number', 200300)
                    ->update([
                        'name'      =>      'Update_Teste 2',
                        'number'    =>      200300,
                        'active'    =>      false,
                   ]);
        
        if($update)
             return 'Alterado com sucesso 2!';
        else
            return "Falha ao alterar!";
            
                        */
        /* AULA 17 - DELETE USANDO - METODO DELETE;
        $prod = $this->product->find(3);
        $delete = $prod->delete();

        if( $delete )
            return 'Deletado com Sucesso!.';
        else
             return 'Falha ap deletar';
             */
            
        // AULA 17 - DELETE USANDO - METODO DELETE - recomendado;
        $delete = $this->product
                        ->where('number', 45786)
                        ->delete();

        if( $delete )
            return 'Deletado com Sucesso!.';
        else
             return 'Falha ap deletar';
    }
}
