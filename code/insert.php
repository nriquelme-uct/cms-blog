<?php
require 'db_config.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanear datos
        $title    = $conn->real_escape_string($_POST['title']);
        $body     = $conn->real_escape_string($_POST['body']);
        $author   = $conn->real_escape_string($_POST['author']);
        $category = $conn->real_escape_string($_POST['category']);
        $imagePath = NULL;

        // Proceso de subida de imagen
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../assets/uploads/';
            
            // Crear directorio si no existe
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            // Generar nombre único
            $fileName = uniqid() . '_' . basename($_FILES['image']['name']);
            $uploadFile = $uploadDir . $fileName;
            
            // Mover archivo
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imagePath = $uploadFile;
            }
        }

        // Insertar
        $sql = "INSERT INTO posts (title, body, author, category, image) VALUES ('$title', '$body', '$author', '$category', "
            . ($imagePath ? "'$imagePath'" : 'NULL') . ")";
        if (mysqli_query($conn, $sql) === TRUE) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        $conn->close();
    }
?>