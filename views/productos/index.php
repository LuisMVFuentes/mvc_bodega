<div>
    <h1>Lista de Productos</h1>
    <?php if (!empty($_GET['mensaje'])): ?>
        <div style="color: green"><?= htmlspecialchars($_GET['mensaje']) ?></div>
    <?php endif; ?>
    <a href='?controller=producto&action=create'>Agregar Producto</a>
</div>
<br>
<table border='1' cellpadding='5' cellspacing='0'>
    <tr>
        <th>#</th>
        <th>Categoría</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Accion</th>
    </tr>
    <?php
    $c = 0;
    foreach ($productos as $prod): 
    $c++;?>
        <tr>
            <td><?= htmlspecialchars($c) ?></td>
            <td><?= htmlspecialchars($prod['categoria']) ?></td>
            <td><?= htmlspecialchars($prod['descripcion']) ?></td>
            <td><?= htmlspecialchars($prod['precio']) ?></td>
            <td><?= htmlspecialchars($prod['cantidad_existente']) ?></td>
            <td><a href="?controller=producto&action=edit&id=<?= $prod['id'] ?>">Editar</a>
                <a href="?controller=producto&action=delete&id=<?= $prod['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este Producto?');"> Eliminar </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>