<?php

require_once BASE_PATH . '/models/BaseModel.php';

class Ingreso extends BaseModel
{
    private $tabla = "ingresos";
    public $producto_id;
    public $cantidad_ingresada;
    public $fecha;

    public function getAll()
    {
        $query = "SELECT i.id, p.descripcion AS productos, i.cantidad_ingresada, i.fecha FROM ingresos i JOIN productos p ON i.producto_id = p.id ORDER BY i.fecha DESC";
        return $this->fetchAllQuery($query);
    }

    public function create(): bool
    {
        return $this->insertQuery('ingresos', [
            'producto_id' => $this->producto_id,
            'cantidad_ingresada' => $this->cantidad_ingresada,
            'fecha' => $this->fecha
        ]);
    }
}
