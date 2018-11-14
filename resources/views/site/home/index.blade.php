@extends('site.templates.template1')

@section('content')
<h1>teste da index</h1>
{{ isset($title)?$title:'Não existe'}}

@if( $var1 == '123')
    <p>É igual</p>
@else
    <p>É diferente</p>
@endif
@unless( $var1 == '123')
    <p>Não é iguak ... unless</p>

@endunless

@for( $i = 0; $i < 10; $i++)
    <p>For:  {{$i}}</p>

@endfor

@if(count ($arrayData) > 0 )
@foreach($arrayData as $array)
    <p>Foreach: {{$array}}</p>
@endforeach

@else   <p>Não existe intens para serem impressos</p>
@endif

@forelse($arrayData as $array)
    <p>Forelse: {{$array}}</p>
    @empty
    <p>Não existem intens para serem impressos</p>
@endforelse


@include('site.includes.sidebar', compact('var1'))
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
@endpush

