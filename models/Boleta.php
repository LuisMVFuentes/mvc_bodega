<?php

require_once BASE_PATH . '/models/BaseModel.php';

class boleta extends BaseModel
{
    public $número;
    public $fecha;
    public $hora;
    public $vendedor;
    public $cliente_id; /* (opcional) */
    public $tipo_pago;
    public $total;
    public $DetalleBoleta; /*boleta_id, descripcion, precio_unitario, cantidad, importe */

    public function getAll()
    {
        $query = "SELECT b.id, b.numero_boleta, b.fecha, b.hora, b.vendedor, c.nombre AS `cliente`, b.tipo_pago, b.total FROM `boletas` b 
        LEFT JOIN `clientes` c ON b.cliente_id = c.id";

        return $this->fetchAllQuery($query);
    }

    public function getBoleta(string $idBoleta)
    {
        $query = "SELECT b.id, b.numero_boleta AS numero, b.fecha, b.hora, b.vendedor, c.nombre AS cliente, b.tipo_pago, b.total FROM boletas b LEFT JOIN clientes c ON b.cliente_id = c.id WHERE b.id = {$idBoleta}";
        return $this->fetchAllQuery($query)[0];
    }

    public function getDetalleBoleta(string $idBoleta)
    {
        $query = "SELECT d.descripcion AS producto, d.precio_unitario, d.cantidad, d.importe FROM detalles_boleta d WHERE d.boleta_id = {$idBoleta}";
        return $this->fetchAllQuery($query);
    }

    public function getDetalle(string $boletaId)
    {
        $query = "SELECT descripcion, precio_unitario, cantidad, importe FROM detalle_boletas WHERE boleta_id = :boleta_id";
        return $this->fetchAllQuery($query);
    }
}
