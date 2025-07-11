<?php

include_once("include/config.php");

// Pega os dados do formulário através do método POST
$id = $_POST['id'];
$nome = $_POST['nome'];
$username = $_POST['username'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sqlUpdate = "UPDATE users SET nome='$nome', username='$username', email='$email', senha='$senha' WHERE id='$id'";
$resultUpdate = $conexao->query($sqlUpdate);

// Verifica se a atualização foi bem-sucedida
if ($resultUpdate === TRUE) {
    // Redireciona para a página que mostra os utilizadores
    header("Location: read.php");
} else {
    echo "Erro ao atualizar o utilizador: " . $conexao->error;
}

?>