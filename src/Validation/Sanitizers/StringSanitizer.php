<?php

declare(strict_types=1);

namespace Handlr\Validation\Sanitizers;

class StringSanitizer implements Sanitizer
{
    public function sanitize($value, array $ruleArgs = []): string
    {
        // trim whitespace if specified
        if (isset($ruleArgs['trim']) && $ruleArgs['trim'] === true) {
            $value = trim($value);
        }

        // optionally strip unwanted characters
        if (isset($ruleArgs['strip_tags']) && $ruleArgs['strip_tags'] === true) {
            $value = strip_tags($value);
        }

        // remove control characters or other unwanted characters
        return preg_replace('/[\x00-\x1F\x7F]/', '', $value);
    }
}
