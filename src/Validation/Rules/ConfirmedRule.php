<?php

declare(strict_types=1);

namespace Handlr\Validation\Rules;

class ConfirmedRule extends BaseRule
{
    public function validate($value, array $ruleArgs = [], array $data = []): bool
    {
        $confirmationField = "{$this->field}_confirmation";
        $confirmationValue = $data[$confirmationField] ?? null;

        if ($value !== $confirmationValue) {
            $this->otherFieldErrors[$confirmationField] = "This confirmation does not match the {$this->field}.";
            return false;
        }

        return true;
    }
}
