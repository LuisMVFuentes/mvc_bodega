<?php
// models/Cliente.php

require_once 'BaseModel.php';

class Cliente extends BaseModel
{
    private $tabla = "clientes";

    public $id;
    public $nombre;
    public $telefono;
    public $direccion;
    public $cantidad_existente;

    // Listar todos los clientes
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->tabla . " ORDER BY nombre ASC";
        return $this->fetchAllQuery($query);
    }

    public function create(): bool
    {
        return $this->insertQuery($this->tabla, [
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion
        ]);
    }
}
