@extends('painel.templates.template')

@section('content')
<h1 class="title-pg">
    <a href="{{route('produtos.index')}}"><i class="material-icons">skip_previous</i></a>
    Gestão Produto: <b>{{ isset($product->name)?$product->name:'Novo'}}</b></h1> 


@if( isset($errors) && count($errors) > 0)
<div class="alert-danger">
    @foreach( $errors -> all() as $error)
    <p>{{$error}}</p>
    @endforeach    
</div>
@endif

@if( isset ($product) )
    {!! Form::model($product, ['route' => ['produtos.update', $product->id], 'class' => 'form', 'method' => 'put' ]) !!}
@else
    {!! Form::open(['route' => 'produtos.store', 'class' => 'form']) !!}
@endif
    <!-- {>!! csrf_field() !!}--><!-- GERA TOKEN PARA PROTEGER CONTRAS ATAQUES csrf MÉTODO MAIS SIMPLES DE FAZER-->
<!--//value="old('name')     //mantém  o valor impedindo que limpe o formulário, até ser enviado -->


    <div class="form-group">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome:']) !!}
    </div>                                                          
    <div class="form-group">                                        
     <label>
        {!! Form::checkbox('active') !!}
        Ativo?                                                                
        </label>
     </div>
     <div class="form-group">
        {!! Form::text('number', null, ['class' => 'form-control', 'placeholder' => 'Numero:']) !!}

    </div>
     <div class="form-group">
        {!! Form::select('category', $categorys, null, ['class' => 'form-control']) !!}  <!-- form::select(nomeDoCampo, DadosqueIramPovoar, valorqueQuerPreenchido, arraycomOsDados) -->
    </div>
    <div class="form-group">
    {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Descrição:']) !!}
    <br>
    {!! Form::submit ('Enviar', ['class' => 'btn btn-primary'])!!}
{!! Form::close() !!}

@endsection