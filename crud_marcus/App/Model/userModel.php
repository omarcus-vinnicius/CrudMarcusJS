<?php
namespace App\Model;

use App\Database\Connection;

class UserModel extends Connection
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getAllUsers()
    {
        $result = $this->pdo->query("SELECT id,nome,email,dataDeNascimento,celularContato,img FROM Users ORDER BY id desc")->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }


    public function getUsersById($id)
    {
        $resuser = $this->pdo->prepare("SELECT id,nome,email,dataDeNascimento,celularContato,img FROM Users where id = :id ;");

        $resuser->execute(['id' => $id]);
        $res = $resuser->fetchAll(\PDO::FETCH_ASSOC);

        if (count($res) === 0)
            return null;

        return $res;
    }

    public function postUser($new_user, $imgname)
    {


        try {

            $resuser = $this->pdo->prepare("INSERT INTO users 
        (Nome, Email, DataDeNascimento, CelularContato, img)  
        VALUES (:nome, :email, :dtNascimento, :celularContato, :img);");


            $resuser->execute([
                'nome' => $new_user['Nome'],
                'email' => $new_user['Email'],
                'dtNascimento' => $new_user['DtNascimento'],
                'celularContato' => $new_user['CelularContato'],
                'img' => $imgname,
            ]);


            $res = $resuser->fetchAll(\PDO::FETCH_ASSOC);
            return true;


        } catch (\PDOException $res) {

            if ($res->getCode() == "23000") {
                return $res->getCode();

            } else {
                return $res->getMessage();
            }

        }




    }


    public function putUsers($id, $name, $email, $dt_birth, $phone, $img)
    {

        try {
            $resuser = $this->pdo->prepare("UPDATE users SET
            nome = :nome,
            email = :email,
            dataDeNascimento = :dataDeNascimento,
            celularcontato = :celularcontato,
            img = :img
            WHERE id = :id");


            $resuser->execute([
                'id' => $id,
                'nome' => $name,
                'email' => $email,
                'dataDeNascimento' => $dt_birth,
                'celularcontato' => $phone,
                'img' => $img,
            ]);


            $res = $resuser->fetchAll(\PDO::FETCH_ASSOC, );

            return true;

        } catch (\PDOException $res) {

            if ($res->getCode() == "23000") {
                return $res->getCode();

            } else {
                return $res->getMessage();
            }

        }







    }


    public function deleteUsers($id)
    {

        $resuser = $this->pdo

            ->prepare("DELETE FROM Users WHERE id = :id;");

        $resuser->execute(['id' => $id]);

        $res = $resuser->fetchAll(\PDO::FETCH_ASSOC);

        if (count($res) === 0)
            return true;


        return false;

    }




}


