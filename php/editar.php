<?php
$conn = new mysqli("localhost", "root", "admin", "crud");

$id = $_GET["id"];

$user = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();

if ($_POST) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $conn->query("UPDATE users SET nome='$nome', email='$email', senha='$senha' WHERE id=$id");

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>

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
    </style>
</head>
<body>

<h2>Editar Usuário</h2>

<form method="POST">

    <input 
        type="text" 
        name="nome" 
        placeholder="Nome" 
        value="<?= $user['nome'] ?>"
    >

    <input 
        type="text" 
        name="email" 
        placeholder="Email" 
        value="<?= $user['email'] ?>"
    >

    <input 
        type="password" 
        name="senha" 
        placeholder="Senha" 
        value="<?= $user['senha'] ?>"
    >

    <button type="submit">Salvar</button>

</form>

</body>
</html>
