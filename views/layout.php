<!-- views/layout.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title><?= $title ?? 'Mi Inventario' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        header,
        footer {
            background-color: #004080;
            color: white;
            padding: 10px 20px;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            background: white;
            padding: 20px;
            margin-top: 15px;
            border-radius: 5px;
            box-shadow: 0 0 8px #ccc;
        }
    </style>
</head>

<body>

    <header>
        <h1>Mi Sistema de Inventario</h1>
        <nav>
            <a href="?controller=producto&action=index">Productos</a>
            <a href="?controller=ingreso&action=index">Ingresos</a>
            <a href="?controller=boleta&action=index">Boletas</a>
            <a href="?controller=cliente&action=index">Clientes</a>
            <a href="?controller=registro&action=index">Registros</a>
        </nav>
    </header>

    <main>
        <?php
        // Aquí incluiremos el contenido específico de cada vista
        if (isset($content)) {
            echo $content;
        }
        ?>
    </main>

    <footer>
        <p>&copy; 2025 Mi Inventario - Todos los derechos reservados</p>
    </footer>

</body>

</html>