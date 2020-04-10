<?php

namespace Scripts;

use Opis\Database\Database;

class DB
{
    /**
     * @var Database
     */
    public $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function insertMany(array $rows, string $table, string $column = null)
    {
        if (!is_null($column)) {
            foreach ($rows as $value) {
                $this->db->insert([$column => $value])->into($table);
            }
        } else {
            foreach ($rows as $row) {
                $this->db->insert($row)->into($table);
            }
        }
    }

    public function createTable(string $table, callable $callback)
    {
        $this->db->schema()->create($table, $callback);
    }
}
