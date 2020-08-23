<?= $render('header-config', ['loggedUser' => $loggedUser]); ?>
<section class="container main">

    <?= $render('sidebar', ['activeMenu' => 'profile', 'loggedUser' => $loggedUser]); ?>

    <section class="feed">

        <?= $render('perfil-header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>

          <div class="col-md-12 ">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Configurações</div>
                        <div class="panel-body">
                            <form action="enviar_mensagem.php" method="post" id="config-form" class="cform">
                                <div>
                                    <label for="nome">Nome Completo</label>
                                    <input type="text" name="name" id="nome"  value="<?= $loggedUser->name; ?>"  required minlength="5" required="required"  />
                                </div>
                                <div>
                                    <label for="birthdate">Data nascimento</label>
                                     <input  type="text" name="birthdate" id = "birthdate" value="<?= date('d/m/Y', strtotime($user->birthdate)); ?>" required="required"  />
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="<?= $loggedUser->email; ?>" required="required"  />
                                </div>

                                <div>
                                    <label for="city">Cidade</label>
                                    <input type="text" name="city" id="city" required minlength="5"  />
                                </div>

                                <div>
                                    <label for="work">Trabalho</label>
                                    <input type="text" name="work" id="work"  required minlength="5"  />
                                </div>

                                <div class="menu-splitter"></div>


                                <div>
                                    <label for="password">Nova senha</label>
                                    <input type="password" name="password" id="password"  />
                                </div>

                                <div>
                                    <label for="new_password">Confirme sua senha</label>
                                    <input type="new_password" name="new_password" id="new_password" />
                                </div>



                                <div>
                                    <input type="submit" value="Enviar" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

    </section>

</section>
<?= $render('footer-config') ?>