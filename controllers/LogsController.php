<?php

require_once BASE_PATH . '/models/Log.php';

class LogsController
{
    private $db;
    private $log;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->conectar();
        $this->log = new Log($this->db);
    }
    public function index()
    {
        $logs = $this->log->getAll();
        ob_start();
        require BASE_PATH . '\views\logs\index.php';
        $content = ob_get_clean();
        $title = "Lista de Incidencias";
        require BASE_PATH . '\views\layout.php';
    }
}
