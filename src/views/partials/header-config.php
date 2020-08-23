<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Devsbook</title>
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1" />
        <link rel="stylesheet" href="<?= $base; ?>/assets/css/style.css" />
        <style>
.cform input, select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 15px;
  font-weight: bold;
  color: #000;
}

.cform input[type=submit] {
  width: 100%;
  background-color: #4a76a8;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.cform input[type=submit]:hover {
  background-color: #224b7a;
}

.cform div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 10px;
}
</style>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="logo">
                    <a href="<?= $base; ?>"><img src="<?= $base; ?>/assets/images/devsbook_logo.png" /></a>
                </div>
                <div class="head-side">
                    <div class="head-side-left">
                        <div class="search-area">
                            <form method="GET" action="<?= $base; ?>/pesquisa">
                                <input type="search" placeholder="Pesquisar" name="s" />
                            </form>
                        </div>
                    </div>
                    <div class="head-side-right">
                        <a href="<?= $base; ?>/perfil" class="user-area">
                            <div class="user-area-text"><?= $loggedUser->name; ?></div>
                            <div class="user-area-icon">
                                <img src="<?= $base; ?>/media/avatars/<?= $loggedUser->avatar; ?>" />
                            </div>
                        </a>
                        <a href="<?= $base; ?>/sair" class="user-logout">
                            <img src="<?= $base; ?>/assets/images/power_white.png" />
                        </a>
                    </div>
                </div>
            </div>
        </header>
