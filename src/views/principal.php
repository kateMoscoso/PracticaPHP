<?php // views/principal.php
  $titulo = 'PHP: Mi música';

  ob_start();  
?>
    <div class="jumbotron">
      <div class="container">
        <h1>¡Bienvenido!</h1>
        <p>Esta aplicación pretende ser un ejemplo de uso de varias técnicas:
          <ul>
            <li>Por un lado, accede a datos externos empleando la
                <a href='https://developer.spotify.com/web-api/endpoint-reference/' target='_blank'>API REST de Spotify</a></li>
            <li>Por otro accede a datos locales a los que se accede empleando la capa de
            abstracción <a href='http://www.doctrine-project.org/projects/dbal.html' target='_blank'
            title='Doctrine Database Abstraction Layer'>Doctrine DBAL</a></li>
            <li>Además, también se emplea el framework HTML, CSS y JS <a href='http://getbootstrap.com/'
                target='_blank' title='Bootstrap framework'>Boostrap</a></li>
          </ul>
        </p>
        <p><a class="btn btn-primary btn-lg" href="mas_info" role="button">Seguir leyendo &raquo;</a></p>
      </div>
    </div>
    
    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Artistas</h2>
          <p>A través de esta opción puede obtener información de sus artistas preferidos,
              escuchar sus trabajos y marcarlos como favoritos para poder recuperarlos cuando desee.
          </p>
          <p><a class="btn btn-primary" href="artistas" role="button">Buscar Artistas &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Álbumes
              <a href='http://lema.rae.es/dpd/srv/search?id=Kj74deVh7D6N8n0ZkD' target='_blank'><sup>*</sup></a></h2>
          <p>También podrá realizar búsquedas a traves de los nombre de los álbumes que más
              le gusten, ver la información del mismo y guardar sus álbumes favoritos.
          </p>
          <p><a class="btn btn-primary" href="albumes" role="button">Buscar Álbumes &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Temas</h2>
          <p>De igual forma, podrá buscar toda la información relativa a sus temas favoritos,
              así como escucharlos desde aquí mismo.
          </p>
          <p><a class="btn btn-primary" href="temas" role="button">Buscar Temas &raquo;</a></p>
        </div>
      </div>

      <hr>
      <footer>
        <p>&copy; [UPM] MiW Práctica PHP 2014</p>
      </footer>
    </div> <!-- /container -->
  
<?php 
  
  $contenido = ob_get_clean();
  
  include 'layout.php';
  