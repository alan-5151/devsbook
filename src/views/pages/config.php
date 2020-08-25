<?= $render('header', ['loggedUser' => $loggedUser]); ?>
<section class="container main">

    <?= $render('sidebar', ['activeMenu' => 'profile', 'loggedUser' => $loggedUser]); ?>

    <section class="feed">
        <?= $render('perfil-header', ['user' => $user, 'loggedUser' => $loggedUser, 'isFollowing' => $isFollowing]); ?>
        <div class="col-md-12 ">
            <div class="panel panel-primary">
                <div class="panel-heading"><h1>Configurações</h1></div>
                <div class="panel-body">
                    <form action="<?= $base; ?>/config" method="POST" id="config-form" class="cform" enctype="multipart/form-data">
                        <?php if (!empty($flash)): ?>
                            <div class="flash"> <?php echo $flash; ?> </div>
                        <?php endif; ?>
                            <div>
                            <label for="avatar">Novo avatar</label>
                            <input type="file" name="new_avatar" id="avatar" />
                        </div>
                            <div>
                            <label for="cover">Nova capa</label>
                            <input type="file" name="new_cover" id="cover" />
                        </div>
                            
                            <div class="menu-splitter"></div>
                            
                        <div>
                            <label for="nome">Nome Completo</label>
                            <input type="text" name="new_name" id="nome"  value="<?= $loggedUser->name; ?>"  required minlength="3" />
                        </div>
                        <div>
                            <label for="birthdate">Data nascimento</label>
                            <input  type="text" name="new_birthdate" id = "birthdate" value="<?= date('d/m/Y', strtotime($user->birthdate)); ?>" required="required"  />
                        </div>
                        <div>
                            <label for="email">Email</label>
                            <input type="email" name="new_email" id="email" value="<?= $loggedUser->email; ?>" required="required"  />
                        </div>

                        <div>
                            <label for="city">Cidade</label>
                            <input type="text" name="new_city" id="city" value="<?= $user->city; ?>" />
                        </div>

                        <div>
                            <label for="work">Trabalho</label>
                            <input type="text" name="new_work" id="work" value="<?= $user->work; ?>" />
                        </div>

                        <div class="menu-splitter"></div>


                        <div>
                            <label for="password">Nova senha</label>
                            <input type="password" name="password" id="password"  />
                        </div>

                        <div>
                            <label for="password1">Confirme sua senha</label>
                            <input type="password" name="new_password" id="password1" />
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