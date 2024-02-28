<?php

namespace App\Controller;

use App\Model\UploadImage;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Http\Response as Response;
use App\Model\UserModel;


final class usersController
{
    public function getUser(Request $request, Response $response, array $args): Response
    {

        $usermodel = new UserModel;
        $response = $response->withJson(["res" => $usermodel->getAllUsers()]);
        return $response;

    }

    public function getUserbyID(Request $request, Response $response, array $args): Response
    {

        $id = $args['id'];

        if (isset($id) && !is_numeric($id)) {

            return $response->withJson([
                'error' => \Exception::class,
                'status' => 422,
                'code' => "001",
                'userMessage' => 'ID vazio ou inexistente'
            ], 422);
        }

        $usermodel = new UserModel;
        $res = $usermodel->getUsersById($id);
        $response = $response->withJson(["res" => $res]);
        return $response;

    }


    public function postUser(Request $request, Response $response, array $args): Response
    {

        $new_user = $request->getParsedBody();
        $usermodel = new UserModel;
        $img = $_FILES['Image'];
        $uploadimg = new UploadImage();
        $resimg = $uploadimg->uploadImages($img);

        if ($resimg["res"] == true) {

            $res = $usermodel->postUser($new_user, $resimg['newname']);
            switch ($res) {

                case is_bool($res):

                    move_uploaded_file($img['tmp_name'], 'uploades/' . $resimg['newname']);
                    return $response = $response->withJson(["status" => "true", "res" => 'Usuario criado com sucesso']);

                    break;

                case $res == "23000":

                    return $response = $response->withJson(["status" => "false", "res" => 'Não foi possivel criar esse usuario, numero de Contato/email ja existente']);
                    break;


                case is_string($res) != "23000":
                    return $response = $response->withJson(["teste" => "false", "res" => $res]);
                    break;

            }

        } else {
            return $response = $response->withJson(["status" => "false", "res" => 'Não foi possivel criar esse usuario' . $resimg['msg']]);
        }


        return $response;



    }


    public function updateUser(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        if (isset($id) && !is_numeric($id)) {

            return $response->withJson([
                'error' => \Exception::class,
                'status' => 422,
                'code' => "001",
                'userMessage' => 'ID vazio ou inexistente'
            ], 422);


        }

        $nome = $request->getParsedBody()['Nome'];
        $email = $request->getParsedBody()['Email'];
        $dt_birth = $request->getParsedBody()['DtNascimento'];
        $phone = $request->getParsedBody()['CelularContato'];

        var_dump(
            $nome,
            $email,
            $dt_birth,
            $phone
        );

        $img = $_FILES['Image'];
        $uploadimg = new UploadImage();
        $resimg = $uploadimg->uploadImages($img);


        $usermodel = new UserModel;
        $res = $usermodel->putUsers(
            $id,
            $nome,
            $email,
            $dt_birth,
            $phone,
            $resimg['newname']
        );

        if ($resimg["res"] == true) {
            switch ($res) {


                case is_bool($res):

                    move_uploaded_file($img['tmp_name'], 'uploades/' . $resimg['newname']);
                    return $response = $response->withJson(["status" => "true", "res" => 'Usuario atualizado com sucesso'], 200);
                    break;

                case $res == "23000":

                    return $response = $response->withJson(["status" => "false", "res" => 'Não foi possivel atualizar esse usuario, numero de Contato/email ja existente']);
                    break;

                case is_string($res) != "23000":

                    return $response = $response->withJson(["status" => "false", "res" => 'error ao atualizar']);


            }

        } else {
            return $response = $response->withJson(["status" => "false", "res" => 'Não foi possivel atualizar esse usuario' . $resimg['msg']]);
        }

        return $response;

    }

    public function deleteUser(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        if (isset($id) && !is_numeric($id)) {

            return $response->withJson([
                'error' => \Exception::class,
                'status' => 422,
                'code' => "001",
                'userMessage' => 'ID vazio ou inexistente'
            ], 422);
        }

        $usermodel = new UserModel;
        $res = $usermodel->deleteUsers($id);

        switch ($res) {
            case true:
                $response = $response->withJson(["status" => "true", "res" => 'Usuario deletado com sucesso']);
                break;

            case false:
                $response = $response->withJson(["status" => "false", "res" => 'Não foi possivel deletar esse usuario'], 422);
        }


        return $response;

    }

}

