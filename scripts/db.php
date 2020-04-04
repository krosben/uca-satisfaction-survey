<?php

namespace Scripts;

use Opis\Database\Connection;
use Opis\Database\Database;

function isAssoc(array $arr)
{
    if ([] === $arr) {
        return false;
    }

    return array_keys($arr) !== range(0, count($arr) - 1);
}

class DB
{
    /**
     * @var Database
     */
    public $db;
    /**
     * @var Connection
     */
    private Connection $connection;

    public function __construct()
    {
        $this->connection = new Connection(
            getenv('DB_DSN'),
            getenv('DB_USER'),
            getenv('DB_PASS')
        );
        $this->db = new Database($this->connection);
    }

    public function insertMany(array $rows, string $table, string $column = null)
    {
        if (isAssoc($rows)) {
            foreach ($rows as $row) {
                $this->db->insert($row)->into($table);
            }
        } elseif (!is_null($column)) {
            foreach ($rows as $value) {
                $this->db->insert([$column => $value])->into($table);
            }
        }
    }

    public function createTable(string $table, callable $callback)
    {
        $this->db->schema()->create($table, $callback);
    }
}
