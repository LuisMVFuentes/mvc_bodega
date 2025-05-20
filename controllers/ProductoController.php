<?php
require_once BASE_PATH . '\models\Producto.php';
class ProductoController
{
    private $db;
    private $producto;
    private $categorias;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
        $this->producto = new Producto($this->db);
    }
    public function index()
    {
        $productos = $this->producto->getAll();
        ob_start();
        require BASE_PATH . '\views\productos\index.php';
        $content = ob_get_clean();
        $title = "Lista de Productos";
        require BASE_PATH . '\views\layout.php';
    }

    public function create()
    {
        $mensaje = '';
        $error = '';
        $categorias = $this->producto->getCategorias();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->producto->categoria = $_POST['categoria'];
            $this->producto->descripcion = $_POST['descripcion'];
            $this->producto->precio = $_POST['precio'];
            $this->producto->cantidad_existente = $_POST['cantidad_existente'];
            if ($this->producto->create()) {
                $mensaje = "Producto creado correctamente.";
            } else {
                $error = "Error al crear producto.";
            }
        }
        ob_start();
        require BASE_PATH . '/views/productos/create.php';
        $content = ob_get_clean();
        $title = "Agregar Producto";
        require BASE_PATH . '/views/layout.php';
    }
}
