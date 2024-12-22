<?php
    class Database {
        private $host = 'localhost';
        private $db_name = 'sistema_notas';
        private $username = 'root';
        private $password = 'odie@cao10';
        private $port = '3306'; // Ajuste para '3307' se usar o MySQL do XAMPP
        public $conn;

        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO(
                    "mysql:host=$this->host;port=$this->port;dbname=$this->db_name;charset=utf8",
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                echo "Erro ao conectar ao banco: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }
?>