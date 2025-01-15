<?php

declare(strict_types=1);

namespace App\Groups;

use Handlr\Validation\FormValidator;

class GroupFormValidator extends FormValidator
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
        ];
    }
}
