<?php

declare(strict_types=1);

namespace App\Auth;

use Handlr\Database\Record;

class UserRecord extends Record
{
    public bool $useUuid = true;

    public array $data = [
        'id'                => '',
        'name'              => '',
        'email'             => '',
        'password'          => '',
        'remember_token'    => null,
        'last_login_at'     => null,
        'email_verified_at' => null,
    ];
}
