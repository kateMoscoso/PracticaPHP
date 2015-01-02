<?php // views/errorAcceso.php
  $titulo = 'Acceso Denegado';

  ob_start();
?>

  <div class="container">
    <div class="panel  panel-danger">
      <div class="panel-heading">
        <h1>
            <span class="glyphicon glyphicon-ban-circle rojo" aria-hidden="true"></span>
            ¡Acceso Denegado! <small>(no dispone de permisos suficientes)</small>
        </h1>
      </div>
      <div class="panel-body">
          <p class="lead">Lo sentimos, la opción: <code><?= $path ?></code> no está disponible
              según su perfil de usuario.</p>
          <p><a class="btn btn-primary btn-lg" href="/" role="button">Inicio &raquo;</a></p>
      </div>
    </div>
  </div>

<?php

  $contenido = ob_get_clean();

  include 'layout.php';
