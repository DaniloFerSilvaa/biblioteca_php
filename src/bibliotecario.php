<?php

namespace Dan\Biblioteca;

class bibliotecario {
    public static function emprestarLivro(Usuario $usuario, ItemEmprestavel $livro, Estante $estante): bool {
        if (!$livro->estaDisponivel()) {
            throw new \Exception("Livro não está disponivel"); 
        }
        if ($livro->getTipo() === 'Livro' && !$usuario->podePegarEmprestado()) {
            throw new \Exception("usuario não pode pegar emprestado");
        }
        if (!$estante->verificarLivro($livro)) {
            throw new \Exception("não existe livro na estante");
        }

        $livro->removerQuantidade();

        $usuario->adicionarLivroEmprestado($livro);
        $estante->removerLivro($livro);

        return true;
    }

    public static function devolverLivro(Usuario $usuario, ItemEmprestavel $livro, Estante $estante): bool {
        
        if (!in_array($livro, $usuario->listarLivrosEmprestados())) {
            throw new \Exception("Livro não está com o usuario");
        }
        
        if ($estante->verificarLivro($livro)) {
            $usuario->removerLivroEmprestado($livro);
            $livro->adicionarQuantidade();
            return true;
        }
        
        $usuario->removerLivroEmprestado($livro);
        $estante->adicionarLivro($livro);
        $livro->adicionarQuantidade();
        $livro->marcarComoDisponivel();

        return true;
    }
}