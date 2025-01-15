<?php

declare(strict_types=1);

namespace Handlr\Database;

use Ramsey\Uuid\Uuid;
use Random\RandomException;

abstract class Record
{
    // int or UUID (string)
    public int|string|null $id = null;

    protected array $data = [];
    public bool $useUuid = true;

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->data[$key] = $value;
        }

        if ($this->useUuid && empty($this->data['id'])) {
            $this->data['id'] = $this->generateUuid();
        }
    }

    public function __get(string $key)
    {
        return $this->data[$key] ?? null;
    }

    public function __set(string $key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __isset(string $key): bool
    {
        return isset($this->data[$key]);
    }

    public function __unset(string $key)
    {
        unset($this->data[$key]);
    }

    public function toArray(): array
    {
        return $this->data;
    }

    private function generateUuid(): string
    {
        return Uuid::uuid4()->toString();
    }
}
