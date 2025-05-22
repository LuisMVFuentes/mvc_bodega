<?php
require_once BASE_PATH . '\models\Boleta.php';
class BoletaController
{
    private $db;
    private $boleta;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
        $this->boleta = new Boleta($this->db);
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
}
