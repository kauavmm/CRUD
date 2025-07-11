<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kauã">
    <title>Form</title>
    <link rel="stylesheet" href="../css/form.css">
</head>
<body>
    
    <main id="container">
        <form action="create.php" method="post">
            <div id="form-header">
                <h1>Criar Utilizador</h1>
            </div>

            <div id="form-main">
                <div class="inputs-box">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" required>
                </div>
                <div class="inputs-box">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="inputs-box">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required>
                </div>
                <div class="inputs-box">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" id="senha" required>
                </div>
            </div>

            <div id="form-footer">
                <button type="submit">Criar</button>

                <div style="margin-top: 20px;">
                    <a href="../index.html" id="voltar">Voltar</a>
                </div>
            </div>
        </form>
    </main>

</body>
</html>