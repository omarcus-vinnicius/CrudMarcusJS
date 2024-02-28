<?php

namespace App\Middlewares\ErrorHandling;


use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response as Response;

final class errorUpdate
{

    public function __invoke(Request $request, Response $response, callable $next): Response
    {

        $newuser = $request->getParsedBody();

        var_dump($request);



        if (
            !isset($newuser['Nome']) || empty($newuser['Nome']) ||
            !isset($newuser['Email']) || empty($newuser['Email']) ||
            !isset($newuser['DtNascimento']) || empty($newuser['DtNascimento']) ||
            !isset($newuser['CelularContato']) || empty($newuser['CelularContato'])
        ) {

            try {
                throw new \Exception("Preencha o todos campos para prosseguir com a requisição");
            } catch (\Exception | \Throwable $ex) {
                return $response->withJson([
                    'error' => \Exception::class,
                    'status' => 422,
                    'code' => "001",
                    'userMessage' => 'Campos vazios ou inexistentes',
                    'developerMessage' => $ex->getMessage()
                ], 422);
            }

        }

        $response = $next($request, $response);
        return $response;
    }
}

