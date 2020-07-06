<?php
session_start();
?>


<!DOCTYPE html>
<html>
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Projeto Viveiro</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script type="text/javascript" src="js/login.js"></script>
</head>

<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Projeto Viveiro</h3>
                    <h3 class="title has-text-grey">Login</h3>
                    <?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                        <div class='notification is-danger'>
                        <p>ERRO: Usuário ou senha inválidos.</p>
                        </div>
                    <?php
                    endif;
                    unset($_SESSION['nao_autenticado']);                    
                    ?>

                    <div class="box">
                        <form class="form" action="login.php" method="POST" onsubmit = "verifica_vazio()" >
                            <div class="field">
                                <div class="control">
                                    <input name="usuario" type="text" class="input is-large usuario" placeholder="Seu usuário" autofocus="">
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large senha" type="password" placeholder="Sua senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                            <div class="field">
                                <div>
                                    
                                </div>
                            </div>
                            <button onclick="window.open('cadastro.php')" class="button is-block is-link is-large is-fullwidth">Inscreva-se</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>