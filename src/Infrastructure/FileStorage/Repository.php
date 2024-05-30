<?php

declare(strict_types=1);

namespace App\Infrastructure\FileStorage;

use App\Infrastructure\Adapters\Secondary\FileStorageAdapter;

readonly class Repository implements FileStorageAdapter
{
    public function __construct(private Client $client)
    {
    }

    /**
     * @return array<int, string>
     */
    public function getRandomTitles(int $count): array
    {
        $moveTitles = $this->client->getMovieFileData();

        /** @var array<int,string> $randomKeys */
        $randomKeys = array_rand($moveTitles, $count);

        return array_map(function ($key) use ($moveTitles) {
            return $moveTitles[$key];
        }, $randomKeys);
    }

    /**
     * @return array<int, string>
     */
    public function startingWithTitles(string $letter): array
    {
        $moveTitles = $this->client->getMovieFileDataIterator();

        $acceptedTitles = [];
        foreach ($moveTitles as $title) {
            if (is_string($title) && str_starts_with($title, $letter)) {
                $acceptedTitles[] = $title;
            }
        }

        return $acceptedTitles;
    }

    /**
     * @return array<int, string>
     */
    public function getTitlesWithWordCount(int $count): array
    {
        $moveTitles = $this->client->getMovieFileDataIterator();

        $acceptedTitles = [];
        foreach ($moveTitles as $title) {
            if (is_string($title) && substr_count($title, ' ') + 1 === $count) {
                $acceptedTitles[] = $title;
            }
        }

        return $acceptedTitles;
    }
}
