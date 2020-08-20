<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Login - Devsbook</title>
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
        <link rel="stylesheet" href="<?= $base ?>/assets/css/login.css" />
    </head>
    <body>
        <header>
            <div class="container">
                <a href=""><img src="<?= $base ?>/assets/images/devsbook_logo.png" /></a>
            </div>
        </header>
        <section class="container main">
            <form method="POST" action="<?= $base; ?>/login">
                <?php if (!empty($flash)): ?>
                    <div class="flash"> <?php echo $flash; ?> </div>
                <?php endif; ?>
                <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

                <input placeholder="Digite sua senha" class="input" type="password" name="password" />
                <input type="hidden" name="token" value ="2b0cb1614fc3ce3847a1a434dea4687a" />

                <input class="button" type="submit" value="Acessar o sistema" />

                <a href="<?= $base; ?>/cadastro">Ainda não tem conta? Cadastre-se</a>
            </form>
        </section>
    </body>
</html>
