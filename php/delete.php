<?php

include_once("include/config.php");

// Pega o ID do utilizador através do HREF / URL
$user_id = $_GET['id'];

// SQL para selecionar o utilizador
$sqlSelect = "SELECT * FROM users WHERE id='$user_id'";
$resultSelect = $conexao->query($sqlSelect);

// Verifica se o utilizador existe
if ($resultSelect->num_rows > 0) {
    // SQL para deletar o utilizador
    $sqlDelete = "DELETE FROM users WHERE id='$user_id'";
    $resultDelete = $conexao->query($sqlDelete);
}

// Redireciona para a página dos utilizadores
header("Location: read.php");

?>