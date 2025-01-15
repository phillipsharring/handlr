<?php

declare(strict_types=1);

namespace App\Auth;

use Handlr\Database\Record;
use Handlr\Database\Table;
use Handlr\Log\Log;

class UsersTable extends Table
{
    protected string $tableName = 'users';

    protected string $recordClass = UserRecord::class;

    public function insert(Record $record): int|string
    {
        $record->password = password_hash($record->password, PASSWORD_DEFAULT);
        unset($record->password_confirmation);

        Log::debug($record->toArray());

        return parent::insert($record);
    }
}
