<?php
// views/muestraArtista.php

$titulo = 'intérpretes encontrados';

ob_start();

if (empty($infoArtista)):
    print <<< '____MARCA_FINAL'
      <div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h1>
                <small><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Intérprete:</small>
                <mark>Artista no encontrado</mark>
            </h1>
          </div>
          <div class="panel-body">
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
          </div>
        </div>
      </div>
____MARCA_FINAL;
else:
    ?>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>
                    <small><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Intérprete:</small>
                    <mark><?= $infoArtista['name'] ?></mark>
                    <?php
                    if (!empty($listaArtistas)&& array_search($infoArtista['id'], $listaArtistas)) {
                            print '  <span class="glyphicon glyphicon-star" aria-hidden="true" title="Favorito Existente"></span>';
                        
                    } else {
                        ?>
                    <a href="favorito/artista/nuevo/<?= $infoArtista['id'] ?>">
                      <span class="glyphicon glyphicon-star-empty" aria-hidden="true" title="Marcar Favorito" "></span>
                    </a>
                          <?php
                      }
                    ?>
                </h1>
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-4">
                        <p class="text-left">
                            <img src="<?= @$infoArtista['images'][0]['url'] ?>" class="img-responsive" alt="<?= 'Imagen ' . $infoArtista['name'] ?>"><br>
                            <a href='<?= $infoArtista['external_urls']['spotify'] ?>' target='_blank' 
                               title='Escuchar en Spotify'><img src="public/logoSpotify.png" 
                                                             class="img-responsive" alt="Spotify"></a>
                        </p>
                    </div>
                    <div class="col-md-8">
                        <?php
                        require 'muestraListadoAlbumes.php';

                        if ($limite == 5):
                            print '<a href="artista/' . $infoArtista['id'] . '/50" class="btn btn-info" role="button">';
                            print 'Más resultados &raquo;</a>';
                        endif;
                        ?>
                    </div>
                </div>            

            </div>
        </div> <!-- panel panel-default -->
    </div> <!-- container -->

<?php
endif;

$contenido = ob_get_clean();

include 'layout.php';
