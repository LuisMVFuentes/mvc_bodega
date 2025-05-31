<h2>Historial de Ingresos</h2>
<a href='?controller=ingreso&action=create'>Agregar Productos</a>
<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <th>#</th>
        <th>Fecha</th>
        <th>Producto</th>
        <th>Cantidad</th>
    </tr> <?php
            $c = 1;
            foreach ($ingresos as $ing): ?> <tr>
            <td><?= $c++ ?></td>
            <td><?= $ing['fecha'] ?></td>
            <td><?= htmlspecialchars($ing['productos']) ?></td>
            <td><?= $ing['cantidad_ingresada'] ?></td>
        </tr> <?php endforeach; ?>
</table>