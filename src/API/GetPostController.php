<?php

declare(strict_types=1);

namespace App\API;

use App\Post\Application\Command\CreatePostCommand;
use App\Shared\Domain\Bus\CommandBus;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;
use App\Post\Domain\PostRepository;

#[Route(path: '/posts/{post_id}', methods: ['GET'])]

class GetPostController
{
    public function __construct(
        private readonly PostRepository $repository
    ) {
    }

    public function __invoke(Request $request,$post_id): Response
    {
         $uuidValue =$post_id ;
         $uuid = Uuid::fromString($uuidValue);

        try {
            $detail=$this->repository->find($uuid);
            if (!$detail) {
                return new JsonResponse([], 404);
            }
            $response = new Response(json_encode($detail));
            $response->headers->set('Content-Type', 'application/json');
            $response->setStatusCode(200);
            return $response;
        } catch (Exception $exception) {
             return new JsonResponse([], 404);
        }



    }
}
