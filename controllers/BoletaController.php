<?php
require_once BASE_PATH . '\models\Boleta.php';
require_once BASE_PATH . '\models\Producto.php';
require_once BASE_PATH . '\models\Cliente.php';


class BoletaController
{
    private $db;
    private $boleta;
    public $producto;
    public $cliente;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
        $this->boleta = new Boleta($this->db);
        $this->producto = new Producto($this->db);
        $this->cliente = new Cliente($this->db);
    }
    public function index()
    {
        $boletas = $this->boleta->getAll();
        ob_start();
        require BASE_PATH . '\views\boletas\index.php';
        $content = ob_get_clean();
        $title = "Lista de Boletas";
        require BASE_PATH . '\views\layout.php';
    }

    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die("ID de boleta no proporcionado.");
        }

        $boleta = $this->boleta->getBoleta($id);
        $detalle = $this->boleta->getDetalleBoleta($id);

        if (!$boleta) {
            die("Boleta no encontrada.");
        }

        $title = "Detalle de Boleta #" . $boleta['numero'];

        ob_start();
        require BASE_PATH . '/views/boletas/show.php';
        $content = ob_get_clean();

        require BASE_PATH . '/views/layout.php';
    }


    public function create()
    {
        $productos = $this->producto->getAll();
        $clientes = $this->cliente->getAll();
        $mensaje = '';
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $this->boleta->cliente_id = !empty($_POST['cliente_id']) ? $_POST['cliente_id'] : null;
            $this->boleta->vendedor = $_POST['vendedor'];
            $this->boleta->tipo_pago = $_POST['tipo_pago'];
            $this->boleta->total = $_POST['total'];

            $productos = $_POST['productos'] ?? [];
            $cantidades = $_POST['cantidades'] ?? [];
            $importes = $_POST['importes'] ?? [];

            $detalle = [];

            for ($i = 0; $i < count($productos); $i++) {
                if (!empty($productos[$i])) {
                    $detalle[] = [
                        'producto_id' => intval($productos[$i]),
                        'cantidad' => intval($cantidades[$i]),
                        'importe' => floatval($importes[$i])
                    ];
                }
            }

            $this->boleta->DetalleBoleta = $detalle;

            if ($this->boleta->create()) {
                $mensaje = "Boleta registrada correctamente.";
                $this->index();
            } else {
                $error = "Error al registrar boleta.";
            }
        }

        $title = "Crear Nueva boleta";
        ob_start();
        require BASE_PATH . '/views/boletas/create.php';
        $content = ob_get_clean();
        require BASE_PATH . '/views/layout.php';
    }
}
