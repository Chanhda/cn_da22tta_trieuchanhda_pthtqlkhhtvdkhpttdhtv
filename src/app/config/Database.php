<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "ql_kehoachhoctap"; // Tên CSDL bạn đã tạo
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            // Sử dụng MySQLi để kết nối
            $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
            
            // Thiết lập font chữ tiếng Việt
            $this->conn->set_charset("utf8mb4");

            if ($this->conn->connect_error) {
                die("Kết nối thất bại: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Lỗi kết nối: " . $e->getMessage();
        }
        return $this->conn;
    }
}
?>