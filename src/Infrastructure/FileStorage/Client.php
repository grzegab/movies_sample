<?php

declare(strict_types=1);

namespace App\Infrastructure\FileStorage;

use App\Infrastructure\Adapters\Secondary\FileStorageAdapter;
use App\Infrastructure\Exceptions\MissingDataException;

class Client implements FileStorageAdapter
{
    /**
     * @return array<int, string>
     */
    public function getMovieFileData(): array
    {
        include __DIR__.'/Storage/movies.php';

        if (!isset($movies)) {
            throw new MissingDataException();
        }

        return $movies;
    }
}
