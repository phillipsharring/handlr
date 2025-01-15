<?php

declare(strict_types=1);

namespace Handlr\Validation\Sanitizers;

class IntSanitizer implements Sanitizer
{
    public function sanitize($value, array $ruleArgs = []): int
    {
        return (int) $value;
    }
}
