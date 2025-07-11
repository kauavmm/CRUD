<?php

include_once("include/config.php");

// Pega o ID do utilizador atraves do HREF / URL
$id = $_GET['id'];
$sqlSelect = "SELECT * FROM users WHERE id='$id'";
$resultSelect = $conexao->query($sqlSelect);

// Verifica se o utilizador existe, se existir pega os dados do utilizador e mostra no formulário através do VALUE do input
if ($resultSelect->num_rows > 0) {
    $user_data = mysqli_fetch_assoc($resultSelect);
    $user_id = $user_data['id'];
    $user_nome = $user_data['nome'];
    $user_username = $user_data['username'];
    $user_email = $user_data['email'];
    $user_senha = $user_data['senha'];
}

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kauã">
    <title>Editar</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
    
    <main id="container">
        <form action="update.php" method="post">
            <div id="form-header">
                <h1>Editar Utilizador</h1>
            </div>

            <div id="form-main">
                <div class="inputs-box">
                    <label for="id">ID</label>
                    <input type="text" name="id" id="id" value="<?php echo $user_id ?>" readonly>
                </div>
                <div class="inputs-box">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" value="<?php echo $user_nome ?>" required>
                </div>
                <div class="inputs-box">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo $user_username ?>" required>
                </div>
                <div class="inputs-box">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $user_email ?>" required>
                </div>
                <div class="inputs-box">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" value="<?php echo $user_senha ?>" required>
                </div>
            </div>

            <div id="form-footer">
                <button type="submit">Editar</button>

                <div style="margin-top: 20px;">
                    <a href="../index.html" id="voltar">Voltar</a>
                </div>
            </div>
        </form>
    </main>

</body>
</html>