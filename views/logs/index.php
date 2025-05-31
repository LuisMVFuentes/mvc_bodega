<h1>Registro de Incidencias</h1>
<br>
<table border="1" cellpadding='5' cellspacing='0'>
    <tr>
        <th>#</th>
        <th>Fecha</th>
        <th>descripcion</th>
        <th>Referencia</th>
    </tr>
    <?php
    $c = 0;
    foreach ($logs as $log):
        $c++; ?>
        <tr>
            <td><?= htmlspecialchars($c) ?></td>
            <td><?= htmlspecialchars($log['fecha']) ?></td>
            <td><?= htmlspecialchars($log['descripcion']) ?></td>
            <td><?= htmlspecialchars($log['referencia']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>