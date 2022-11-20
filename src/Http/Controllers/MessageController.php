<?php

namespace App\Http\Controllers;

use App\Services\Service;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
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

    public function sendMessage(ServerRequest $request, Response $response): ResponseInterface
    {
        $data = $request->getParsedBodyParam('message', []);
        $msg = $data['message'] . "\\n#aboba_team";
        try {
            $this->send($msg);
        }catch (\Exception $e) {
            die(500);
        }
        $this->service->setItem($data);
        return $response->withRedirect('/history');
    }

    private function send(string $message)
    {
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/json'
        ];
        $body = "{
             \"message\": \"{$message}\"
        }";
        $req = new Request('POST', 'localhost:5000/api/send', $headers, $body);
        $client->sendAsync($req)->wait();
    }
}