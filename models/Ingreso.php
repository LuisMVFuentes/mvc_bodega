<?php

require_once BASE_PATH . '/models/BaseModel.php';

class Ingreso
{
    private $conn;
    public $producto_id;
    public $cantidad_ingresada;
    public $fecha;
    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function getAll()
    {
        $sql = "SELECT i.id, p.descripcion AS productos, i.cantidad_ingresada, i.fecha FROM ingresos i JOIN productos p ON i.producto_id = p.id ORDER BY i.fecha DESC";
        return $this->conn->query($sql);
    }

    public function create()
    {
        try {

            // Iniciar transacción
            $this->conn->beginTransaction();
            $inTransaction = true;

            // 1. Insertar el ingreso 
            $stmt1 = $this->conn->prepare(
                " INSERT INTO ingresos (producto_id, cantidad_ingresada, fecha) VALUES (:producto_id, :cantidad_ingresada, :fecha) "
            );
            $stmt1->execute([
                ':producto_id' => $this->producto_id,
                ':cantidad_ingresada' => $this->cantidad_ingresada,
                ':fecha' => $this->fecha
            ]);
            // 2. Actualizar la cantidad del producto 
            $stmt2 = $this->conn->prepare(
                "UPDATE productos SET cantidad_existente = cantidad_existente + :cantidad_ingresada WHERE id = :producto_id"
            );
            $stmt2->execute([
                ':cantidad_ingresada' => $this->cantidad_ingresada,
                ':producto_id' => $this->producto_id,
            ]);

            // Confirmar transacción 
            $this->conn->commit();
            return true;
        } catch (PDOException $e) {
            if ($inTransaction) {
                // Revertir en caso de error 
                $this->conn->rollBack();
            }
            error_log("Error al registrar ingreso: " . $e->getMessage());
            return false;
        }
    }
}
