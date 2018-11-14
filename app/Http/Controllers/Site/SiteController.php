<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function __construct(){
        //$this->middleware('auth');//faz com que somente autorizados acessem os mestodos dessa controler
        /*
        $this->middleware('auth')
                    ->only([
                        'contato',
                        'categoria'
                    ]);

                    //faz com que somente usuarios autorizados acessem..
                    //o only faz com que somente seja aplicado aos metódos, contato e categoria;
                    */
        /*
        $this->middleware('auth')
                        ->except([
                            'index',
                            'contato'
                        ]);
            //faz com que somente usuarios autorizados acessem..
                    //o only faz com que  seja aplicado a todos os metódos, exceto  contato e index;
                    */
    }
    public function index()
    {
        
        $title = 'Titulo Teste';
        $var1 = '123';
        $arrayData = [];
        return view('site.home.index', compact('title','var1','arrayData'));
    }
    public function contato(){
        return view('site.contato.index');
    }
    public function categoria($id){
        return "Listagens dos posts da categoria: {$id}";
    }
    public function categoriaOp($id = 1){
        return "Listagens dos posts da categoria: {$id}";
    }
    
}//fim da classe SiteController;