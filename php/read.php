<?php

include_once("include/config.php");

// SQL para trazer os dados do banco de dados da tabela users
$sql = "SELECT * FROM users";
$result = $conexao->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kauã">
    <title>Read</title>
    <link rel="stylesheet" href="../css/read.css">
</head>
<body>
    
    <main>
        <div id="divTable">
            <h1>Utilizadores</h1>

            <div id="users">
                <?php
                    // Se o número de linhas for menor que 1, exibe uma mensagem
                    // Se não, exibe os dados dos utilizadores
                    if ($result->num_rows < 1) {
                        echo "<p id='mensagem'>Nenhum utilizador foi criado.</p>";
                    } else {
                        echo "
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Senha</th>
                                        <th colspan='2' style='text-align: center;'>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>";
                                    // while = enquanto
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['nome'] . "</td>";
                                            echo "<td>" . $row['username'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['senha'] . "</td>";
                                            echo "<td> <a href='edit.php?id=$row[id]' id='edit'>Editar</a> </td>";
                                            echo "<td> <a href='delete.php?id=$row[id]' id='delete'>Deletar</a> </td>";
                                        echo "</tr>";
                                    }
                            echo "</tbody>
                            </table>";  
                    }
                ?>
            </div>

            <div id="link">
                <a href="../index.html" id="voltar">Voltar</a>
            </div>
        </div>
    </main>

</body>
</html>