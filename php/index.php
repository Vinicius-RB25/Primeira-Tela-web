<?php
$conn = new mysqli("localhost", "root", "admin", "crud");

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <style>
        body {
            font-family: Arial;
        }
        table {
            border-collapse: collapse;
            width: 60%;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<h2>Lista de Usuários</h2>

<a href="criar.php">Adicionar Usuário</a>

<br><br>

<table>
    <tr>
        <th>Nome</th>
        <th>Email</th>
        <th>Senha</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?= $row["nome"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["senha"] ?></td>
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
                <a href="deletar.php?id=<?= $row['id'] ?>">Excluir</a>
            </td>
        </tr>

    <?php } ?>

</table>

</body>
</html>
