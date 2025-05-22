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


    public function edit()
    {
        $mensaje = '';
        $error = '';
        $categorias = $this->producto->getCategorias();

        // Detectar si es GET (mostrar) o POST (actualizar)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_producto = $_POST['id'] ?? null;

            if (!$id_producto) {
                $error = "ID de cliente no válido.";
            } else {
                $this->producto->id = $id_producto;
                $this->producto->categoria = $_POST['categoria'];
                $this->producto->descripcion = $_POST['descripcion'];
                $this->producto->precio = $_POST['precio'];
                $this->producto->cantidad_existente = $_POST['cantidad_existente'];

                if ($this->producto->edit($id_producto)) {
                    $mensaje = "Producto editado correctamente.";
                } else {
                    $error = "Error al editar producto.";
                }

                // Obtener datos actualizados
                $producto = $this->producto->getProducto($id_producto);
            }
        } else {
            $id_producto = $_GET['id'] ?? null;

            if (!$id_producto) {
                die("ID no proporcionado.");
            }

            $producto = $this->producto->getProducto($id_producto);
        }

        ob_start();
        require BASE_PATH . '/views/productos/edit.php';
        $content = ob_get_clean();
        $title = "Editar Producto";
        require BASE_PATH . '/views/layout.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            // Puedes redirigir o mostrar un error
            die("ID no proporcionado.");
        }

        if ($this->producto->delete($id)) {
            $mensaje = "Producto eliminado correctamente.";
        } else {
            $mensaje = "No se pudo eliminar el Producto.";
        }

        // Redirigir o recargar vista con mensaje
        header("Location: ?controller=cliente&action=index&mensaje=" . urlencode($mensaje));
        exit;
    }
}
