<?php

declare(strict_types=1);

namespace Handlr\Validation\Rules;

interface RuleValidator
{
    public function validate(mixed $value, array $ruleArgs, array $data = []): bool;

    public function setField(string $field): self;

    public function getErrorMessage(): string;

    public function getOtherFieldErrors(): array;
}
