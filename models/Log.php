<?php

require_once 'BaseModel.php';

class Log extends BaseModel{
    private $id;
    private $fecha;
    private $descripcion;
    private $referencia;
 
    public function getAll(){
        $query = 'SELECT * FROM logs ORDER BY fecha DESC';
        return $this->fetchAllQuery($query);
    }
}