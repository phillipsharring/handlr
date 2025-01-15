<?php

declare(strict_types=1);

namespace Migrations;

use Handlr\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    public function up(): void
    {
        $this->db->execute("
            CREATE TABLE `groups` (
                `id` BINARY(16) NOT NULL PRIMARY KEY,
                `name` VARCHAR(255) NOT NULL,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
            );
        ");
    }

    public function down(): void
    {
        $this->db->execute("DROP TABLE IF EXISTS `users`;");
    }
}
