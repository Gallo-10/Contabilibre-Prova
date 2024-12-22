<?php
require_once 'database.php';

class Nota
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function criar($id_cliente, $numero_nota, $data_emissao, $valor)
    {
        try {
            echo "Iniciando inserção...<br>";

            $query = "SELECT COUNT(*) FROM clientes WHERE id = :id_cliente";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id_cliente', $id_cliente);
            $stmt->execute();
            if ($stmt->fetchColumn() == 0) {
                echo "Cliente não encontrado!";
                return false;
            }

            try {
                $query = "INSERT INTO notas_fiscais (id_cliente, numero_nota, data_emissao, valor)
                          VALUES (:id_cliente, :numero_nota, :data_emissao, :valor)";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id_cliente', $id_cliente);
                $stmt->bindParam(':numero_nota', $numero_nota);
                $stmt->bindParam(':data_emissao', $data_emissao);
                $stmt->bindParam(':valor', $valor);
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo "Erro ao inserir nota fiscal: " . $e->getMessage();
                return false;
            }

            if ($stmt->execute()) {
                echo "Inserção bem-sucedida!<br>";
                return $this->conn->lastInsertId();
            } else {
                echo "Erro ao executar a query:<br>";
                print_r($stmt->errorInfo());
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro no banco de dados: " . $e->getMessage();
            return false;
        }
    }

}
?>