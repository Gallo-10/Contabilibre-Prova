<?php
    require_once '../src/Nota.php';

    $nota = new Nota();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'criar') {
        try {
            $id_cliente = $_POST['id_cliente'];
            $numero_nota = $_POST['numero_nota'];
            $data_emissao = $_POST['data_emissao'];
            $valor = $_POST['valor'];

            $id_nota = $nota->criar($id_cliente, $numero_nota, $data_emissao, $valor);

            if ($id_nota) {
                echo "Nota fiscal criada com sucesso! ID: $id_nota";
            } else {
                echo "Erro ao criar a nota fiscal.";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

?>