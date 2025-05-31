<table cellpadding='5' cellspacing='0'>
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
        <td colspan="2"><b>N° <?= htmlspecialchars($boleta['numero']) ?></b></td>
        <?php
        [$fecha, $hora] = explode(' ', $boleta['fecha']);;
        ?>
        <td colspan="2"><b>Vendedor: <?= htmlspecialchars($boleta['vendedor']) ?></b></td>
    </tr>
    <tr>
        <td colspan="2">Fecha: <?= htmlspecialchars($fecha) ?></td>
        <td colspan="2">Hora: <?= htmlspecialchars($hora) ?></td>
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
                <td>S/ <?= number_format($item['precio'], 2) ?></td>
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
        <th colspan="3">Total:</th>
        <th> S/ <?= number_format($boleta['total'], 2) ?></th>
    </tr>
    <tr>
        <th colspan="3">M. Pago:</th>
        <th> <?= htmlspecialchars($boleta['tipo_pago']) ?></th>
    </tr>
    <tr>
        <th colspan="3">Cliente:</th>
        <th> <?= htmlspecialchars($boleta['cliente'] ?? '--') ?></th>
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