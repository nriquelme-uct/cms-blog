<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <title>Blog</title>
</head>
<body class="d-flex flex-column vh-100">
    <header>
        <div class="container-fluid p-5 bg-dark text-white text-center">
            <h1>Bloggo</h1>
            <h5>El blog que no sirve.</h5>
        </div>
    </header>
    

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-3">
                <!-- Formulario para posts arrastrable -->
                <button class="btn btn-primary" id="show-create-box">Crear post</button>
                <div id="create">
                    <div id="createheader">Crear nuevo post</div>
                    <form action="code/insert.php" method="POST">
                        <input type="text" name="title" placeholder="Título" required>
                        <input type="text" name="author" placeholder="Autor" required>
                        <input type="text" name="category" placeholder="Categoría" required>
                        <textarea name="body" placeholder="Contenido" required></textarea>
                        <input type="file" name="filename">Añadir imagen</input>
                        <button type="submit" id="submit-button">Publicar</button>
                    </form>
                </div> 
            </div>
            <div class="col-sm-9">
                <h3>Posts</h3>
                <div class="container mt-3">
                    <?php
                    // list.php - Código para listar todos los posts
                    require 'code/db_config.php';

                    $sql = "SELECT * FROM posts ORDER BY created_at DESC";
                    $result = $conn->query($sql);

                    // Mostrar los posts en formato HTML o JSON
                    if ($result->num_rows > 0): ?>
                        <ul class="list-group">

                            <?php while($row = $result->fetch_assoc()): ?>
                                <div class="my-2">
                                    <li class="post">
                                        <h4><?php echo htmlspecialchars($row['title']); ?></h4>
                                        <small> Publicado en: <?php echo $row['created_at']; ?></small>
                                        <p><?php echo nl2br(htmlspecialchars($row['body'])); ?></p>

                                        <form action="code/delete.php" method="GET" onsubmit="return confirm('Esta seguro de que quiere borrar este post?');">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="btn btn-secondary" id="delete-button">Borrar</button>
                                        </form>
                                    </li>
                                </div>
                                
                            <?php endwhile; ?>
                        </ul>
                    <?php else: ?>
                            <p>No se encontraron posts.</p>
                    <?php endif; ?>

                    <?php $conn->close(); ?>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/script.js"></script>

    <footer class="footer mt-auto py-3 bg-dark text-white text-center">
        <div class="container">
        <span>Blog hecho por Kino</span>
        </div>
    </footer>
</body>

</html>


