<?php
// delete.php - Código para eliminar un post
require_once 'db_config.php';
// Consulta para obtener los posts
$query = mysqli_query($conn, "SELECT * FROM posts ORDER BY created_at DESC");

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "DELETE FROM posts WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php");
} else {
    echo "Error al eliminar: " . $conn->error;
}

?>