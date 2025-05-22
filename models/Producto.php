<?php
// models/Producto.php
require_once 'BaseModel.php';

class Producto extends BaseModel
{
    private $tabla = "productos";

    public $id;
    public $categoria;
    public $descripcion;
    public $precio;
    public $cantidad_existente;


    // Listar todos los productos
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->tabla . " ORDER BY categoria, descripcion ASC";
        return $this->fetchAllQuery($query);
    }

    // Listar todos categorias
    public function getCategorias()
    {
        $query = "SELECT DISTINCT categoria FROM " . $this->tabla . " ORDER BY id ASC";
        return $this->fetchAllQuery($query);
    }

    // Crear nuevo producto
    public function create()
    {
        return $this->insert($this->tabla, [
            'categoria' => $this->categoria,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'cantidad_existente' => $this->cantidad_existente
        ]);
    }
}
