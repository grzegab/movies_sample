<?php

declare(strict_types=1);

namespace App\Infrastructure\FileStorage;

use App\Infrastructure\Adapters\Secondary\FileStorageAdapter;
use App\Infrastructure\Exceptions\MissingDataException;

class Client implements FileStorageAdapter
{
    private const string FILE_PATH = __DIR__.'/Storage/movies.php';

    /**
     * @return array<int, string>
     */
    public function getMovieFileData(): array
    {
        include self::FILE_PATH;

        if (!isset($movies)) {
            throw new MissingDataException();
        }

        return $movies;
    }

    public function getMovieFileDataIterator(): \Iterator
    {
        include self::FILE_PATH;

        if (!isset($movies)) {
            throw new MissingDataException();
        }

        foreach ($movies as $movie) {
            yield $movie;
        }
    }
}
