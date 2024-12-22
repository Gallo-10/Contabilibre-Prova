<?php
require_once '../src/Nota.php';
require_once 'email.php';

$nota = new Nota();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['acao']) && $_POST['acao'] === 'criar') {
        $id_cliente = $_POST['id_cliente'];
        $numero_nota = $_POST['numero_nota'];
        $data_emissao = $_POST['data_emissao'];
        $valor = $_POST['valor'];

        // Função que pega o email do cliente do banco de dados, se utiliza-la sem configurar corretamente o código de email.php, o código não funcionará!

        // $clienteInfo = $cliente->listarPorId($id_cliente);

        // if ($clienteInfo) {
        //     $emailCliente = $clienteInfo['email'];
        //     $nomeCliente = $clienteInfo['nome'];

        //     if ($nota->criar($id_cliente, $numero_nota, $data_emissao, $valor)) {
        //         enviarEmail(
        //             $emailCliente, // E-mail do cliente
        //             $nomeCliente, // Nome do cliente
        //             'Nova Nota Fiscal',
        //             "Uma nova nota fiscal foi criada no valor de R$ {$valor}."
        //         );
        //         echo "Nota criada com sucesso!";
        //     } else {
        //         echo "Erro ao criar a nota.";
        //     }
        // } else {
        //     echo "Cliente não encontrado.";
        // }

        if ($nota->criar($id_cliente, $numero_nota, $data_emissao, $valor)) {
            enviarEmail(
                'exemplo@gmail.com', //e-mail do cliente
                'Cliente Nome',
                'Nova Nota Fiscal',
                "Uma nova nota fiscal foi criada no valor de R$ {$valor}."
            );
            echo "Nota criada com sucesso!";
        } else {
            echo "Erro ao criar a nota.";
        }
    }
}
?>