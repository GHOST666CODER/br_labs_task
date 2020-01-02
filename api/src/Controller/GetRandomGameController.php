<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetRandomGameController extends AbstractController
{
    /**
     * @Route(
     *     name="get_random_game",
     *     path="/get_random",
     *     methods={"GET"},
     *     defaults={"_api_item_operation_name"="get_random_game"}
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        return new JsonResponse('hha',200);
    }
}
