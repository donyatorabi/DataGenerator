<?php

namespace App\DTOs;

class StoreTaskDto
{
    public function __construct(private string $title) {}

    public function getTitle(): string
    {
        return $this->title;
    }
}
