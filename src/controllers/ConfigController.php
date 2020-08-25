<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;

class ConfigController extends Controller {

    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function settings($atts = []) {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        // Detectando usuário acessado
        $id = $this->loggedUser->id;
        if (!empty($atts['id'])) {
            $id = $atts['id'];
        }
        // Pegando informações do usuário
        $user = UserHandler::getUser($id, true);
        if (!$user) {
            $this->redirect('/');
        }
        // Verificar se EU sigo o usuário
        $isFollowing = false;
        if ($user->id != $this->loggedUser->id) {
            $isFollowing = UserHandler::isFollowing($this->loggedUser->id, $user->id);
        }


        $this->render('config', [
            'loggedUser' => $this->loggedUser,
            'user' => $user,
            'isFollowing' => $isFollowing,
            'flash' => $flash
        ]);
    }

    public function settingsAction() {


        $id = filter_input(INPUT_POST, 'id');
        $new_name = filter_input(INPUT_POST, 'new_name');
        $new_email = filter_input(INPUT_POST, 'new_email', FILTER_VALIDATE_EMAIL);
        $new_birthdate = filter_input(INPUT_POST, 'new_birthdate');
        $password = filter_input(INPUT_POST, 'password');
        $new_password = filter_input(INPUT_POST, 'new_password');
        $new_city = filter_input(INPUT_POST, 'new_city');
        $new_work = filter_input(INPUT_POST, 'new_work');
        $flash = '';
        // Detectando usuário acessado
        $id = $this->loggedUser->id;
        if (!empty($atts['id'])) {
            $id = $atts['id'];
        }

        $email = $this->loggedUser->email;

        // Pegando informações do usuário
        $user = UserHandler::getUser($id, true);
        if (!$user) {
            $this->redirect('/');
        }

        if ($email != $new_email) {
            if (UserHandler::emailExists($new_email) === true) {
                $_SESSION['flash'] = 'E-mail já cadastrado!';
                $this->redirect('/config');
            }
        }



        if ($new_birthdate != '') {
            $new_birthdate = explode('/', $new_birthdate);
            if (count($new_birthdate) != 3) {
                $_SESSION['flash'] = 'Data de nascimento inválida';
                $this->redirect('/config');
            }
            $new_birthdate = $new_birthdate[2] . '-' . $new_birthdate[1] . '-' . $new_birthdate[0];
            if (strtotime($new_birthdate) === false) {
                $_SESSION['flash'] = 'Data de nascimento inválida';
                $this->redirect('/config');
            }
        }

        if (empty($new_name)) {
            $name = $user->name;
        }
        if (empty($new_email)) {
            $new_email = $user->email;
        }
        if (empty($new_birthdate)) {
            $new_birthdate = $user->birthdate;
        }
        if (empty($new_city)) {
            $new_city = $user->city;
        }
        if (empty($new_work)) {
            $new_work = $user->work;
        }
        if (empty($new_avatar)) {
            $new_avatar = $user->avatar;
        }
        if (empty($new_cover)) {
            $new_cover = $user->cover;
        }

        // avatar

        if (isset($_FILES['new_avatar']) && !empty($_FILES['new_avatar']['tmp_name'])) {
            $newAvatar = $_FILES['new_avatar'];
            $oldAvatar = UserHandler::limpaAvatar($id);


            if (in_array($newAvatar['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $avatarName = $this->cutImage($newAvatar, 200, 200, 'media/avatars');
                $new_avatar = $avatarName;

                if ($oldAvatar != 'default.jpg') {
                    unlink("media/avatars/$oldAvatar");
                }
            }
        }


        // cover

        if (isset($_FILES['new_cover']) && !empty($_FILES['new_cover']['tmp_name'])) {
            $newCover = $_FILES['new_cover'];
            $oldCover = UserHandler::limpaCover($id);


            if (in_array($newCover['type'], ['image/jpeg', 'image/jpg', 'image/png'])) {
                $coverName = $this->cutImage($newCover, 850, 310, 'media/covers');
                $new_cover = $coverName;

                if ($oldCover != 'cover.jpg') {
                    unlink("media/covers/$oldCover");
                }
            }
        }





        UserHandler::updateUser($id, $new_name, $new_email, $new_birthdate, $new_city, $new_work, $new_avatar, $new_cover);
        if (($password != '') && ($password === $new_password)) {
            UserHandler::updatepassword($id, $password);
        } else {
            if ($password != $new_password) {
                $_SESSION['flash'] = 'As senhas devem ser iguais!';
                $this->redirect('/config');
            }
        }

        $this->redirect('/config');
    }

    private function cutImage($file, $w, $h, $folder) {

        list($widthOrig, $heightOrig) = getimagesize($file['tmp_name']);
        $ratio = $widthOrig / $heightOrig;

        $newWidth = $w;
        $newHeight = $newWidth / $ratio;

        if ($newHeight < $h) {
            $newHeight = $h;
            $newWidth = $newHeight * $ratio;
        }



        $x = $w - $newWidth;
        $y = $h - $newHeight;
        $x = $x < 0 ? $x / 2 : $x;
        $y = $y < 0 ? $y / 2 : $y;





        $finalImage = imagecreatetruecolor($w, $h);
        switch ($file['type']) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefromjpng($file['tmp_name']);
                break;
        }
        imagecopyresampled($finalImage, $image, $x, $y, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);

        $fileName = md5(time() . rand(0, 9999)) . '.jpg';
        imagejpeg($finalImage, $folder . '/' . $fileName, 64);
        return $fileName;
    }

}
