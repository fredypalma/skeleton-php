<?php
namespace BC\Backend\Controller\healthCheck;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


final class HealthCheckController extends AbstractController
{
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse('', Response::HTTP_CREATED);
    }
}