<?php 

include_once("include/config.php");

// Receber dados do formulário
$nome = $_POST['nome'];
$username = $_POST['username'];
$email = $_POST['email'];
$senha = $_POST['senha'];

// SQL para inserir os dados
$sql = "INSERT INTO users (nome, username, email, senha) 
        VALUES ('$nome', '$username', '$email', '$senha')";
$result = $conexao->query($sql);

if ($result === TRUE) {
    // Redirecionar para o index.html
    header("Location: ../index.html");
    exit();
} else {
    if ($conexao->errno == 1062) {
        // Erro de duplicidade
        echo "Erro: O nome de usuário ou email já está em uso.";
    } else {
        // Outro erro
        echo "Erro ao inserir dados: " . $conexao->error;
    }
}

$conexao->close();

?>