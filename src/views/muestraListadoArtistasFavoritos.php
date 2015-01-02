<?php // views/muestraListadoArtistas.php

  $titulo = 'intérpretes encontrados';

  ob_start();
?>

  <div class="container">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h1>
            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> 
            Intérpretes: <small>Lista de Intérpretes Favoritos</small>
        </h1>
        <p class="lead">Lista de sus artista favoritos.</p>
      </div>
      <div class="panel-body">
        <div class="table-responsive">          
          <?php
            if (!empty($artistas) ){
              print '<div class="panel panel-default">';
              print '  <table class="table table-striped table-condensed">';
              foreach ($artistas['artists'] as $artista) {
                  
                  if (count($artista['images']) > 2) {
                      $imagen = $artista['images'][2]['url'];
                  } else {
                      $imagen = '';
                  }
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
                      <td>
                           <!-- Button trigger modal -->
                          <a href="#" class="btn btn-info" aria-hidden="true" class="glyphicon glyphicon-trash" data-toggle="modal" data-target="#basicModal$id">
                            <span class="glyphicon glyphicon-trash"></span> 
                          </a>                     
                        <!-- Modal -->
                        <div class="modal fade" id="basicModal$id" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Eliminar elemento</h4>
                                </div>
                                <div class="modal-body">
                                    <h3>¿Esta seguro que desea eliminar el Artista  ?</h3>
                                </div>
                                <div class="modal-footer">
                                     <a href="#" class="btn" data-dismiss="modal">No</a>
                                     <a href="favoritos/borrar/artista/$id?>" class="btn btn-primary">Si</a>
                                </div>
                            </div>
                        </div>
                    </div>
                          
                      </td>
                    </tr>
____________________MARCA_FINAL;
              }
              print '  </table>';
              print '</div>';
              }
            else{
              print <<< '________________MARCA_FINAL'
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                  <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <h4>¡Su lista de intérpretes esta vacia!</h4>
                </div>
                <p>
                  <a href="artistas">
                    <button type="button" class="btn btn-primary btn-lg">Buscar Intérpretes</button>
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
