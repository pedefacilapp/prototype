<?php
class Conexao {
    var $pdo;
    function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=pedefacil_db', 'root', 'p3d3f4c1l@db');
    }
    /* FUNÇÕES DE LOGIN */
    public function select($usuario, $senha) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_users WHERE usuario = '$usuario' AND senha = '$senha'");
        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':senha', $senha);
        $run = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function validarUsuario($usuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_users WHERE usuario = '$usuario'");
        $stmt->bindValue(':usuario', $usuario);
        $run = $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function cadastrarUsuario($usuario, $senha, $email){
        $stmt = $this->pdo->prepare("INSERT INTO tbl_users (usuario, senha, email, data) VALUES ('$usuario', '$senha', '$email', NOW())");
        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':senha', $senha);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
    }
    
}