<?php
  require_once '../src/Cliente.php';

  if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    $cliente = new Cliente();
    $resultado = $cliente->listarNotasDetalhadas($id_cliente);

    echo "<h1>Notas do Cliente</h1>";
    echo "<table border='1'>";
    echo "<tr>
            <th>ID Nota</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Valor da Nota</th>
            <th>Data de Emissão</th>
          </tr>";
    foreach ($resultado['notas'] as $nota) {
        echo "<tr>
                <td>{$nota['id_nota']}</td>
                <td>{$nota['nome']}</td>
                <td>{$nota['email']}</td>
                <td>R$ {$nota['valor_nota']}</td>
                <td>{$nota['data_emissao']}</td>
              </tr>";
    }
    echo "</table>";
    echo "<h2>Valor Total das Notas: R$ {$resultado['total']}</h2>";
    echo "<br><a href='index.php'>Voltar</a>";
  }
?>