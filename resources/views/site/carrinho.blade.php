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

    @if (true)
    <div class="card blue darken-1">
        <div class="card-content white-text">
          <span class="card-title">Tudo bem!</span>
          <p>{{$mensagem}}</p>
        </div>
      </div>
    @endif


    @if($itens->count() == 0)

    <div class="card orange darken-1">
      <div class="card-content white-text">
        <span class="card-title">Seu carrinho está vazio!</span>
        <p>Aproveite nossas promoções.</p>
      </div>
    </div>

    @else

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
            <td><img src="{{$item->attributes->image}}" alt="" width="90"  class="responsive-img circle"></td>
            <td>{{$item->name}}</td>
            <td>{{$item->price}}</td>
            <td><input type="number" name="quantity" value="{{$item->quantity}}"></td>
            
            <td>
{{-- BTN ATUALIZAR --}}
                <form action="{{ route('site.atualizacarrinho')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="id" value="{{$item->id }}">
                <td><input style="width: 60px; font-weight:900;" class="white center" min="1" type="number" name="quantity" value="{{ $item->price }}">
                <button class="btn-floating waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
                </form>
              
                
                    
{{-- BTN REMOVER --}}
                <form action="{{ route('site.removecarrinho')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                <input type="hidden" name="id" value="{{$item->index }}">    
                <button class="btn-floating waves-effect waves-light red"><i class="material-icons">delete</i></button>
                </form>
              </td>
            </td>
          </tr>
          @endforeach
          
        </tbody>
      </table>
        <h5>Valor Total: {{ number_format(\Cart::getTotal(), 2, ',', '.')}} </h5>
    @endif
    

      <div class="row container center">

{{--BNT CONTINUAR COMPRANDO--}}

        
        <a href="{{route('site.index')}}" class="btn waves-effect waves-light blue"> Continuar comprando <i class="material-icons right">arrow_back</i></a>

{{-- BNT LIMPAR CARRINHO --}}

        <a href="{{route('site.limparcarrinho')}}" class="btn waves-effect waves-light blue"> Limpar o carrinho <i class="material-icons right">clear</i></a>

{{-- BNT FINALIZAR PEDIDO --}}
        <a href="{{('https://pagseguro.uol.com.br/')}}" class="btn waves-effect waves-light green"> Finalizar pedido <i class="material-icons right">check</i></a>
      </div>

    
</div>
@endsection