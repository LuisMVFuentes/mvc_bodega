<?php

require_once BASE_PATH . '/models/BaseModel.php';

class boleta extends BaseModel
{
    public $numero;
    public $fecha;
    public $vendedor;
    public $cliente_id; /* (opcional) */
    public $tipo_pago;
    public $total;
    public $DetalleBoleta = [['producto_id' => '', 'cantidad' => '', 'importe' => 0.0]];

    public function getAll()
    {
        $query = "SELECT b.id, b.numero_boleta, b.fecha, b.vendedor, c.nombre AS `cliente`, b.tipo_pago, b.total FROM `boletas` b LEFT JOIN `clientes` c ON b.cliente_id = c.id ORDER BY b.fecha DESC";

        return $this->fetchAllQuery($query);
    }

    public function getBoleta(string $idBoleta)
    {
        $query = "SELECT b.id, b.numero_boleta AS numero, b.fecha, b.vendedor, c.nombre AS cliente, b.tipo_pago, b.total FROM boletas b LEFT JOIN clientes c ON b.cliente_id = c.id WHERE b.id = {$idBoleta}";
        return $this->fetchAllQuery($query)[0];
    }

    public function getDetalleBoleta(string $boleta_id)
    {
        $query = "SELECT p.descripcion AS producto, p.precio, d.cantidad, d.importe FROM detalles_boleta d INNER JOIN productos p ON p.id = d.producto_id WHERE d.boleta_id = {$boleta_id}";
        return $this->fetchAllQuery($query);
    }

    public function getUltimaBoleta()
    {
        $query = "SELECT `numero_boleta` FROM `boletas` ORDER BY `numero_boleta` DESC LIMIT 1";
        return $this->fetchAllQuery($query);
    }

    public function create(): bool
    {
        try {
            $this->db->beginTransaction();
            // 1. Crear boleta
            $inserted = $this->insert('boletas', [
                'numero_boleta' => $this->generarNumBoleta(),
                /* 'fecha' => date('Y-m-d\TH:i:s'), */
                'vendedor' => $this->vendedor,
                'cliente_id' => $this->cliente_id,
                'tipo_pago' => $this->tipo_pago,
                'total' => $this->total
            ]);

            if (!$inserted) {
                $this->rollback();
                return false;
            }

            $boletaId = $this->db->lastInsertId();
            $detail = $this->DetalleBoleta;
            for ($i = 0; $i < count($detail); $i++) {
                $inserted2 = $this->insert('detalles_boleta', [
                    'boleta_id' => $boletaId,
                    'producto_id' => $detail[$i]['producto_id'],
                    'cantidad' => $detail[$i]['cantidad'],
                    'importe' => $detail[$i]['importe']
                ]);
                if (!$inserted2) {
                    $this->rollback();
                    return false;
                }
            }

            $this->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    private function generarNumBoleta()
    {

        $ultimaBoleta = $this->getUltimaBoleta();
        if (!empty($ultimaBoleta) && preg_match('/^([A-Z]+)(\d+)$/i', $ultimaBoleta[0]['numero_boleta'], $matches)) {
            $prefijo = $matches[1];          // Por ejemplo: "BT"
            $numero = $matches[2];           // Por ejemplo: "012"
            $nuevoNumero = str_pad((int)$numero + 1, strlen($numero), '0', STR_PAD_LEFT);
            return $prefijo . $nuevoNumero;  // Resultado: "BT013"
        } else {
            // Si no hay registros aún, iniciar en BT001
            return 'BT001';
        }
    }
}


/*

try {
                $this->db->beginTransaction();
                // 1. Crear boleta
                $numeroBoleta = $this->generarNumBoleta();
                $fecha = date('Y-m-d\TH:i');
                $clienteId = !empty($_POST['cliente_id']) ? $_POST['cliente_id'] : null;
                $vendedor = $_POST['vendedor'];
                $tipoPago = $_POST['tipo_pago'];
                $total = $_POST['total'];


                $this->boleta->insert('boletas', [
                    'numero_boleta' => $numeroBoleta,
                    'fecha' => $fecha,
                    'vendedor' => $vendedor,
                    'cliente_id' => $clienteId,
                    'tipo_pago' => $tipoPago,
                    'total' => $total
                ]);

                $boletaId = $this->db->lastInsertId();

                $cantidades = $_POST['cantidades'];      // ej: [producto_id => cantidad]
                $precios    = $_POST['precios'];         // ej: [producto_id => precio_unitario]

                foreach ($cantidades as $productoId => $cantidad) {
                    $precioUnitario = $precios[$productoId];
                    $importe = $precioUnitario * $cantidad;

                    // 2. Insertar detalle
                    $this->boleta->insert('detalles_boleta', [
                        'boleta_id' => $boletaId,
                        'producto_id' => $productoId,
                        'cantidad' => $cantidad,
                        'importe' => $importe
                    ]);

                    //3. Restar stock
                    $this->boleta->updateQuery('productos', [
                        'cantidad_existente' => new \PDOStatement() // esto es un marcador, lo reemplazamos abajo
                    ], $productoId);

                    // Como no podemos pasar expresiones directamente en updateQuery (como cantidad_existente - 1),
                    // usamos una consulta personalizada:
                    $sql = "UPDATE productos SET cantidad_existente = cantidad_existente - :cantidad WHERE id = :id";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute([
                        ':cantidad' => $cantidad,
                        ':id' => $productoId
                    ]);
                }

                $this->db->commit();
                $mensaje = "Boleta registrada correctamente";
            } catch (PDOException $e) {
                $this->db->rollBack();
                $error = "Error al registrar boleta: " . $e->getMessage();
            }

*/