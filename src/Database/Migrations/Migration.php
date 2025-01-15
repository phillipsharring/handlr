<?php

declare(strict_types=1);

namespace Handlr\Database\Migrations;

use Handlr\Database\Db;

abstract class Migration
{
    protected Db $db;

    public function __construct(Db $db)
    {
        $this->db = $db;
    }

    abstract public function up(): void;

    abstract public function down(): void;
}
