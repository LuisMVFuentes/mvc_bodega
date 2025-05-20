<?php
// views/producto/index.php

/* ob_start(); */
?>
<h1>Lista de Productos</h1>
<a href='?controller=producto&action=create'>Agregar Producto</a>
<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <th>ID</th>
        <th>Categoría</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Cantidad</th>
    </tr>
    <?php foreach ($productos as $prod): ?>
        <tr>
            <td><?= htmlspecialchars($prod['id']) ?></td>
            <td><?= htmlspecialchars($prod['categoria']) ?></td>
            <td><?= htmlspecialchars($prod['descripcion']) ?></td>
            <td><?= htmlspecialchars($prod['precio']) ?></td>
            <td><?= htmlspecialchars($prod['cantidad_existente']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
/* $content = ob_get_clean();
$title = "Lista de Productos";

require_once  '../views/layout.php'; */
