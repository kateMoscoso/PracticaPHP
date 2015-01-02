<?php // views/noImplementado.php
  $titulo = 'PHP: Mi música';

  ob_start();  
?>

  <div class="container">
    <div class="panel  panel-danger">
      <div class="panel-heading">
        <h1>
            <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> 
            ¡Trabajando! <small>(aún nos queda trabajo por hacer...)</small>
        </h1>
      </div>
      <div class="panel-body">
          <p class="lead">Lo sentimos, la opción: <code><?= $path ?></code> aún no ha sido desarrollada.</p>
          <p><a class="btn btn-primary btn-lg" href="/" role="button">Inicio &raquo;</a></p>
      </div>
    </div>
  </div>
  
<?php 
  
  $contenido = ob_get_clean();
  
  include 'layout.php';
  