<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\models\User;

class LoginController extends Controller {

    public function signin() {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signin', [
            'flash' => $flash
        ]);
    }

    public function signinAction() {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');



        if ($email && $password) {
            $token = UserHandler::verifyLogin($email, $password);


            if ($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'Dados incorretos!';
                $this->redirect('/login');
            }
        } else {
            $this->redirect('/login');
        }
    }

    public function signup() {
        $flash = '';
        if (!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('signup', [
            'flash' => $flash
        ]);
    }

    public function signupAction() {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');


        if ($name && $email && $password && $birthdate) {

            $birthdate = explode('/', $birthdate);
            if (count($birthdate) != 3) {
                $_SESSION['flash'] = 'Data de nascimento inválida';
                $this->redirect('/cadastro');
            } // fim if count

            $birthdate = $birthdate[2] . "-" . $birthdate[1] . "-" . $birthdate[0];

            if (strtotime($birthdate) === false) {
                $_SESSION['flash'] = 'Data de nascimento inválida';
                $this->redirect('/cadastro');
            } // fim strtotime

            if (UserHandler::emailExists($email) === false) {
                 // $token = UserHandler::addUser($email, $password, $name, $birthdate);

                $hash = password_hash($password, PASSWORD_DEFAULT);
                $token = md5(time() . rand(0, 9999) . time());

                User::insert([
                    'email' => $email,
                    'password' => $password,
                    'name' => $name,
                    'birthdate' => $birthdate,
                    'token' => $token,
                ])->execute();

                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'Email já cadastrado';
                $this->redirect('/cadastro');
            }
        } else {
            $_SESSION['flash'] = 'Preencha todos os campos';
            $this->redirect('/cadastro');
        } // fim do if name email password birthdate
    }

    public function logout() {
        session_destroy();
        $_SESSION['token'] = '';
        $this->redirect('/login');
    }

// fim da função signupAction
}

// fim class
