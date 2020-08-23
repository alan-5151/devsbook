<?= $render('header-config', ['loggedUser' => $loggedUser]); ?>
<section class="container main">
    <?= $render('sidebar', ['activeMenu' => 'config', 'loggedUser' => $loggedUser]); ?>
    <section class="feed">
        <?= $render('perfil-header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>
        <div class="row">
            <div class="column pr-5">

                <div class="col-md-12 ">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Configurações</div>
                        <div class="panel-body">
                            <form action="enviar_mensagem.php" method="post" id="form_contato" class="form">
                                <div class="form-group">
                                    <label for="nome">Nome Completo</label>
                                    <input type="text" name="name" id="nome" required minlength="5" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Data nascimento</label>
                                    <!--input type="email" name="email" id="email" required class="form-control" -->
                                    <input id = "birthdate"   type="text" name="birthdate" required class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" required class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="city">Cidade</label>
                                    <input type="text" name="city" id="city" required minlength="5" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="work">Trabalho</label>
                                    <input type="text" name="work" id="work" required minlength="5" class="form-control" />
                                </div>

                                <div class="menu-splitter"></div>


                                <div class="form-group">
                                    <label for="password">Nova senha</label>
                                    <input type="password" name="password" id="password" required minlength="5" class="form-control" />
                                </div>

                                <div class="form-group">
                                    <label for="new_password">Confirme sua senha</label>
                                    <input type="new_password" name="new_password" id="new_password" required minlength="5" class="form-control" />
                                </div>



                                <div>
                                    <input type="submit" class="btn btn-success" value="Enviar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
            <div class="column side pl-5">
                <div class="box banners">
                    <div class="box-header">
                        <div class="box-header-text">Patrocinios</div>
                        <div class="box-header-buttons">

                        </div>
                    </div>
                    <div class="box-body">
                        <a href=""><img src="https://alunos.b7web.com.br/media/courses/php-nivel-1.jpg" /></a>
                        <a href=""><img src="https://alunos.b7web.com.br/media/courses/laravel-nivel-1.jpg" /></a>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body m-10">
                        Criado com ❤️ por B7Web
                    </div>
                </div>
            </div>
        </div>

    </section>
</section>
<?= $render('footer-config') ?>