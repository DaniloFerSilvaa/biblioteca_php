<?php

namespace Dan\Biblioteca;

class Aluno extends Usuario{
    private const MAX_LIVROS_EMPRESTADOS = 1;

    public function podePegarEmprestado(): bool 
    {   
        $contador = count(array_filter(
            $this->livrosEmprestados,
            fn($item) => $item->getTipo() === 'Livro'
         ));
        
        if ($contador >= self::MAX_LIVROS_EMPRESTADOS) {
            return false;
        }
        
        return true;
    }
}