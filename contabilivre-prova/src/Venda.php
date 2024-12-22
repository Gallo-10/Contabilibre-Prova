<?php
require_once 'database.php';

class Venda
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function criar($id_nota_fiscal, $valor)
    {
        $query = "INSERT INTO vendas (id_nota_fiscal, valor)
                    VALUES (:id_nota_fiscal, :valor)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_nota_fiscal', $id_nota_fiscal);
        $stmt->bindParam(':valor', $valor);
        return $stmt->execute();
    }
}
?>