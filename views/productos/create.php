<?php
// views/producto/create.php

/* ob_start(); */
?>

<h1>Agregar Producto</h1>

<?php if (!empty($mensaje)): ?>
    <p style="color:green;"><?= htmlspecialchars($mensaje) ?></p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color:red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="?controller=producto&action=create">
    <label>Categoría:</label> <select name="categoria">
        <option selected disabled> -- </option>
        <?php foreach ($categorias as $cat): ?>
            <option value="<?= htmlspecialchars($cat['categoria']) ?>"> <?= htmlspecialchars($cat['categoria']) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <label for="nueva_categoria">O escribe una nueva categoría:</label>
    <input type="text" name="nueva_categoria" id="nueva_categoria" placeholder="Ej: Lácteos"><br><br>
    <label>Descripción:</label><br>
    <textarea name="descripcion" required><?= htmlspecialchars($descripcion ?? '') ?></textarea><br><br>

    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($precio ?? '') ?>" required><br><br>

    <label>Cantidad existente:</label><br>
    <input type="number" name="cantidad_existente" value="<?= htmlspecialchars($cantidad_existente ?? '') ?>" required><br><br>

    <button type="submit">Guardar</button>
</form>

<br>
<a href='?controller=producto&action=index'>Volver a lista</a>

<?php
/* $content = ob_get_clean();
$title = "Agregar Producto";

require_once '../views/layout.php'; */
