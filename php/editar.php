<?php
$conn = new mysqli("localhost", "root", "admin", "crud");

$id = $_GET["id"];

$user = $conn->query("SELECT * FROM users WHERE id = $id")->fetch_assoc();

$erro = "";

if ($_POST) {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"]; 

    if (empty($nome) || empty($email)) {
        $erro = "Nome e email não podem ficar vazios.";
    } else {
        if (empty($senha)) {
            $senhaHash = $user["senha"];
        } else {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        }

        $conn->query("
            UPDATE users 
            SET nome='$nome', email='$email', senha='$senhaHash'
            WHERE id=$id
        ");

        header("Location: index.php");
        exit;
    }
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
            margin: 0;
            background: #f4f4f4;
            font-family: Arial, sans-serif;

            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            width: 320px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        input, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #005fcc;
        }

        .erro {
            color: red;
            margin-bottom: 10px;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="card">

    <h2>Editar Usuário</h2>

    <?php if ($erro != "") { ?>
        <div class="erro"><?= $erro ?></div>
    <?php } ?>

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
            placeholder="Nova senha (opcional)"
        >

        <button type="submit">Salvar</button>

    </form>

</div>

</body>
</html>
