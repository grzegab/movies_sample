<?php

declare(strict_types=1);

namespace App\Infrastructure\UI\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;

#[AsController]
#[Route(path: '/movie', name: 'movie_')]
#[OA\Tag(name: 'movie', description: 'Services for movies')]
#[OA\Response(response: Response::HTTP_INTERNAL_SERVER_ERROR, description: 'Server error')]
class Movie
{
    #[Route(path: '/random-titles', name: 'random_title', methods: ['GET'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Get(description: 'Get random movie titles', summary: 'Get random movie titles with defined count (default 3)')]
    public function randomTitles(): Response
    {
        return new Response('Zwracane są 3 losowe tytuły');
    }

    #[Route(path: '/word-count', name: 'word_count', methods: ['GET'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Get(description: 'Get title with specific word count', summary: 'Get only titles that contains amount of words in title (by default more than 1 word)')]
    public function withWordCount(): Response
    {
        return new Response('Zwracany są wszystkie tytuły, które składają się z więcej niż 1 słowa');
    }

    #[Route(path: '/starting-with-letter', name: 'starting_with', methods: ['GET'])]
    #[OA\Response(response: Response::HTTP_OK, description: 'OK')]
    #[OA\Get(description: 'Movies starting on specific letter (with even count check)', summary: 'Get titles starting on specific letter (by default "W") and with even string count (could be set to odd)')]
    public function startingWith(): Response
    {
        return new Response('Zwracane są wszystkie filmy na literę ‘W’ ale tylko jeśli mają parzystą liczbę znaków w tytule');
    }
}
