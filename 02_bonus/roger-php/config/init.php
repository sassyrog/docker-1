<?php

class Init {
    private $conn;
    private $servername = "mysql";
    private $username = "admin";
    private $password = "Rootroot2";

    function __construct($db) {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$db", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo $e."<br>";
            echo "Something went teribbly wrong -->";
            exit;
        }
    }

    public function getDB() {
        if ($this->conn instanceof PDO) {
            return $this->conn;
        }
    }
}

    

class General {
    function __construct() {}
    public function CheckRequest($header) {
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
            if(!$_SERVER['HTTP_X_REQUESTED_WITH']== $header){
                http_response_code(403);
                header("Location: /public/error_pages/403.php");
                exit;
            }
        } else {
            http_response_code(403);
            header("Location: /public/error_pages/");
            exit;
        }
    }
}

?>