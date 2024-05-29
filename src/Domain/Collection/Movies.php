<?php

declare(strict_types=1);

namespace App\Domain\Collection;

use App\Domain\Movie;

/**
 * @implements \Iterator<string>
 */
class Movies implements \Iterator
{
    protected int $position = 0;

    /**
     * @param array<int, Movie> $elements
     */
    public function __construct(
        public readonly array $elements
    ) {
    }

    /** @phpstan-ignore-next-line */
    public function current(): Movie
    {
        return $this->elements[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->elements[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }
}
