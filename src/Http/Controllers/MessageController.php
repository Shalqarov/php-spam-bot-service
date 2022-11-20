<?php

namespace App\Http\Controllers;

use App\Services\Service;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\Views\Twig;

class MessageController
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function createMessage(ServerRequest $request, Response $response): ResponseInterface
    {
        return Twig::fromRequest($request)->render($response, 'message.twig');
    }

    public  function sendMessage(ServerRequest $request, Response $response): ResponseInterface
    {
        $data = $request->getParsedBodyParam('message', []);
        $this->service->setItem($data);
        return $response->withRedirect('/history');
    }
}