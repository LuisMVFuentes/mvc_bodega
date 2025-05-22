<?php require_once BASE_PATH . '/models/Ingreso.php';
require_once BASE_PATH . '/models/Producto.php';
class IngresoController
{
    private $db;
    private $ingreso;
    private $producto;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
        $this->ingreso = new Ingreso($this->db);
        $this->producto = new Producto($this->db);
    }
    public function index()
    {
        $ingresos = $this->ingreso->getAll();
        ob_start();
        include BASE_PATH . '/views/ingresos/index.php';
        $content = ob_get_clean();
        $title = "Historial de Ingresos";
        include BASE_PATH . '/views/layout.php';
    }
    public function create()
    {
        $productos = $this->producto->getAll();
        $mensaje = '';
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->ingreso->producto_id = $_POST['producto_id'];
            $this->ingreso->cantidad_ingresada = $_POST['cantidad'];
            $this->ingreso->fecha = $_POST['fecha'];
            if ($this->ingreso->create()) {
                $mensaje = "Ingreso registrado correctamente.";
            } else {
                $error = "Error al registrar ingreso.";
            }
        }

        

        ob_start();
        include BASE_PATH . '/views/ingresos/create.php';
        $content = ob_get_clean();
        $title = "Registrar Ingreso";
        include BASE_PATH . '/views/layout.php';
    }
}
