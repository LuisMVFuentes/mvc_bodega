<?php
// models/Cliente.php

class Cliente
{
    private $conn;
    private $tabla = "clientes";

    public $id;
    public $nombre;
    public $telefono;
    public $direccion;
    public $cantidad_existente;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Listar todos los clientes
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->tabla . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear nuevo cliente
    public function create()
    {
        $query = "INSERT INTO " . $this->tabla . "
            SET nombre = :nombre,
                telefono = :telefono,
                direccion = :direccion";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->telefono = htmlspecialchars(strip_tags($this->telefono));
        $this->direccion = htmlspecialchars(strip_tags($this->direccion));

        // Bind
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':telefono', $this->telefono);
        $stmt->bindParam(':direccion', $this->direccion);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
