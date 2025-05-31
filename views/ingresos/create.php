<h2>Registrar Ingreso</h2>
<?php if ($mensaje): ?>
    <p style="color:green;"><?= $mensaje ?></p>
<?php elseif ($error): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>
<form method="POST">
    <label>Producto:</label>
    <select name="producto_id" required>
        <?php foreach ($productos as $p): ?>
            <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['descripcion']) ?></option>
        <?php endforeach; ?>
    </select><br>
    <label>Cantidad:</label>
    <input type="number" name="cantidad" required><br>
    <label>Fecha:</label>
    <input type="datetime-local" name="fecha" value="<?= date('Y-m-d\TH:i:s') ?>" required><br>
    <button type="submit">Registrar</button>
</form>