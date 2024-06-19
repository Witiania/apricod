<?php

namespace App\Controller;

use App\DTO\RequestDTO;
use App\DTO\ResponseDTO;
use App\DTO\ResponseListDTO;
use App\Service\CreateGameInterface;
use App\Service\GameListInterface;
use App\Service\GetGameInterface;
use App\Service\RemoveGameInterface;
use App\Service\UpdateGameInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;


class GamesController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/', name: 'add_games', methods: ['POST'])]
    public function create(#[MapRequestPayload] RequestDTO $request, CreateGameInterface $createGameService): JsonResponse
    {
        $game = $createGameService->create($request);

        $validResponse = new ResponseDTO($game);

        return $this->json($validResponse, 201);
    }

    /**
     * @throws \Exception
     * @throws ExceptionInterface
     */
    #[Route('/{id}', name: 'get_game', methods: ['GET'])]
    public function get(int $id, GetGameInterface $gameService): JsonResponse
    {
        $game = $gameService->get($id);

        $validResponse = new ResponseDTO($game);

        return $this->json($validResponse);
    }

    /**
     * @throws \Exception
     */
    #[Route('/{id}', name: 'delete_game', methods: ['DELETE'])]
    public function delete(int $id, RemoveGameInterface $gameService): JsonResponse
    {
        return $this->json($gameService->remove($id));
    }

    /**
     * @throws ExceptionInterface
     * @throws \Exception
     */
    #[Route('/{id}', name: 'update_game', methods: ['PUT'])]
    public function update(#[MapRequestPayload] RequestDTO $request, int $id, UpdateGameInterface $gameService): JsonResponse
    {
        $game = $gameService->update($id, $request);

        $validResponse = new ResponseDTO($game);

        return $this->json($validResponse);
    }

    /**
     * @throws ExceptionInterface
     * @throws \Exception
     */
    #[Route('/list/{genre}', name: 'get_games', methods: ['GET'])]
    public function list(string $genre, GameListInterface $gameService): JsonResponse
    {
        $games = $gameService->list($genre);

        $validResponse = new ResponseListDTO($games);

        return $this->json($validResponse);
    }
}