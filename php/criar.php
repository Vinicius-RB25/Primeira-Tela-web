<?php
$conn = new mysqli("localhost", "root", "admin", "crud"); 

$erro = ""; 

if ($_POST) { 
    $nome = $_POST["nome"]; 
    $email = $_POST["email"]; 
    $senha = $_POST["senha"]; 

    if (empty($nome) || empty($email) || empty($senha)) { 
        $erro = "Preencha todos os campos!";
     } 
    else {
        $senhaSegura = password_hash($senha, PASSWORD_DEFAULT);

        $query = $conn->query("INSERT INTO users (nome, email, senha) VALUES ('$nome', '$email', '$senhaSegura')");

        header("Location: login.php"); 
        exit; 
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

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
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            background: #1e7e34;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
        }

        .erro {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="card">

    <h2>Criar Conta</h2>

    <?php if ($erro != "") { ?> 
        <div class="erro"><?= $erro ?></div>
    <?php } ?>

    <form method="POST"> 

        <input type="text" name="nome" placeholder="Nome"> 

        <input type="text" name="email" placeholder="Email"> 

        <input type="password" name="senha" placeholder="Senha"> 

        <button type="submit">Cadastrar</button> 

    </form>
    <a href="login.php">Voltar para o Login</a> 

</div>

</body>
</html>
