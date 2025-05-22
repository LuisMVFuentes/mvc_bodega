<h2>Editar cliente</h2>


<?php if (!empty($mensaje)) : ?>
        <p style="color:red;"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>?controller=cliente&action=edit" method="POST">
    <div>
        <label for="nombre">Nombre completo:</label><br>
        <input type="hidden" id="id" name="id" value="<?= $cliente['id'] ?>">
        <input type="text" id="nombre" name="nombre" value="<?= $cliente['nombre'] ?>" required>
    </div>
    <div>
        <label for="telefono">Número de teléfono:</label><br>
        <input type="text" id="telefono" name="telefono" value="<?= $cliente['telefono'] ?>" required>
    </div>

    <div>
        <label for="direccion">Dirección (opcional):</label><br>
        <input type="text" id="direccion" name="direccion" value="<?= $cliente['direccion'] ?>">
    </div>

    <div style="margin-top: 10px;">
        <button type="submit">Guardar</button>
        <a href="?controller=cliente&action=index">Cancelar</a>
    </div>
</form>