<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function carrinhoLista () {
        $itens = \Cart::getContent();
        return view('site.carrinho', compact('itens'));
    }

    public function adicionaCarrinho (Request $request) {
        \Cart::add([
            'id' => $request->request->all()['id'],
            'name' => $request->request->all()['name'],
            'price' => $request->request->all()['price'],
            'quantity' => abs($request->request->all()['qnt']),
            'attributes' => array(
                'image' => $request->request->all()['image'],
            )
        ]);

        return redirect()->route('site.carrinho')->with('sucesso', 'Produto adicionado no carrinho com sucesso!');
    }

    public function removeCarrinho(Request $request) {

        \Cart::remove($request->id);
        return redirect()->route('site.carrinho')->with('sucesso', 'Produto removido do carrinho com sucesso!');
    }

    public function atualizaCarrinho(Request $request) {

        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,
                'value' => abs($request->quantity)
            ],
        ]);
        return redirect()->route('site.carrinho')->with('sucesso', 'Carrinhoo atualizado com sucesso!');
    }

    public function continuarComprando(Request $request) {
        return redirect()->route('site.index');
    }

    public function limparCarrinho() {
        \Cart::clear();
            
        return redirect()->route('site.carrinho')->with('Carrinho vazio!');
    }
}

   /* public function finalizarPedido (Request $id) {
        return redirect()->route('https://pagseguro.uol.com.br/');
    }
}*/