<?php

declare(strict_types=1);

namespace Handlr\Validation\Rules;

class IntRule extends BaseRule
{
    public function validate($value, array $ruleArgs = [], array $data = []): bool
    {
        // Assume the value is valid initially
        $isValid = true;

        // Check if the value is numeric and an integer
        if (!is_numeric($value) || (int)$value != $value) {
            $this->errorMessage = 'The %s value must be an integer.';
            $isValid = false;
        }

        // Check minimum value
        if ($isValid && isset($ruleArgs['min']) && $value < $ruleArgs['min']) {
            $this->errorMessage = 'The %s value must be at least ' . $ruleArgs['min'] . '.';
            $isValid = false;
        }

        // Check maximum value
        if ($isValid && isset($ruleArgs['max']) && $value > $ruleArgs['max']) {
            $this->errorMessage = 'The %s value must not exceed ' . $ruleArgs['max'] . '.';
            $isValid = false;
        }

        return $isValid;
    }
}
