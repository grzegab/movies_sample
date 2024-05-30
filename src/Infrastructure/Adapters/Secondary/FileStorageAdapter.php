<?php

declare(strict_types=1);

namespace App\Infrastructure\Adapters\Secondary;

interface FileStorageAdapter
{
    /**
     * @return array<int, string>
     */
    public function getRandomTitles(int $count): array;

    /**
     * @return array<int, string>
     */
    public function startingWithTitles(string $letter): array;

    /**
     * @return array<int, string>
     */
    public function getTitlesWithWordCount(int $count): array;
}
