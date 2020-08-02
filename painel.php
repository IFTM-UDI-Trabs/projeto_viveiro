<?php
session_start();

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;1,100;1,300;1,500&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/painel.css">
    </head>
    <body>
        <div id="nav">
            <img class="img" src="img/viveiro_logo.png" alt="Logo Viveiro">
            <h2>Olá <?php echo $_SESSION['usuario'];?></h2>
            <nav class="buttons">
                <a href="logout.php">Sair</a>
                <a href="agenda.php">Agenda</a>
            </nav>
        </div>
    </body>
</html>