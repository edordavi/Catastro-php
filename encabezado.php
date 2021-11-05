<?php
if (!isset($titulo)){
    
$titulo = 'CATASTRO';
    
}
echo <<<HTML
<html lang="es" dir="ltr">
    <head>
        <title>$titulo</title>
        <meta charset="ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/layout.css" type="text/css" media="all">
        <link rel="stylesheet" href="styles/mediaqueries.css" type="text/css" media="all">
        <script src="scripts/jquery.1.9.0.min.js"></script>
        <script src="scripts/jquery-mobilemenu.min.js"></script>
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="styles/ie.css" type="text/css" media="all">
        <script src="scripts/ie/css3-mediaqueries.min.js"></script>
        <script src="scripts/ie/ie9.js"></script>
        <script src="scripts/ie/html5shiv.min.js"></script>
        <![endif]-->
        
    </head>
    <body>
        <div class="wrapper row1">
          <header id="header" class="clear">
            <hgroup>
              <h1>CATASTROS</h1>
            </hgroup>
          </header>
        </div>
            <div class="wrapper row2">
                  <nav id="topnav">
                    <ul class="clear">
                      <li class="active first"><a href="index.php">Inicio</a></li>
                      <li><a href="zona_urbana.php">ZONA URBANA</a></li>
                      <li><a href="vivienda.php">VIVIENDA</a></li>
                    </ul>
                  </nav>
            </div>
        <div class="wrapper row3">
        <div id="container">
    
HTML;

?>
