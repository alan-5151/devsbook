<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\UserHandler;
use \src\handlers\PostHandler;

class AjaxController extends Controller {

    private $loggedUser;
    
    
    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if ($this->loggedUser === false) {
            header("Content-Type: application/json");
            echo json_encode(['error' => 'Usuário não logado']);
            exit;
        }
    }

    public function like($atts) {
        $id = $atts['id'];

        if (PostHandler::isLiked($id, $this->loggedUser->id)) {
            PostHandler::deleteLike($id, $this->loggedUser->id);
        } else {
            PostHandler::addLike($id, $this->loggedUser->id);
        }
    }

    public function comment() {
        $array = ['error' => ''];
 print_r($loggedUser);
 exit;
        $id = filter_input(INPUT_POST, 'id');
        $txt = filter_input(INPUT_POST, 'txt');

        if ($id && $txt) {
            PostHandler::addComment($id, $txt, $this->loogedUserId->id);

            $array['link'] = '/perfil/' . $this->loogedUser->id;
            $array['avatar'] = '/media/avatars/' . $this->loogedUser->avatar;
            $array['name'] = $this->loogedUser->name;
            $array['body'] = $txt;
        }

        header("Content-Type: application/json");
        echo json_encode($array);
        exit;
    }

}
