<?php

namespace App\Controller;

use App\DTO\RequestDTO;
use App\Service\GameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GamesController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer,
        private readonly GameService $gameService
    )
    {
    }
    #[Route('/', name: 'add_games', methods: ['POST'])]
    public function create(#[MapRequestPayload] RequestDTO $request): JsonResponse
    {
        $jsonGame = $this->serializer->serialize($this->gameService->create($request), 'json');
        return new JsonResponse($jsonGame, 200, [], true);
    }

    /**
     * @throws \Exception
     */
    #[Route('/{id}', name: 'get_games', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        $jsonGame = $this->serializer->serialize($this->gameService->get($id), 'json');
        return new JsonResponse($jsonGame, 200, [], true);
    }

    /**
     * @throws \Exception
     */
    #[Route('/{id}', name: 'delete_games', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $jsonGame = $this->serializer->serialize($this->gameService->remove($id), 'json');
        return new JsonResponse($jsonGame, 200, [], true);
    }

    #[Route('/{id}', name: 'update_games', methods: ['PUT'])]
    public function update(#[MapRequestPayload] RequestDTO $request, int $id): JsonResponse
    {
        $jsonGames = $this->serializer->serialize($this->gameService->update($id, $request), 'json');
        return new JsonResponse($jsonGames, 200, [], true);
    }

    /**
     * @throws \Exception
     */
    #[Route('/list/{genre}', name: 'get_games', methods: ['GET'])]
    public function list(string $genre): JsonResponse
    {
        $jsonGames = $this->serializer->serialize($this->gameService->list($genre), 'json');
        return new JsonResponse($jsonGames, 200, [], true);
    }
}