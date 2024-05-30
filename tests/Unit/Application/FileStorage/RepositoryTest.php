<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\FileStorage;

use App\Infrastructure\FileStorage\Client;
use App\Infrastructure\FileStorage\Repository;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class RepositoryTest extends TestCase
{
    private Client $client;

    protected function setUp(): void
    {
        $this->client = $this->createMock(Client::class);
    }

    #[Test]
    public function getRandomTitles(): void
    {
        $this->client->expects($this->once())->method('getMovieFileData')->willReturn(['a', 'abc', 'abc def', 'det', 'foo bar rt']);

        $sut = new Repository($this->client);
        $result = $sut->getRandomTitles(3);

        $this->assertCount(3, $result);
    }

    #[Test]
    public function startingWithTitles(): void
    {
        $this->client->expects($this->once())->method('getMovieFileDataIterator')->willReturn($this->arrayGeneratorSample());

        $sut = new Repository($this->client);
        $result = $sut->startingWithTitles('a');

        $this->assertCount(3, $result);
    }

    #[Test]
    public function getTitlesWithWordCount(): void
    {
        $this->client->expects($this->once())->method('getMovieFileDataIterator')->willReturn($this->arrayGeneratorSample());

        $sut = new Repository($this->client);
        $result = $sut->getTitlesWithWordCount(2);

        $this->assertCount(2, $result);
    }

    private function arrayGeneratorSample(): \Generator
    {
        yield from ['a', 'abc', 'abc def', 'det dat', 'foo bar rt'];
    }
}
