<?php

declare(strict_types=1);

namespace App\Infrastructure\FileStorage;

use App\Domain\Collection\Movies;
use App\Domain\Factory\MoviesFactory;
use App\Domain\Repository\FileStorageRepository;

readonly class Service implements FileStorageRepository
{
    public function __construct(
        private Client $fileStorageClient,
        private MoviesFactory $moviesFactory
    ) {
    }

    public function getFilterByWordCount(int $count): Movies
    {
        $moveTitles = $this->getTitles();

        $filteredTitles = array_filter($moveTitles, function ($title) use ($count) {
            return substr_count($title, ' ') + 1 === $count;
        });

        return $this->moviesFactory->createFrom($filteredTitles);
    }

    public function getRandomMovies(int $count): Movies
    {
        $moveTitles = $this->getTitles();

        /** @var array<int,string> $randomKeys */
        $randomKeys = array_rand($moveTitles, $count);

        $randomTitles = array_map(function ($key) use ($moveTitles) {
            return $moveTitles[$key];
        }, $randomKeys);

        return $this->moviesFactory->createFrom($randomTitles);
    }

    public function getMoviesStartingWithAndEven(string $letter, bool $even): Movies
    {
        $moveTitles = $this->getTitles();

        $filteredTitles = array_filter($moveTitles, function ($title) use ($letter, $even) {
            $startsWithLetter = str_starts_with($title, $letter);
            $isEven = 0 === strlen($title) % 2;

            return $startsWithLetter && ($isEven === $even);
        });

        return $this->moviesFactory->createFrom($filteredTitles);
    }

    /**
     * @return array<int, string>
     */
    private function getTitles(): array
    {
        return $this->fileStorageClient->getMovieFileData();
    }
}
