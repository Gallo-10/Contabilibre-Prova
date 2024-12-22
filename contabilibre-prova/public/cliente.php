<?php
require_once '../src/Cliente.php';

// Cria a instância do Cliente
$cliente = new Cliente();

// Adicionar um cliente (CREATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'criar') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if ($cliente->criar($nome, $email)) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar cliente.";
    }
    echo "<br><a href='index.php'>Voltar</a>";
}

// Editar um cliente (UPDATE)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'editar') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if ($cliente->editar($id, $nome, $email)) {
        echo "Cliente editado com sucesso!";
    } else {
        echo "Erro ao editar o cliente.";
    }
    echo "<br><a href='index.php'>Voltar</a>";
}

// Excluir um cliente (DELETE)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'excluir') {
    $id = $_POST['id'];

    if ($cliente->excluir($id)) {
        echo "Cliente excluído com sucesso!";
    } else {
        echo "Erro ao excluir o cliente.";
    }
    echo "<br><a href='index.php'>Voltar</a>";
}
?>