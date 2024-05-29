<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapters\Secondary;

interface FileStorageAdapter
{
    /**
     * @return array<int, string>
     */
    public function getMovieFileData(): array;
}
