<?php
//Refatorar

namespace Dan\Biblioteca;

//Pega emprestado, Adiciona livro, Remove livro, Lista livros emprestados
abstract class Usuario
{
    protected string $nome;
    protected string $tipo;
    protected array $livrosEmprestados = [];

    public function __construct(string $nome, string $tipo = 'visitante')
    {
        $this->nome = $nome;
        $this->tipo = $tipo;
    }

    public function getNome(): string {
        return $this->nome;
    }
    
    //Função abstrada para definir na classe filho
    abstract function podePegarEmprestado(): bool;

    
    public function adicionarLivroEmprestado(ItemEmprestavel $livro): void 
    {
        if (!$this->podePegarEmprestado()) {
            throw new \Exception("Limite de livros emprestados atingido para {$this->tipo}");
        }
        if (!$livro->estaDisponivel()){
            throw new \Exception('Livro' . $livro->getTitulo() . ' não está disponivel para emprestimo');
        }
        
        $this->livrosEmprestados[] = $livro;

    }
    //refatorar
    public function removerLivroEmprestado(ItemEmprestavel $livro): void
    {
        $this->livrosEmprestados = array_filter(
            $this->livrosEmprestados, 
            fn($livroAtual) => $livroAtual !== $livro
        );
        $livro->adicionarQuantidade();
    }

    public function listarLivrosEmprestados(): array
    {
        return $this->livrosEmprestados;
    }
}