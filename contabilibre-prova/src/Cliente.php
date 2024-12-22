<?php
    require_once 'database.php';

    class Cliente {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function listar() {
        $query = "SELECT * FROM clientes";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarPorId($id_cliente) {
        $query = "SELECT nome, email FROM clientes WHERE id = :id_cliente";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($nome, $email) {
        $query = "INSERT INTO clientes (nome, email) VALUES (:nome, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function editar($id, $nome, $email) {
        $query = "UPDATE clientes SET nome = :nome, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        return $stmt->execute();
    }

    public function excluir($id) {
        $query = "DELETE FROM clientes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function listarNotasDetalhadas($id_cliente) {
        $query = "SELECT nf.id AS id_nota, c.nome, c.email, nf.valor AS valor_nota, nf.data_emissao
                  FROM notas_fiscais nf
                  INNER JOIN clientes c ON nf.id_cliente = c.id
                  WHERE nf.id_cliente = :id_cliente";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        $notas = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $query_total = "SELECT SUM(valor) AS total FROM notas_fiscais WHERE id_cliente = :id_cliente";
        $stmt_total = $this->conn->prepare($query_total);
        $stmt_total->bindParam(':id_cliente', $id_cliente);
        $stmt_total->execute();
        $total = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];
    
        return ['notas' => $notas, 'total' => $total];
    }
    }
?>
