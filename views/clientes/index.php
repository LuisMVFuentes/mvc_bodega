<?php if (!empty($_GET['mensaje'])): ?>
    <div style="color: green"><?= htmlspecialchars($_GET['mensaje']) ?></div>
<?php endif; ?>

<h1>Lista de Clientes</h1>
<a href='?controller=cliente&action=create'>Agregar Cliente</a>
<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Accion</th>
    </tr>
    <?php foreach ($clientes as $cli): ?>
        <tr>
            <td><?= htmlspecialchars($cli['id']) ?></td>
            <td><?= htmlspecialchars($cli['nombre']) ?></td>
            <td><?= htmlspecialchars($cli['telefono']) ?></td>
            <td><?= htmlspecialchars($cli['direccion']) ?></td>
            <td> <a href="?controller=cliente&action=edit&id=<?= $cli['id'] ?>">Editar</a>
                <a href="?controller=cliente&action=delete&id=<?= $cli['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?');"> Eliminar </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<?php
/* $content = ob_get_clean();
$title = "Lista de Clientes";

require_once  '../views/layout.php'; */
