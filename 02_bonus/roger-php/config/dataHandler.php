<?php

class DataHandler {
  public $conn;

  function __construct($conn) {
    $this->conn = $conn;
  }

  public function CheckUserExists($username, $email) {
    $stmt = $this->conn->prepare("SELECT  `Username`
                                  FROM    `Users`
                                  WHERE   `Username` = :username
                                  AND     `Deleted` = 0");
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(empty($res)) {
      $stmt = $this->conn->prepare("SELECT  `Email`
                                    FROM    `Users`
                                    WHERE   `Email` = :email
                                    AND     `Deleted` = 0");
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->execute();
      $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return empty($res) ? key($res) : key($res[0]);
  }
  
  public function ValidateLogin($email, $password) {
    $stmt = $this->conn->prepare("SELECT  `Email`,
                                          `Password`,
                                          `Role`
                                  FROM    `Users`
                                  WHERE   `Email` = :email
                                  AND     `Deleted` = 0");
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $res = $stmt->fetch();
    if ($res) {
      $passwordMatch = password_verify($password, $res["Password"]);
      return ($passwordMatch) ? $res : [];
    }
    return [];
  }

  public function RegisterUser($firstname, $lastname, $username, $email, $password) {
    $options = [
      'cost' => 12,
    ];
    $hash = password_hash($password, PASSWORD_BCRYPT, $options);
    $stmt = $this->conn->prepare("INSERT INTO `Users` (`Firstname`,
                                                      `Lastname`,
                                                      `Username`,
                                                      `Email`,
                                                      `Password`)
                                  VALUES (?,?,?,?,?)");
    $stmt->execute([$firstname, $lastname, $username,$email, $hash]);
    return $stmt->rowCount();
  }
}
?>