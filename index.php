<?php

require_once 'vendor/autoload.php';

use Dan\Biblioteca\Livro;
use Dan\Biblioteca\Estante;
use Dan\Biblioteca\Aluno;
use Dan\Biblioteca\Professor;

echo 'Sistema de biblioteca iniciado!<br>';

// Criando livros e estante
$livros = [
    new Livro('Dan', 'Titulo1111111'),
    new Livro('João', 'Titulo2222222'),
    new Livro('Maria', 'Titulo333333'),
    new Livro('Matias', 'Titulo4444'),
    new Livro('Lucia', 'Titulo555555'),
];

$livros[0]->adicionarQuantidade();
$livros[1]->adicionarQuantidade(3);
$livros[2]->adicionarQuantidade(4);
$livros[3]->adicionarQuantidade(5);

//criando estante
$estante = new Estante();

//adicionando livros a estante
foreach ($livros as $livro){
    $estante->adicionarLivro($livro);
}

echo '<h2>Mostrando estante</h2><br>';
echo '<pre>';
print_r($estante);
echo '<hr>';
$estante ->removerLivro($livros[0]);
print_r($estante);
echo '<br><hr><br>';

$aluno1 = new Aluno('Aluno Ione', 'Aluno');
$aluno2 = new Aluno('Aluno Yasuo', 'Aluno');
$professor = new Professor('Professor Master YI', 'Professor');

$aluno1->adicionarLivroEmprestado($livros[2]);
try {
    $aluno2->adicionarLivroEmprestado($livros[0]);
} catch (\Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
$professor->adicionarLivroEmprestado($livros[3]);

echo '</pre>';
var_dump($aluno1->podePegarEmprestado());
echo '<br>';
var_dump($aluno2->podePegarEmprestado());
echo '<br>';
var_dump($professor->podePegarEmprestado());

