<table>
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
    <tr>
        <th colspan="4">MVC BODEGA</th>
    </tr>
    <tr>
        <th colspan="4">CALLE MIGUEL GRAU #100 - PIMENTEL</th>
    </tr>
    <tr>
        <td colspan="2">No <?= htmlspecialchars($boleta['numero']) ?></td>
        <td colspan="2">Hora: <?= htmlspecialchars($boleta['hora']) ?></td>
    </tr>
    <tr>
        <td colspan="2">Fecha: <?= htmlspecialchars($boleta['fecha']) ?></td>
        <td colspan="2">Vendedor: <?= htmlspecialchars($boleta['vendedor']) ?></td>
    </tr>
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
    <tr>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Cant</th>
        <th>Importe</th>
    </tr>
    <?php if (!empty($detalle)): ?> <?php foreach ($detalle as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['producto']) ?></td>
                <td>S/ <?= number_format($item['precio_unitario'], 2) ?></td>
                <td><?= htmlspecialchars($item['cantidad']) ?></td>
                <td>S/ <?= number_format($item['importe'], 2) ?></td>
            </tr>
        <?php endforeach ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Sin productos registrados.</td>
        </tr>
    <?php endif ?>
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
    <tr>
        <td colspan="3">Total:</td>
        <td> S/ <?= number_format($boleta['total'], 2) ?></td>
    </tr>
    <tr>
        <td colspan="3">M. Pago:</td>
        <td> <?= htmlspecialchars($boleta['tipo_pago']) ?></td>
    </tr>
    <tr>
        <td colspan="3">Cliente:</td>
        <td> <?= htmlspecialchars($boleta['cliente_id'] ?? '--') ?></td>
    </tr>
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
    <tr>
        <td colspan="4">GRACIAS POR SU PREFERENCIA</td>
    </tr>
    <tr>
        <td colspan="4">
            <hr>
        </td>
    </tr>
</table>
<br>
<div>
    <a href="?controller=boleta&action=index">← Volver al listado</a>   
</div>