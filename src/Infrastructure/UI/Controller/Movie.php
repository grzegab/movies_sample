<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Controller;

use App\Application\Handler\TitleHandler;
use App\Infrastructure\Adapters\Primary\RandomTitleAdapter;
use App\Infrastructure\Adapters\Primary\StartWithTitleAdapter;
use App\Infrastructure\Adapters\Primary\WordCountTitleAdapter;
use OpenApi\Attributes as OA;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
#[Route(path: '/movie', name: 'movie_')]
#[OA\Tag(name: 'movie', description: 'Services for movies')]
#[OA\Response(response: Response::HTTP_NOT_FOUND, description: 'Page not found')]
#[OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server error')]
final readonly class Movie implements RandomTitleAdapter, WordCountTitleAdapter, StartWithTitleAdapter
{
    public function __construct(private TitleHandler $titleHandler, private SerializerInterface $serializer)
    {
    }

    #[Route(path: '/random-titles', name: 'random_title', methods: ['GET'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Get(description: 'Get random movie titles', summary: 'Get random movie titles with defined count (default 3)')]
    public function randomTitles(#[MapQueryParameter] int $count = 3): Response
    {
        $movies = $this->titleHandler->getRandomMovies($count);
        $moviesJson = $this->serializer->serialize($movies, JsonEncoder::FORMAT);

        return new Response($moviesJson);
    }

    #[Route(path: '/word-count', name: 'word_count', methods: ['GET'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Get(description: 'Get title with specific word count', summary: 'Get only titles that contains amount of words in title (by default more than 1 word)')]
    public function withWordCount(#[MapQueryParameter] int $count = 2): Response
    {
        $movies = $this->titleHandler->filterMoviesWithTitleWordCount($count);
        $moviesJson = $this->serializer->serialize($movies, JsonEncoder::FORMAT);

        return new Response($moviesJson);
    }

    #[Route(path: '/starting-with-letter', name: 'starting_with', methods: ['GET'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Get(description: 'Movies starting on specific letter (with even count check)', summary: 'Get titles starting on specific letter (by default "W") and with even string count (could be set to odd)')]
    public function startingWith(#[MapQueryParameter] string $startingLetter = 'W', #[MapQueryParameter] bool $even = true): Response
    {
        $movies = $this->titleHandler->filterMoviesByStartingLetterAndEven($startingLetter, $even);
        $moviesJson = $this->serializer->serialize($movies, JsonEncoder::FORMAT);

        return new Response($moviesJson);
    }
}
