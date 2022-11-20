

<?php

namespace App\Http\Controllers;

use App\Services\Service;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\Views\Twig;

class IndexController
{
    private Service $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function history(ServerRequest $req, Response $resp): ResponseInterface
    {
        $msg = $this->service->all();
        return Twig::fromRequest($req)->render($resp,'history.twig',['messages' => $msg]);
    }
}