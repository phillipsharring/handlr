<?php

declare(strict_types=1);

namespace Migrations;

use Handlr\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    public function up(): void
    {
        $this->db->execute("
            CREATE TABLE `sessions` (
                `id` VARCHAR(32) NOT NULL PRIMARY KEY,
                `access` INT(10) UNSIGNED DEFAULT NULL,
                `data` LONGTEXT,
                `ip_address` VARCHAR(45) NULL,
                `user_id` BINARY(16) DEFAULT NULL,
                FOREIGN KEY `sessions_user_id` (`user_id`) REFERENCES `users` (`id`)
            );
        ");
    }

    public function down(): void
    {
        $this->db->execute("DROP TABLE IF EXISTS `sessions`;");
    }
}

