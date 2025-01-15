<?php

declare(strict_types=1);

namespace Handlr\Validation;

interface ValidationHandler
{
    public function rules(): array;
}
