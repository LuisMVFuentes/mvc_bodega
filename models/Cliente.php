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

    public function getCliente(string $idCliente)
    {
        $query = "SELECT * FROM " . $this->tabla . " WHERE id = " . $idCliente;
        return $this->fetchAllQuery($query)[0];
    }

    public function create(): bool
    {
        return $this->insert($this->tabla, [
            'nombre' => $this->nombre,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion
        ]);
    }

    public function edit(string $idCliente): bool
    {
        return $this->updateQuery(
            $this->tabla,
            [
                'nombre' => $this->nombre,
                'telefono' => $this->telefono,
                'direccion' => $this->direccion
            ],
            $idCliente);
    }
}
