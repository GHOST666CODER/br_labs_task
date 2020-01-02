<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\GameBufferService;
use Symfony\Component\HttpFoundation\Request;

class GameBufferController extends AbstractController
{

    private $gameBufferService;

    public function __construct(GameBufferService $gameBufferService)
    {
        $this->gameBufferService = $gameBufferService;
    }

    /**
     * @Route(
     *     name="post_game_buffer",
     *     path="/",
     *     methods={"POST"},
     *     defaults={"_api_item_operation_name"="post_game_buffer"}
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        $this->gameBufferService->saveGameBuffer(json_decode($request->getContent(), true));

        return new JsonResponse($request->getContent(), 201);
    }
}
