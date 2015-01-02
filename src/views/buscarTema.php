<?php // views/buscaArtista.php
  $titulo = 'Buscar tema';

  ob_start();  
?>
  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>
            <span class="glyphicon glyphicon-music" aria-hidden="true"></span> 
            Temas: <small>Buscando nuestros temas favoritos</small>
        </h1>
        <p class="lead">Desde aquí puede obtener la información de sus temas preferidos:</p>
      </div>
      <div class="panel-body">
        <form role="form" class="form-horizontal" method='post' action='buscaTema'>
          <div class="form-group">
            <label for="tema" class="col-sm-2 control-label">Temas:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name='tema' id="tema" placeholder="Tema" required="required">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="col-sm-offset-2 col-sm-1 btn btn-primary">Buscar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php 
  
  $contenido = ob_get_clean();
  
  include 'layout.php';
  