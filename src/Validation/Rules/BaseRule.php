<?php

declare(strict_types=1);

namespace Handlr\Validation\Rules;

abstract class BaseRule implements RuleValidator
{
    public string $field;

    protected string $errorMessage = '';

    protected array $otherFieldErrors = [];

    public function setField(string $field): self
    {
        $this->field = $field;
        return $this;
    }

    abstract public function validate(mixed $value, array $ruleArgs, array $data = []): bool;

    public function getErrorMessage(): string
    {
        return sprintf($this->errorMessage, $this->field);
    }

    public function getOtherFieldErrors(): array
    {
        return $this->otherFieldErrors;
    }
}
