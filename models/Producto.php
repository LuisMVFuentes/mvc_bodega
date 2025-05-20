<?php
// models/Producto.php

class Producto
{
    private $conn;
    private $tabla = "productos";

    public $id;
    public $categoria;
    public $descripcion;
    public $precio;
    public $cantidad_existente;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Listar todos los productos
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->tabla . " ORDER BY id ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear nuevo producto
    public function create()
    {
        $query = "INSERT INTO " . $this->tabla . "
            SET categoria = :categoria,
                descripcion = :descripcion,
                precio = :precio,
                cantidad_existente = :cantidad_existente";

        $stmt = $this->conn->prepare($query);

        // Sanitizar
        $this->categoria = htmlspecialchars(strip_tags($this->categoria));
        $this->descripcion = htmlspecialchars(strip_tags($this->descripcion));
        $this->precio = htmlspecialchars(strip_tags($this->precio));
        $this->cantidad_existente = htmlspecialchars(strip_tags($this->cantidad_existente));

        // Bind
        $stmt->bindParam(':categoria', $this->categoria);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':precio', $this->precio);
        $stmt->bindParam(':cantidad_existente', $this->cantidad_existente);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
