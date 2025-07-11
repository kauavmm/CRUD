<?php

session_start();

// Conectar com o banco de dados
$host = "localhost";
$user = "root";
$password = "";
$database = "crud";

$conexao = new mysqli($host, $user, $password, $database);

// Se a conexão der error
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

?>