<?php

namespace src\handlers;

use \src\models\User;

class LoginHandler {

    public static function checkLogin() {

        $_SESSION['token'] = '2b0cb1614fc3ce3847a1a434dea4687a';
        
      if (!empty($_SESSION['token'])) {

            $token = $_SESSION['token'];
           

            $data = User::select()->where('token', $token)->one();

            if (count($data) > 0) {

                $loggedUser = new User();
                $loggedUser->id = $data['id'];
                $loggedUser->email = $data['email'];
                $loggedUser->name = $data['name'];
            }
        } return false;
    }

    public static function verifyLogin($email, $senha) {
        $user = User::select()->where('email', $email)->one();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $token = md5(time() . rand(0, 9999) . time());

                User::update()
                        ->set('token', $token)
                        ->where('email', $email)
                        ->execute();

                return $token;
            }
        }
        return false;
    }

    public function emailExists($email) {
        $user = User::select()->where('email', $email)->one();
        return $user ? true : false;
    }

    public function addUser($name, $email, $password, $birthdate) {
        $hash = md5($email . $password);
        $token = md5(time() . rand(0, 9999) . time());


        User::insert([
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();

        return $token;
    }

}

// fim da classe
