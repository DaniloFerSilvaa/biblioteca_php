<?php

namespace Dan\Biblioteca;

interface ItemEmprestavel 
{
    public function marcarComoIndisponivel():void; 
    public function marcarComoDisponivel():void;
    public function estaDisponivel(): bool;
    public function adicionarQuantidade(int $quantidade = 1):void;
    public function removerQuantidade(int $quantidade = 1) :void;
    //METODOS Getters
    public function getTitulo():string;
    public function getAutor():string;
    public function getQuantidade(): int;
    public function getTipo(): string;
}

class Livro implements ItemEmprestavel {

    //Propriedades Privadas
    private string $titulo;
    private string $autor;
    private string $tipo = 'Livro';
    private bool $disponivel = false;
    private int $quantidade = 1;

    //Construtor de Classe
    public function __construct(string $autor, string $titulo,) {
        $this->titulo = $titulo;
        $this->autor = $autor;
    }

    //METODOS de ação
    public function marcarComoIndisponivel():void {
        $this->disponivel = false;
    }
    public function marcarComoDisponivel():void {
        $this->disponivel = true;
    }
    
    //METODOS de negocio
    public function estaDisponivel(): bool {
        return $this->disponivel;
    }
    public function adicionarQuantidade(int $quantidade = 1):void{
        if ($quantidade <= 0) {
            throw new \Exception("Você não pode adicionar uma quantidade negativa ou zero.");
        }
        
        $this->quantidade += $quantidade;
    
        if ($this->quantidade > 0) {
            $this->marcarComoDisponivel();
        }
    }
    public function removerQuantidade(int $quantidade = 1):void 
    {
        if ($quantidade <= 0) {
            throw new \Exception('Você não pode remover uma quantidade negativa ou zero.');
        }
        if ($quantidade > $this->quantidade = 1) {
            throw new \Exception(('Quantidade maior que a quantidade disponivel'));
        }

        $this->quantidade -= $quantidade;

        if ($this->quantidade <= 0) {
            $this->marcarComoIndisponivel();
        }
    }
    //METODOS Getters
    public function getTitulo():string {
        return $this->titulo;
    }
    public function getAutor():string {
        return $this->autor;
    }
    public function getQuantidade(): int {
        return $this->quantidade;
    }
        public function getTipo(): string {
        return $this->tipo;
    }
}