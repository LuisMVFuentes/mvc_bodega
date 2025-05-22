<div>
    <h1>Lista de Boletas</h1>
    <a href='?controller=boleta&action=create'>Agregar Boleta</a>
</div><br>

<?php if (!empty($_GET['mensaje'])): ?>
    <div style="color: green"><?= htmlspecialchars($_GET['mensaje']) ?></div>
<?php endif; ?>

<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <!--  -->
        <th>id</th>
        <th>#</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Vendedor</th>
        <th>Cliente</th>
        <th>M:Pago</th>
        <th>Total</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($boletas as $bol): ?>
        <tr>
            <td><?= htmlspecialchars($bol['id']) ?></td>
            <td><?= htmlspecialchars($bol['numero_boleta']) ?></td>
            <td><?= htmlspecialchars($bol['fecha']) ?></td>
            <td><?= htmlspecialchars($bol['hora']) ?></td>
            <td><?= htmlspecialchars($bol['vendedor']) ?></td>
            <td><?= htmlspecialchars($bol['cliente']) ?></td>
            <td><?= htmlspecialchars($bol['tipo_pago']) ?></td>
            <td><?= htmlspecialchars($bol['total']) ?></td>

            <td> <a href="?controller=boleta&action=edit&id=<?= $bol['id'] ?>">Editar</a>
                <a href="?controller=boleta&action=delete&id=<?= $bol['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este boleta?');"> Eliminar </a>
                <a href="?controller=boleta&action=show&id=<?= $bol['id'] ?>">Ver</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>