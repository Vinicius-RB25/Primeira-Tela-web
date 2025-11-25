<?php
$conn = new mysqli("localhost", "root", "admin", "crud");

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>

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
            width: 80%;
            max-width: 900px;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        .btn-add {
            display: inline-block;
            padding: 10px 15px;
            background: #007BFF;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: 0.2s;
        }

        .btn-add:hover {
            background: #005fcc;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: left;
        }

        th {
            background: #007BFF;
            color: white;
            padding: 10px;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="card">

    <h2>Lista de Usuários</h2>

    <a class="btn-add" href="criar.php">+ Adicionar Usuário</a>

    <table>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Senha (hash)</th>
            <th>Ações</th>
        </tr>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <tr>
                <td><?= $row["nome"] ?></td>
                <td><?= $row["email"] ?></td>
                <td><?= substr($row["senha"], 0, 10) . "..." ?></td>

                <td>
                    <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
                    <a href="deletar.php?id=<?= $row['id'] ?>">Excluir</a>
                </td>
            </tr>

        <?php } ?>
    </table>

</div>

</body>
</html>
