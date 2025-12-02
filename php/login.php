<?php
session_start(); 
$conn = new mysqli("localhost", "root", "admin", "crud"); 

$erro = ""; 

if ($_POST) { 
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    if (empty($email) || empty($senha)) { 
        $erro = "Preencha todos os campos.";
    } 
    else {
        $query = $conn->query("SELECT * FROM users WHERE email='$email'"); 

        if ($query->num_rows > 0) { 
            $user = $query->fetch_assoc(); 

            if (password_verify($senha, $user["senha"])) { 
                $_SESSION["logado"] = true; 
                $_SESSION["usuario"] = $user["nome"];

                header("Location: index.php"); 
                exit; 
            } 
            else {
                $erro = "Senha incorreta."; 
            }
        } 
        else {
            $erro = "Usuário não encontrado."; 
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            width: 280px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input, button {
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        button {
            background: #007BFF;
            border: none;
            cursor: pointer;
            color: white;
            transition: 0.2s;
        }

        button:hover {
            background: #005fcc;
        }

        .erro {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>

<div class="card">
    
    <h2>Login</h2>

    <?php 
    if ($erro != "") { ?> 
        <div class="erro"><?= $erro ?></div>
    <?php } 
    ?>

    <form method="POST"> 
        <input type="text" name="email" placeholder="Email"> 

        <input type="password" name="senha" placeholder="Senha"> 

        <button type="submit">Entrar</button> 
    </form>

    <a href="criar.php">Criar conta</a> 

</div>

</body>
</html>
