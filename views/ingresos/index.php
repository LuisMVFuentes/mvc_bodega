<h2>Historial de Ingresos</h2>
<a href='?controller=ingreso&action=create'>Agregar Productos</a>
<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Producto</th>
        <th>Cantidad</th>
    </tr> <?php foreach ($ingresos as $ing): ?> <tr>
            <td><?= $ing['id'] ?></td>
            <td><?= $ing['fecha'] ?></td>
            <td><?= htmlspecialchars($ing['productos']) ?></td>
            <td><?= $ing['cantidad_ingresada'] ?></td>
        </tr> <?php endforeach; ?>
</table>