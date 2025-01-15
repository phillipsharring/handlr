<?php

declare(strict_types=1);

namespace Handlr\Validation\Rules;

use App\Auth\UsersTable;
use Handlr\Core\Kernel;
use Handlr\Database\Db;

class UniqueRule extends BaseRule
{
    public function __construct(private readonly Db $db) {}

    public function validate($value, array $ruleArgs = [], array $data = []): bool
    {
        [$table, $column] = $ruleArgs;
        $query = "SELECT COUNT(*) FROM $table WHERE $column = ?";
        $result = $this->db->execute($query, [$value])->fetchColumn();

        if ($result > 0) {
            $this->errorMessage = "The %s '$value' already exists in the system.";
            return false;
        }

        return true;
    }
}
