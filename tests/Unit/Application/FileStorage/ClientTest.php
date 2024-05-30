<?php

declare(strict_types=1);

namespace App\Tests\Unit\Application\FileStorage;

use App\Infrastructure\FileStorage\Client;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    #[Test]
    public function getMovieFileData(): void
    {
        $sut = new Client();
        $result = $sut->getMovieFileData();

        $this->assertNotEmpty($result);
    }

    #[Test]
    public function getMovieFileDataIterator(): void
    {
        $sut = new Client();
        $result = $sut->getMovieFileDataIterator();

        $this->assertInstanceOf(\Iterator::class, $result);

        foreach ($result as $item) {
            $this->assertNotEmpty($item);
        }
    }
}
