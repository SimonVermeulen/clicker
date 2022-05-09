<!DOCTYPE html>
<html lang="fr">
  <head>
    <title>
      <?= isset($title) ? $title : 'SmartClick - Ne deviens pas addict' ?>
    </title>
               
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/style.css" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    
    <style>
    	body {
      		font-family: 'Roboto', sans-serif !important;
        }
  	</style>
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>

  <body>
      <header class="page-header">
            <div class="btn-group ecran-tel col-xs-2 col-xs-offset-1 menu-tel">
              <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Menu</button>
              <ul class="dropdown-menu">
                <?php if ($user->isAuthenticated()) { ?>
                <li><a href="/">Accueil</a></li>
                <?php } else{ ?>
                <li><a href="/">Accueil</a></li>
                <li><a href="/register.html">Incription</a></li>
                <li><a href="/login.html">Connexion</a></li>
                <?php } ?>            
              </ul>
            </div>
        <div class="row barre-header">
          <nav class="col-md-6">
            <ul class="row ecran-pc">
              <?php if ($user->isAuthenticated()) { ?>
              <li class="col-md-2"><a href="/">Accueil</a></li>
              <?php } else{ ?>
              <li class="col-md-2"><a href="/">Accueil</a></li>
              <li class="col-md-2"><a href="/register.html">Incription</a></li>
              <li class="col-md-2"><a href="/login.html">Connexion</a></li>
              <?php } ?>            
            </ul>
          </nav>  
        <?php if(isset($indexfront)){
          ?>
          <button id="save">SAUVEGARDE</button>
          <?php
		}
        ?>
        </div>
    </header>

      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;" class="flash">', $user->getFlash(), '</p>'; ?>
 
          <?= $content ?>
        </section>
      </div>
  </body>
</html>