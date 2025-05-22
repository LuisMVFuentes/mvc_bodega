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
        $clientes = $this->cliente->getAll();
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

    public function edit()
    {
        $mensaje = '';
        $error = '';
        // Detectar si es GET (mostrar) o POST (actualizar)
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cliente = $_POST['id'] ?? null;

            if (!$id_cliente) {
                $error = "ID de cliente no válido.";
            } else {
                $this->cliente->id = $id_cliente;
                $this->cliente->nombre = $_POST['nombre'];
                $this->cliente->telefono = $_POST['telefono'];
                $this->cliente->direccion = $_POST['direccion'];

                if ($this->cliente->edit($id_cliente)) {
                    $mensaje = "Cliente editado correctamente.";
                } else {
                    $error = "Error al editar cliente.";
                }

                // Obtener datos actualizados
                $cliente = $this->cliente->getCliente($id_cliente);
            }
        } else {
            $id_cliente = $_GET['id'] ?? null;

            if (!$id_cliente) {
                die("ID no proporcionado.");
            }

            $cliente = $this->cliente->getCliente($id_cliente);
        }

        ob_start();
        require BASE_PATH . '/views/clientes/edit.php';
        $content = ob_get_clean();
        $title = "Editar Cliente";
        require BASE_PATH . '/views/layout.php';
    }

    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            // Puedes redirigir o mostrar un error
            die("ID no proporcionado.");
        }

        if ($this->cliente->delete($id)) {
            $mensaje = "Cliente eliminado correctamente.";
        } else {
            $mensaje = "No se pudo eliminar el cliente.";
        }

        // Redirigir o recargar vista con mensaje
        header("Location: ?controller=cliente&action=index&mensaje=" . urlencode($mensaje));
        exit;
    }
}
