@extends('site.layout')
@section('title', 'Carrinho')
@section('conteudo')

<div class="row container">


    @if ($mensagem = Session::get('sucesso'))
    

    <div class="card green darken-1">
        <div class="card-content white-text">
          <span class="card-title">Parabéns!</span>
          <p>{{$mensagem}}</p>
        </div>
      </div>

    @endif

    <h5>Seu carrinho possui {{ $itens->count() }} produtos. </h5>
    <table class="striped">
        <thead>
          <tr>
              <th></th>
              <th>Nome</th>
              <th>Preço</th>
              <th>Quantidade</th>
              <th></th>
          </tr>
        </thead>

        <tbody>
            @foreach ($itens as $item)
          <tr>
            <td><img src="{{$item->attributes->image}}" alt="" width="70"  class="responsive-img circle"></td>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td><input type="number" name="quantity" value="{{$item->quantity}}"></td>
            <td>
                {{-- BTN ATUALIZAR --}}
                <form action="{{ route('site.atualizacarrinho')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="id" value="{{$item->id }}">
                <button class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
                </form>
                    
                {{-- BTN REMOVER --}}
                <form action="{{ route('site.removecarrinho')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="id" value="{{$item->index }}">    
                <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                </form>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>

      <div class="row container center">

{{--BNT CONTINUAR COMPRANDO--}}
        <form action="{{ route('site.index')}}" method="GET" enctype="multipart/form-data">
          @csrf
        <button class="btn waves-effect waves-light blue"> Continuar comprando <i class="material-icons right">arrow_back</i></button>
      </form>

<form action="{{ route('site.limparcarrinho')}}" method="DELETE" enctype="multipart/form-data">
                    @csrf
        <button class="btn waves-effect waves-light blue"> Limpar o carrinho <i class="material-icons right">clear</i></button>

        
        <button class="btn waves-effect waves-light green"> Finalizar pedido <i class="material-icons right">chek</i></button>
      </div>

    
</div>
@endsection

-