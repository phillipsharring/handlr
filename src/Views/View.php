<?php

declare(strict_types=1);

namespace Handlr\Views;

class View
{
    protected string $basePath = __DIR__ . '/../../resources/views';

    public function __construct(private readonly string $templatePath, private ?array $data = []) {}

    public function render(): string
    {
        extract($this->data);
        ob_start();
        require_once "$this->basePath/$this->templatePath.php"; // NOSONAR
        return ob_get_clean();
    }
}
