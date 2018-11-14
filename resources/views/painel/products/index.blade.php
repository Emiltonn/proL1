@extends("painel.templates.template")

@section('content')
<h1 class="title-pg"> LISTAGEM DOS PRODUTOS</h1>

<a href="{{route('produtos.create')}}" class="btn btn-primary btn-add"><i class="material-icons">add</i>Cadastrar</a>
<table class="table table-striped">
    <tr>    
        <th>Nome</th>
        <th>Descrição</th>
        <th>Ações</th>

    </tr>
    @foreach($products as $product)
    <tr>
        <td>{{$product->name}}</td>
        <td>{{$product->description}}</td>
        <td>
            <a href="{{route('produtos.edit', $product->id)}}" class="actions edit">
               <i class="material-icons">
                   create
             </i>
             </a>
          <a href="{{route('produtos.show', $product->id)}}" class="actions delete">
               <i class="material-icons">
                    visibility
               </i>
          </a>
            
        </td>
    </tr>
    @endforeach
</table>
@endsection
