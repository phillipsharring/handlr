<?php

declare(strict_types=1);

namespace Migrations;

use Handlr\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up(): void
    {
        $this->db->execute("
            CREATE TABLE `users` (
                `id` BINARY(16) NOT NULL PRIMARY KEY,
                `name` VARCHAR(255) NOT NULL,
                `email` VARCHAR(255) UNIQUE NOT NULL,
                `password` VARCHAR(64) NOT NULL,
                `remember_token` VARCHAR(100) NULL,
                `last_login_at` DATETIME DEFAULT NULL,
                `email_verified_at` DATETIME DEFAULT NULL,
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
