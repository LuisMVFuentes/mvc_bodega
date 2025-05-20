<?php
require_once BASE_PATH . '\models\Cliente.php';
class ClienteController
{
    private $db;
    private $cliente;
    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
        $this->cliente = new Cliente($this->db);
    }
    public function index()
    {
        $stmt = $this->cliente->getAll();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ob_start();
        require BASE_PATH . '\views\clientes\index.php';
        $content = ob_get_clean();
        $title = "Lista de Clientes";
        require BASE_PATH . '\views\layout.php';
    }
    public function create()
    {
        $mensaje = '';
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->cliente->nombre = $_POST['nombre'];
            $this->cliente->telefono = $_POST['telefono'];
            $this->cliente->direccion = $_POST['direccion'];
            if ($this->cliente->create()) {
                $mensaje = "Cliente creado correctamente.";
            } else {
                $error = "Error al crear cliente.";
            }
        }
        ob_start();
        require BASE_PATH . '/views/clientes/create.php';
        $content = ob_get_clean();
        $title = "Agregar Cliente";
        require BASE_PATH . '/views/layout.php';
    }
}
