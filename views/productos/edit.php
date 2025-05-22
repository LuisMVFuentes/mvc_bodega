<h1>Editar Producto</h1>

<?php if (!empty($mensaje)) : ?>
    <p style="color:green;"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="?controller=producto&action=edit">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
    <label>Categoría:</label><br>
    <select name="categoria">
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= htmlspecialchars($cat['categoria']) ?>"
                <?php if ($cat['categoria'] === $producto['categoria']): ?>
                selected
                <?php endif; ?>> <?= htmlspecialchars($cat['categoria']) ?></option>
        <?php endforeach; ?>
        <!-- <option value="nueva">Nueva Categoría</option> -->
    </select><br><br>
    <label>Descripción:</label><br>
    <textarea name="descripcion" required><?= $producto['descripcion'] ?></textarea><br><br>

    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" value="<?= $producto['precio'] ?>" required><br><br>

    <label>Cantidad existente:</label><br>
    <input type="number" name="cantidad_existente" value="<?= $producto['cantidad_existente'] ?>" required><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href='?controller=producto&action=index'>Volver a lista</a>