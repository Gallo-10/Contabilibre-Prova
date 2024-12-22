<?php
require_once '../src/Cliente.php';
require_once '../src/Nota.php';
$cliente = new Cliente();
$clientes = $cliente->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Notas</title>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <ul>
        <?php if (!empty($clientes)): ?>
            <?php foreach ($clientes as $c): ?>
                <li>
                    <?php echo $c['nome'] . " (" . $c['email'] . ")"; ?>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum cliente cadastrado.</p>
        <?php endif; ?>
    </ul>

    <h1>Editar Clientes</h1>
    <ul>
        <?php if (!empty($clientes)): ?>
            <?php foreach ($clientes as $c): ?>
                <li>
                    <?php echo $c['nome'] . " (" . $c['email'] . ")"; ?>
                    <!-- Formulário para editar -->
                    <form method="POST" action="cliente.php" style="display: inline;">
                        <input type="hidden" name="acao" value="editar">
                        <input type="hidden" name="id" value="<?= $c['id']; ?>">
                        <input type="text" name="nome" value="<?= $c['nome']; ?>" required>
                        <input type="email" name="email" value="<?= $c['email']; ?>" required>
                        <button type="submit">Salvar Alterações</button>
                    </form>

                    <!-- Formulário para excluir -->
                    <form method="POST" action="cliente.php" style="display: inline;">
                        <input type="hidden" name="acao" value="excluir">
                        <input type="hidden" name="id" value="<?= $c['id']; ?>">
                        <button type="submit" style="background-color: red; color: white;">Excluir</button>
                    </form>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Nenhum cliente disponível para edição.</p>
        <?php endif; ?>
    </ul>

    <!-- Formulário para adicionar novo cliente -->
    <h2>Adicionar Novo Cliente</h2>
    <form method="POST" action="cliente.php">
        <input type="hidden" name="acao" value="criar">
        <input type="text" name="nome" placeholder="Nome do cliente" required>
        <input type="email" name="email" placeholder="E-mail do cliente" required>
        <button type="submit">Adicionar Cliente</button>
    </form>

    <h2>Adicionar Venda e Nota Fiscal</h2>
    <form method="POST" action="nota.php">
        <input type="hidden" name="acao" value="criar">
        <select name="id_cliente" required>
            <option value="" disabled selected>Selecione o Cliente</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['id']; ?>"><?= $c['nome']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="number" name="valor" placeholder="Valor da Venda" step="0.01" required>
        <input type="text" name="numero_nota" placeholder="Número da Nota" required>
        <input type="date" name="data_emissao" required>
        <button type="submit">Adicionar</button>
    </form>

    <h2>Listar Notas de um Cliente</h2>
    <form method="GET" action="notas_cliente.php">
        <select name="id_cliente" required>
            <option value="" disabled selected>Selecione o Cliente</option>
            <?php foreach ($clientes as $c): ?>
                <option value="<?= $c['id']; ?>"><?= $c['nome']; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Listar Notas</button>
    </form>

    <!-- Adicionado para depuração -->
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "<pre>";
            var_dump($_POST);
            echo "</pre>";
        }
    ?>
</body>
</html>
