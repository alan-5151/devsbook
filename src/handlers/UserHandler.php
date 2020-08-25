<?php

namespace src\handlers;

use \src\models\User;
use \src\models\UserRelation;
use \src\handlers\PostHandler;

class UserHandler {

    public static function checkLogin() {


        if (!empty($_SESSION['token'])) {


            $token = $_SESSION['token'];

            $data = User::select()->where('token', $token)->one();

            if (count($data) > 0) {

                $loggedUser = new User();
                $loggedUser->id = $data['id'];
                $loggedUser->email = $data['email'];
                $loggedUser->name = $data['name'];
                $loggedUser->avatar = $data['avatar'];
                $loggedUser->cover = $data['cover'];

                return $loggedUser;
            }
        } return false;
    }

    public static function verifyLogin($email, $password) {
        $user = User::select()->where('email', $email)->one();

        if ($user) {



            if (!password_verify($password, $user['password'])) {
                echo "Senha não confere";
            }
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

    public static function limpaAvatar($id) {
        $data = User::select()->where('id', $id)->one();

        if ($data) {
            $user = new User();
            $user->avatar = $data['avatar'];
                    }
       return $oldAvatar = $user->avatar;
    }

    public static function limpaCover($id) {
        $data = User::select()->where('id', $id)->one();

        if ($data) {
            $user = new User();
            $user->cover = $data['cover'];
        }
        return $user->cover;
    }

    public function getUser($id, $full = false) {
        $data = User::select()->where('id', $id)->one();

        if ($data) {
            $user = new User();
            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->birthdate = $data['birthdate'];
            $user->city = $data['city'];
            $user->work = $data['work'];
            $user->avatar = $data['avatar'];
            $user->cover = $data['cover'];

            if ($full) {
                $user->followers = [];
                $user->following = [];
                $user->photos = [];


                //followers
                $followers = UserRelation::select()->where('user_to', $id)->get();
                foreach ($followers AS $follower) {
                    $userData = User::select()->where('id', $follower['user_from'])->one();

                    $newUser = new User();
                    $newUser->id = $userData['id'];
                    $newUser->name = $userData['name'];
                    $newUser->avatar = $userData['avatar'];

                    $user->followers[] = $newUser;
                }


                //following
                $following = UserRelation::select()->where('user_from', $id)->get();
                foreach ($following AS $follower) {
                    $userData = User::select()->where('id', $follower['user_to'])->one();

                    $newUser = new User();
                    $newUser->id = $userData['id'];
                    $newUser->name = $userData['name'];
                    $newUser->avatar = $userData['avatar'];

                    $user->following[] = $newUser;
                }


                //photos
                $user->photos = PostHandler::getPhotosFrom($id);
            }

            return $user;
        }

        return false;
    }

    public function addUser($email, $password, $name, $birthdate) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token = md5(time() . rand(0, 9999) . time());


        User::insert([
            'email' => $email,
            'password' => $hash,
            'name' => $name,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();


        return $token;
    }

    public static function isFollowing($from, $to) {
        $data = UserRelation::select()
                ->where('user_from', $from)
                ->where('user_to', $to)
                ->one();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public static function idExists($id) {
        $user = User::select()->where('id', $id)->one();
        return $user ? true : false;
    }

    public static function follow($from, $to) {

        UserRelation::insert([
            'user_from' => $from,
            'user_to' => $to
        ])->execute();
    }

    public static function unfollow($from, $to) {
        UserRelation::delete()
                ->where('user_from', $from)
                ->where('user_to', $to)
                ->execute();
    }

    public static function searchUser($term) {
        $users = [];
        $data = User::select()->where('name', 'like', '%' . $term . '%')->get();

        if ($data) {
            foreach ($data AS $user) {
                $newUser = new User();
                $newUser->id = $user['id'];
                $newUser->name = $user['name'];
                $newUser->avatar = $user['avatar'];

                $users[] = $newUser;
            }
        }

        return $users;
    }

    // config


    public static function updateUser($id, $new_name, $new_email, $new_birthdate, $new_city, $new_work, $new_avatar, $new_cover) {
        $user = User::select()->where('id', $id)->one();

        if ($user) {
            User::update()
                    ->set('name', $new_name)
                    ->set('email', $new_email)
                    ->set('birthdate', $new_birthdate)
                    ->set('city', $new_city)
                    ->set('work', $new_work)
                    ->set('avatar', $new_avatar)
                    ->set('cover', $new_cover)
                    ->where('id', $id)
                    ->execute();
        }
    }

    public static function updatePassword($id, $password) {
        $user = User::select()->where('id', $id)->one();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($hash) {
            User::update()
                    ->set('password', $hash)
                    ->where('id', $id)
                    ->execute();
        }
    }

}

// fim da classe
