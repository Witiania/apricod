<?php

namespace App\Controller;

use App\DTO\RequestDTO;
use App\Service\GameService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class GamesController extends AbstractController
{
    public function __construct(
        private readonly GameService $gameService
    )
    {
    }

    #[Route('/', name: 'add_games', methods: ['POST'])]
    public function create(#[MapRequestPayload] RequestDTO $request): JsonResponse
    {
        return $this->json($request, 200, [], (array)true);
    }

    /**
     * @throws \Exception
     * @throws ExceptionInterface
     */
    #[Route('/{id}', name: 'get_game', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        return $this->json($this->gameService->get($id), 201);
    }

    /**
     * @throws \Exception
     */
    #[Route('/{id}', name: 'delete_game', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        return $this->json($this->gameService->remove($id));
    }

    /**
     * @throws \Exception
     * @throws ExceptionInterface
     */
    #[Route('/{id}', name: 'update_game', methods: ['PUT'])]
    public function update(#[MapRequestPayload] RequestDTO $request, int $id): JsonResponse
    {
        return $this->json($this->gameService->update($id, $request));
    }

    /**
     * @throws \Exception
     * @throws ExceptionInterface
     */
    #[Route('/list/{genre}', name: 'get_games', methods: ['GET'])]
    public function list(string $genre): JsonResponse
    {
        return $this->json($this->gameService->list($genre));
    }
}