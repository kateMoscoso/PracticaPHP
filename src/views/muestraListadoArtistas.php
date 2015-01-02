<?php // views/muestraListadoArtistas.php

  $titulo = 'intérpretes encontrados';

  ob_start();
?>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
            Intérpretes: <small>Resultado de la búsqueda</small>
        </h1>
        <p class="lead">Resultados de la búsqueda de sus artistas preferidos.</p>
      </div>
      <div class="panel-body">
        <div class="table-responsive">          
          <?php
            if (isset($artistas) ){
              if (isset($artistas['artists']['items']) ){
                $artistas =$artistas['artists']['items'];
              }
              print '<div class="panel panel-default">';
              print '  <table class="table table-striped table-condensed">';
              
              foreach ($artistas as $artista) {
                  
                  if (count($artista['images']) > 2) {
                      $imagen = $artista['images'][2]['url'];
                  } else {
                      $imagen = '';
                  }
                  // var_dump($artista);
                  $popularidad = sprintf("%02d", $artista['popularity']);
                  $name = $artista['name'];
                  $id = $artista['id'];
                  print <<< ____________________MARCA_FINAL
                    <tr>
                      <td>
                        <a href='artista/$id'>
                          <button class="btn btn-primary" type="button">
                            <img src='$imagen' width='64' height='64' alt='Imagen $name' title='$name'>
                            <span class="badge" title="Popularidad">$popularidad</span>
                          </button>
                        </a>
                      </td>
                      <td><h2>$name</h2></td>
                    </tr>
____________________MARCA_FINAL;
              }
              print '  </table>';
              print '</div>';
              }
            else{
              print <<< '________________MARCA_FINAL'
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <h4>¡No se han encontrado resultados!</h4>
                </div>
                <p>
                  <a href="artistas">
                    <button type="button" class="btn btn-primary btn-lg">Nueva Búsqueda</button>
                  </a>
                </p>
________________MARCA_FINAL;
            }
          ?>
        </div>
      </div>
    </div>

  </div>

<?php

  $contenido = ob_get_clean();

  include 'layout.php';
