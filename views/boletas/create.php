<!-- // Asegúrate que $productos y $clientes estén disponibles antes de cargar esta vista. -->
<h2>Registrar Boleta</h2>

<?php if (!empty($mensaje)): ?>
    <div style="color: green"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?> <?php if (!empty($error)): ?>
    <div style="color: red"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="POST" action="?controller=boleta&action=create">
    <div>
        <label for="vendedor">Vendedor:</label>
        <input type="text" name="vendedor" id="vendedor" required>
    </div>
    <div>
        <label for="cliente_id">Cliente (opcional):</label>
        <select name="cliente_id" id="cliente_id">
            <option value="">-- Seleccione --</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['id'] ?>">
                    <?= htmlspecialchars($cliente['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="tipo_pago">Tipo de pago:</label>
        <select name="tipo_pago" id="tipo_pago" required>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia</option>
            <option value="yape">Yape</option>
        </select>
    </div>

    <hr>

    <h3>Detalle de productos</h3>
    <div id="detalle-container">
        <div class="producto-row">
            <select name="productos[]" required>
                <option value="">-- Producto --</option>
                <?php foreach ($productos as $prod): ?>
                    <option value="<?= $prod['id'] ?>" data-precio="<?= $prod['precio'] ?>">
                        <?= htmlspecialchars($prod['descripcion']) ?> (S/<?= number_format($prod['precio'], 2) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="number" name="cantidades[]" min="1" placeholder="Cantidad" required>
            <!-- <span class="importe">S/ 0.00</span> -->
            S/ <input class="importe" name="importes[]" type="text" value="0.00" step="0.01" readonly>
            <button type="button" class="eliminar">🗑</button>
        </div>
    </div>

    <button type="button" id="agregar-fila">+ Agregar producto</button>

    <div>
        <strong>Total:</strong> <span id="total-boleta">S/ 0.00</span>
        <input type="hidden" name="total" id="total_input">
    </div>

    <div style="margin-top: 10px;">
        <button type="submit">Registrar boleta</button>
        <a href="?controller=boleta&action=index">Cancelar</a>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('detalle-container');
        const btnAgregar = document.getElementById('agregar-fila');
        const totalSpan = document.getElementById('total-boleta');
        const totalInput = document.getElementById('total_input');
        const calcularTotales = () => {
            let total = 0;
            container.querySelectorAll('.producto-row').forEach(row => {
                const select = row.querySelector('select');
                const cantidad = parseFloat(row.querySelector('input[type=number]').value) || 0;
                const precio = parseFloat(select.options[select.selectedIndex]?.dataset?.precio || 0);
                const importe = cantidad * precio;
                /* row.querySelector('.importe').textContent = 'S/ ' + importe.toFixed(2); */
                row.querySelector('.importe').value = importe.toFixed(2);
                total += importe;
            });
            totalSpan.textContent = 'S/ ' + total.toFixed(2);
            totalInput.value = total.toFixed(2);
        };
        container.addEventListener('input', calcularTotales);
        container.addEventListener('change', calcularTotales);
        btnAgregar.addEventListener('click', () => {
            const primeraFila = container.querySelector('.producto-row');
            const nueva = primeraFila.cloneNode(true);
            nueva.querySelector('select').selectedIndex = 0;
            nueva.querySelector('input[type=number]').value = '';
            /*nueva.querySelector('.importe').textContent = 'S/ 0.00';*/
            nueva.querySelector('.importe').value = '0.00';

            container.appendChild(nueva);
            calcularTotales();
        });
        container.addEventListener('click', e => {
            if (e.target.classList.contains('eliminar')) {
                const filas = container.querySelectorAll('.producto-row');
                if (filas.length > 1) {
                    e.target.parentElement.remove();
                    calcularTotales();
                }
            }
        });
    });
</script>