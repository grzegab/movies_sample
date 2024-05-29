<?php

declare(strict_types=1);

namespace App\Infrastructure\FileStorage;

use App\Domain\Collection\Movies;
use App\Domain\Factory\MoviesFactory;
use App\Domain\Repository\FileStorageRepository;
use App\Infrastructure\Adapters\Secondary\FileStorageAdapter;

readonly class Service implements FileStorageRepository
{
    public function __construct(
        private FileStorageAdapter $fileStorageClient,
        private MoviesFactory $moviesFactory
    ) {
    }

    public function getFilterByWordCount(int $count): Movies
    {
        $moveTitles = $this->fileStorageClient->getMovieFileDataIterator();

        $acceptedTitles = [];
        foreach ($moveTitles as $title) {
            if (is_string($title) && substr_count($title, ' ') + 1 === $count) {
                $acceptedTitles[] = $title;
            }
        }

        return $this->moviesFactory->createFrom($acceptedTitles);
    }

    public function getRandomMovies(int $count): Movies
    {
        $moveTitles = $this->fileStorageClient->getMovieFileData();

        /** @var array<int,string> $randomKeys */
        $randomKeys = array_rand($moveTitles, $count);

        $randomTitles = array_map(function ($key) use ($moveTitles) {
            return $moveTitles[$key];
        }, $randomKeys);

        return $this->moviesFactory->createFrom($randomTitles);
    }

    public function getMoviesStartingWithAndEven(string $letter): Movies
    {
        $moveTitles = $this->fileStorageClient->getMovieFileDataIterator();

        $acceptedTitles = [];
        foreach ($moveTitles as $title) {
            if (is_string($title) && str_starts_with($title, $letter)) {
                $acceptedTitles[] = $title;
            }
        }

        return $this->moviesFactory->createFrom($acceptedTitles);
    }
}
