<?php
// views/cliente/index.php

/* ob_start(); */
?>
<h1>Lista de Clientes</h1>
<a href='?controller=cliente&action=create'>Agregar Cliente</a>
<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Direccion</th>
    </tr>
    <?php foreach ($clientes as $cli): ?>
        <tr>
            <td><?= htmlspecialchars($cli['id']) ?></td>
            <td><?= htmlspecialchars($cli['nombre']) ?></td>
            <td><?= htmlspecialchars($cli['telefono']) ?></td>
            <td><?= htmlspecialchars($cli['direccion']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
/* $content = ob_get_clean();
$title = "Lista de Clientes";

require_once  '../views/layout.php'; */
