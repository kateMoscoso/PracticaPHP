<!DOCTYPE html>

<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <base href="<?= URL_BASE ?>">
    
    <title>[MiM]: <?= $titulo ?></title>
    <!-- JQuery -->



<script type="text/javascript" src="/linker/js/vendor/bootstrap.js"></script>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="public/styles.css">
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="bootstrap.css" rel="stylesheet">
    
  </head>

  <body bgcolor='white' text='navy'>
      
    <!-- barra de navegación estática superior -->
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav nav-tabs">
            <li><a href='artistas'><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Intérpretes</a></li>
            <li><a href='album'><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Álbumes</a></li>
            <li><a href='temas'><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Temas</a></li>
           
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favoritos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="favoritos/artistas">Intérpretes</a></li>
                <li><a href="favoritos/albumes">Álbumes</a></li>
                <li><a href="favoritos/temas">Temas</a></li>       
                <!-- li class="divider"></li -->
                <!-- li class="dropdown-header">Nav header</li -->
                <!-- li><a href="#">Separated link</a></-->
              </ul>
            </li>
            
            <?php
              // Si está registrado y es administrador -> desplegable de gestión de usuarios
              if (isset($_SESSION['usuario']) && $_SESSION['esAdmin']): 
            ?>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>
                    Usuarios <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="usuario/listado">Gestión de Usuarios</a></li>
                  <li><a href="usuario/nuevo">Nuevo Usuario</a></li>
                </ul>
              </li>           
            <?php endif; ?>
            <li class="navbar-right">
              <?php if (!isset($_SESSION['usuario'])): ?>
                <form class="navbar-form navbar-right form-inline" role="form" action='login' method='post'>
                  <div class="form-group">
                      <input type="text" placeholder="Usuario" name="usuario" class="form-control" required="required">
                  </div>
                  <div class="form-group">
                    <input type="password" placeholder="Password" name="pclave" class="form-control" required="required">
                  </div>
                  <button type="submit" class="btn btn-success btn-xlarge">Login <span class="glyphicon glyphicon-log-in naranja" aria-hidden="true"></span></button>
                </form>
              <?php else: ?>
                <form class="navbar-form navbar-right form-inline" role="form" action='logout' method='get'>
                  <button type="submit" class="btn btn-warning btn-xlarge">
                    <?= sprintf("%15s", $_SESSION['usuario']) ?> <span class="glyphicon glyphicon-log-out naranja" aria-hidden="true"></span>
                  </button>
                </form>
                
              <?php endif; ?>
              <?php   if (isset($_SESSION['usuario']) && !$_SESSION['esAdmin']): ?>
                <li><a href='perfil'><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Perfil</a></li>
                <?php endif; ?>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div><!--/.container-fluid -->
    </nav>
      
   
    <?= $contenido ?>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
  </body>
</html>