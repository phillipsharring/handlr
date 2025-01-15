<?php

declare(strict_types=1);

namespace Handlr\Database;

use Handlr\Config\Config;
use PDO;
use PDOStatement;

class Db
{
    private PDO $connection;
    private ?PDOStatement $lastStatement = null;

    public function __construct()
    {
        $dsn = Config::get('database.dsn');
        $user = Config::get('database.user');
        $password = Config::get('database.password');
        $options = Config::get('database.options', []);

        $this->connection = new PDO($dsn, $user, $password, $options);
    }

    public function execute(string $sql, array $params = []): false|PDOStatement
    {
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($params);
        $this->lastStatement = $stmt;
        return $stmt;
    }

    public function insertId(): int
    {
        return (int)$this->connection->lastInsertId();
    }

    /**
     * @throws DatabaseException
     */
    public function affectedRows(?PDOStatement $stmt = null): int
    {
        $stmt = $stmt ?? $this->lastStatement;
        if (!$stmt) {
            throw new DatabaseException('No statement available to get affected rows.');
        }
        return $stmt->rowCount();
    }

    public function uuidToBin(string $uuid): string
    {
        return $this->execute("SELECT UUID_TO_BIN(:uuid) AS `bin`", [':uuid' => $uuid])
            ->fetch(PDO::FETCH_COLUMN);
    }

    public function binToUuid(string $bin): string
    {
        return $this->execute("SELECT BIN_TO_UUID(:bin) AS `uuid`", [':bin' => $bin])
            ->fetch(PDO::FETCH_COLUMN);
    }
}
