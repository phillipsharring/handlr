<?php

declare(strict_types=1);

namespace App\Groups;

use Handlr\Database\Record;

class GroupRecord extends Record
{
    public bool $useUuid = true;

    public array $data = [
        'id'   => '',
        'name' => null,
    ];
}
