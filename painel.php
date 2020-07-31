<?php
session_start();

?>

<h2>Olá, <?php echo $_SESSION['usuario'];?></h2>
<h2><a href="logout.php">Sair</a></h2>
<h2><a href="agenda.php">Agenda</a></h2>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel - Projeto Viveiro</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script type="text/javascript" src="js/login.js"></script>
</head>
<section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Projeto Viveiro</h3>
                    <h3 class="title has-text-grey">Painel</h3>
                    <div class="box">
                        <form class="form" method="POST">
                            <button onclick="window.open('agenda.php')" class="button is-block is-link is-large is-fullwidth">Agenda</button>
                            <div class="field">
                                <div>
                                    
                                </div>
                            </div>
                            <button onclick="window.open('logout.php')" class="button is-block is-link is-large is-fullwidth">Sair</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</html>
