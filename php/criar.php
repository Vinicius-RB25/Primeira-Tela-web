<?php
$conn = new mysqli("localhost", "root", "admin", "crud");

$erro = "";

if ($_POST) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = "Preencha todos os campos!";
    } else {
        $conn->query("INSERT INTO users (nome, email, senha) VALUES ('$nome', '$email', '$senha')");
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>

    <style>
        body {
            font-family: Arial;
        }
        form {
            display: flex;
            flex-direction: column;
            width: 200px;
        }
        input, button {
            margin-bottom: 10px;
            padding: 6px;
        }
        .erro {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h2>Adicionar Usuário</h2>

<?php if ($erro != "") { ?>
    <div class="erro"><?= $erro ?></div>
<?php } ?>

<form method="POST">

    <input type="text" name="nome" placeholder="Nome">

    <input type="text" name="email" placeholder="Email">

    <input type="password" name="senha" placeholder="Senha">

    <button type="submit">Salvar</button>

</form>

</body>
</html>
