<?php

namespace App;

class Cart
{
    public $items; //armazena os livros num array em que a chave é o id do livro
    public $totalQty = 0; //numero de livros na encomenda
    public $totalPrice = 0; //preço da compra

   
    //adicionar o livro ao array
    public function add($item, $id)
    {
        $storedItem = ['price' => $item->price, 'item' => $item];

        if ($this->items) { //se o cart tiver livros
            if (array_key_exists($id, $this->items)) { //verifica se já tem o livro no carrinho, evita adicionar o mesmo livro multiplas vezes
                return;
            }

        }
        $this->items[$id] = $storedItem; //adiciona o item na chave com o id do livro
        $this->totalQty++;
        $this->totalPrice += $item->price;

    }
}
