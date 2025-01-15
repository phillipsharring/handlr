<?php

declare(strict_types=1);

namespace Handlr\Validation\Rules;

use DateTime;

class DateRule extends BaseRule
{
    public function validate($value, array $ruleArgs = [], array $data = []): bool
    {
        // is the date valid?
        $format = $ruleArgs['format'] ?? 'Y-m-d';
        $date = DateTime::createFromFormat($format, $value);

        if (!$date || $date->format($format) !== $value) {
            $this->errorMessage = "The %s value must be a valid date in the format $format.";
            return false;
        }

        return true;
    }
}
