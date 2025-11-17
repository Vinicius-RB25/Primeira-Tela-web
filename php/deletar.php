<?php
$conn = new mysqli("localhost", "root", "admin", "crud");

$id = $_GET["id"];

$conn->query("DELETE FROM users WHERE id = $id");

header("Location: index.php");
?>
