<?php


namespace App\Model;


final class UploadImage
{


    public function uploadImages($img)
    {
        $nameImage = $img['name'];

        if ($img['size'] <= 100000) {

            if (!empty($nameImage)) {

                $removeExt = explode('.', $nameImage);
                $newNameImg = uniqid($removeExt[0]) . '.png';
                $nameImg = $newNameImg;

            } else {
                $nameImg = 'fotonullprojectcrudM4rcu5_165849.png';
            }

        } else {

            return $res = ['res' => false, 'msg' => 'Erro Imagem big size'];

        }



        $res = ['newname' => $nameImg, 'res' => true];
        return $res;

    }


}








// if (file_exists($tolocation)) {

//     var_dump($location . '\\' . $nameImg, $tolocation);
//     var_dump(move_uploaded_file($location, $tolocation));


// } else {
//     echo 'diretoria Não existente';
// } -->
