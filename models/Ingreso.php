<?php

require_once BASE_PATH . '/models/BaseModel.php';

class Ingreso extends BaseModel
{
    public $producto_id;
    public $cantidad_ingresada;
    public $fecha;

    public function getAll()
    {
        $query = "SELECT i.id, p.descripcion AS productos, i.cantidad_ingresada, i.fecha 
        FROM ingresos i JOIN productos p ON i.producto_id = p.id ORDER BY i.fecha DESC";
        return $this->fetchAllQuery($query);
    }

    public function create(): bool
    {
        try {
            $this->begin();
            // Insertar el ingreso
            $inserted = $this->insert('ingresos', [
                'producto_id' => $this->producto_id,
                'cantidad_ingresada' => $this->cantidad_ingresada,
                'fecha' => $this->fecha
            ]);

            // Si la inserción falló, revertimos
            if (!$inserted) {
                $this->rollback();
                return false;
            }

            // Actualizar cantidad del producto
            $updated = $this->update(
                "UPDATE productos 
         SET cantidad_existente = cantidad_existente + :cantidad 
         WHERE id = :producto_id",
                [
                    ':cantidad' => $this->cantidad_ingresada,
                    ':producto_id' => $this->producto_id
                ]
            );

            if (!$updated) {
                $this->rollback();
                return false;
            }

            // Todo correcto
            $this->commit();
            return true;
        } catch (PDOException $e) {
            $this->rollback();
            error_log("Error al registrar ingreso: " . $e->getMessage());
            return false;
        }
    }
}
