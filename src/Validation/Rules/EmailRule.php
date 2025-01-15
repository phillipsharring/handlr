<?php

declare(strict_types=1);

namespace Handlr\Validation\Rules;

class EmailRule extends BaseRule
{
    public function validate($value, array $ruleArgs = [], array $data = []): bool
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errorMessage = 'The %s value must be a valid email address.';
            return false;
        }

        return true;
    }
}
