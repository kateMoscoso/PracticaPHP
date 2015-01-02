<?php // views/buscaArtista.php
  $titulo = 'Nuevo usuario';

  ob_start();  
?>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>
            <span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> 
            Usuarios: <small>Dar de alta un nuevo usuario</small>
        </h1>
        <p class="lead">Desde aquí puede añadir un nuevo usuario:</p>
      </div>
      <div class="panel-body">
        <form role="form" class="form-horizontal" method='post' action='usuario/nuevo'>
            
          <!-- div class="input-group input-group-lg">
            <span class="input-group-addon">Usuario:</span>
            <input type="text" class="form-control" name='usuario[username]' id="username" placeholder="Usuario" required="required">
          </div -->
            
          <div class="form-group">
            <label for="username" class="col-sm-2 control-label">Usuario:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name='usuario[username]' id="username" placeholder="Usuario" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="nombre" class="col-sm-2 control-label">Nombre:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name='usuario[nombre]' id="nombre" placeholder="Nombre" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Contraseña:</label>
            <div class="col-sm-4">
                <input type="password" class="form-control" name='usuario[password]' id="password" placeholder="password" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-4">
                <input type="email" class="form-control" name='usuario[email]' id="email" placeholder="E-mail">
            </div>
          </div>
          <div class="form-group">
            <label for="admin" class="col-sm-2 control-label">Administrador:</label>
            <div class="col-sm-4">
                <input type="checkbox" class="form-control" name='usuario[esAdmin]' id="admin" value="1">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="col-sm-offset-2 col-sm-1 btn btn-primary">Añadir</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php 
  
  $contenido = ob_get_clean();
  
  include 'layout.php';
  