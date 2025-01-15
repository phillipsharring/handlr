<?php

declare(strict_types=1);

namespace App\Groups;

use Handlr\Database\Table;

class GroupsTable extends Table
{
    protected string $tableName = 'groups';

    protected string $recordClass = GroupRecord::class;
}
