<?php

namespace Dan\Biblioteca;

class Estante {
    //array privado de itensEmprestaveis
    private array $itensEmprestaveis = [];

    public function adicionarLivro(ItemEmprestavel $itensEmprestaveis)
    {
        $this->itensEmprestaveis[] = $itensEmprestaveis;
    }
    public function removerLivro(Livro $livro){
        $this->itensEmprestaveis = array_filter(
            $this->itensEmprestaveis, 
            function($livroAtual) use ($livro){
                return $livroAtual!= $livro;
            }
        );
        $livro->marcarComoIndisponivel();
    }
    public function buscarLivroPorTitulo(string $titulo): ?ItemEmprestavel
    {
        foreach ($this->itensEmprestaveis as $livro){
            // if (strtolower($livro->getTitulo()) === 
            //strtolower($titulo)){
            //     return $livro;
            //}
            if (str_contains(strtolower($livro->getTitulo()), strtolower($titulo))){
                return $livro;
            }
        }

        return null;
    }
    public function verificarLivro(ItemEmprestavel $livro): bool {
        return in_array($livro, $this->itensEmprestaveis);
    }

    public function listaritensEmprestaveisdisponiveis(): array
    {
        return array_filter($this->itensEmprestaveis, function($livroAtual){
            return $livroAtual->estaDisponivel();
        });
    }
}