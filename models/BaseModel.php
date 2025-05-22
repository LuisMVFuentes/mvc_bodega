<?php class BaseModel
{
    public $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function begin(): void
    {
        $this->db->beginTransaction();
    }

    public function commit(): void
    {
        $this->db->commit();
    }

    public function rollback(): void
    {
        $this->db->rollBack();
    }

    public function update(string $sql, array $params): bool
    {
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    /** * Ejecuta una consulta SQL y devuelve todos los resultados como array asociativo. */
    protected function fetchAllQuery(string $sql, array $params = []): array
    {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert(string $table, array $data): bool
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateQuery(string $table, array $data, string $id): bool
    {
        $setPart = implode(', ', array_map(fn($col) => "$col = :$col", array_keys($data)));
        $sql = "UPDATE {$table} SET {$setPart} WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        // Añadimos el ID a los datos
        $data['id'] = $id;

        return $stmt->execute($data);
    }

    public function deleteById(string $table, string $id): bool
    {
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
