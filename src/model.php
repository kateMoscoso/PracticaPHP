<?php

// model.php

namespace MiW\PracticaPHP\Model;

/* * *
 * El fichero tiene dos partes: una primera con las funciones de acceso a datos externos (Spotify)
 * y la segunda proporciona el acceso a la base de datos mediante Doctrine DBAL
 */

/* * * *******************************************************************
 * Primera parte: Datos externos
 *
 * Referencia: https://developer.spotify.com/web-api/endpoint-reference/
 */

class datosExternos {

    /**
     * Obtiene un listado de artistas coincidentes con la cadena $artista
     * @param string $artista Cadena de caracteres
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/search-item/ API Info
     */
    public static function buscarArtista($artista) {
        $peticion = SPOTIFY_URL_API . '/v1/search?q=' . urlencode($artista) . '&type=artist&market=ES';
        $datos = @file_get_contents($peticion);
        $artistas = json_decode($datos, true);

        return $artistas;
    }

    /**
     * Obtiene la información de un artista concreto (identificado por $artistaId)
     * @param string $artistaId Identificador del artista en Spotify
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/get-artist/ API Info
     */
    public static function obtenerArtista($artistaId) {
        $peticion = SPOTIFY_URL_API . '/v1/artists/' . $artistaId;
        $datos = @file_get_contents($peticion);
        $info = json_decode($datos, true);

        return $info;
    }

    /**
     * Obtiene un listado de albums coincidentes con la cadena $album
     * @param string $album Cadena de caracteres
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/search-item/ API Info
     */
    public static function buscaAlbum($album) {
        $peticion = SPOTIFY_URL_API . '/v1/search?q=' . urlencode($album) . '&type=album&market=ES';
        $datos = @file_get_contents($peticion);
        $albumes = json_decode($datos, true);

        return $albumes;
    }

    /**
     * Obtiene la información de un álbum concreto (identificado por $albumId)
     * @param string $albumId Identificador del álbum en Spotify
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/get-album/ API Info
     */
    public static function obtenerAlbum($albumId) {
        $peticion = SPOTIFY_URL_API . '/v1/albums/' . $albumId;

        $datos = @file_get_contents($peticion);
        $info = json_decode($datos, true);

        return $info;
    }

    /**
     * Obtiene la información de una lista de favoritos (lista de albumes $listaAlbumId)
     * @param string $listaFavoritosId lista de identificadores de los favoritos en Spotify
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/get-several-albums/ API Info
     */
    public static function obtenerListaFavoritos($listaIdSpotify, $tipo) {
       $info ="";
        if (!empty($listaIdSpotify)) {
            $lista = "" . $listaIdSpotify[0];
            for ($i = 1; $i < count($listaIdSpotify); $i++) {
                $lista.="," . $listaIdSpotify[$i];
            }
                $peticion = SPOTIFY_URL_API . '/v1/' . $tipo . '?ids=' . $lista;
            
            $datos = @file_get_contents($peticion);
            $info = json_decode($datos, true);
        }
        return $info;
    }

    /**
     * Obtiene el catálogo de álbumes de un artista en Spotify
     * @param string $artistaId Identificador del artista en Spotify
     * @param integer $limite El límite debe estar entre 1 y 50
     * @return array() Catálogo de álbumes
     * @link https://developer.spotify.com/web-api/get-artists-albums/ API Info
     */
    public static function getArtistaAlbumes($artistaId, $limite = 5) {
        if ($limite < 1):
            $limite = 1;
        elseif ($limite > 50):
            $limite = 50;
        endif;
        $peticion = SPOTIFY_URL_API . '/v1/artists/' . $artistaId . '/albums?market=ES&limit=' . $limite;
        $datos = @file_get_contents($peticion);
        $info = json_decode($datos, true);

        return $info['items'];
    }

    /**
     * Obtiene el lista de temas de un álbum en Spotify
     * @param string $albumId Identificador del álbum en Spotify
     * @return array() Catálogo de temas
     * @link https://developer.spotify.com/web-api/get-albums-tracks/ API Info
     */
    public static function getAlbumTemas($albumId) {
        $peticion = SPOTIFY_URL_API . '/v1/albums/' . $albumId . '/tracks';
        $datos = @file_get_contents($peticion);
        $info = json_decode($datos, true);

        return $info['items'];
    }

    /**
     * Obtiene un listado de temas coincidentes con la cadena $tema
     * @param string $tema Cadena de caracteres
     * @return array Resultado de la búsqueda
     * @link https://developer.spotify.com/web-api/get-several-tracks/ API Info
     */
    public static function buscaTemas($tema) {
        $peticion = SPOTIFY_URL_API . '/v1/search?q=' . urlencode($tema) . '&type=track&market=ES';
        $datos = @file_get_contents($peticion);
        $temas = json_decode($datos, true);

        return $temas;
    }

}

/* * * *******************************************************************
 * Segunda parte: Datos locales
 */
//require ./\Doctrine
require_once __DIR__ . '/../vendor/autoload.php';

//require __DIR__ . '/../src/config.php';
use Doctrine\DBAL\DriverManager;

//use Doctrine\DBAL\DriverManager;

class datosLocales {

    /**  \Doctrine\DBAL\Connection Objeto conexi&oacute;n */
    protected static $idDB = null;

    /**
     * gets the instance via lazy initialization (created on first usage)
     *
     * @return \Doctrine\DBAL\Connection Objeto conexi&oacute;n
     */
    protected static function getInstance() {
        if (static::$idDB === NULL) {
            static::$idDB = new static();
        }

        // DBAL: Doctrine database abstraction & access layer
        $config = new \Doctrine\DBAL\Configuration();
        $parametros = self::_parametros();

        static::$idDB = DriverManager::getConnection($parametros, $config);

        return static::$idDB;
    }

    /**
     * Proporciona los parámetros de conexión a la BD
     *
     * @return array() Par&aacute;metros de conexi&oacute;n a la base de datos
     * @link http://doctrine-dbal.readthedocs.org/en/latest/reference/configuration.html Doctrine DBAL Configuration
     */
    private static function _parametros() {
        $cfg = array(
            'driver' => MYSQL_DRIVER,
            'host' => MYSQL_SERVER,
            'dbname' => MYSQL_DATABASE,
            'user' => MYSQL_USER,
            'password' => MYSQL_PASSWORD,
        );

        return $cfg;
    }

    /**
     * Cierra la conexión con la BD
     *
     * @param \Doctrine\DBAL\Connection $idDB
     * @return void
     */
    public static function cerrar_conexion_basededatos() {
        self::getInstance();

        return self::$idDB->close();
    }

    /**
     * Recupera un usuario de la base de datos
     *
     * @param string $usuario Nombre del usuario
     * @return array() matriz asociativa recuperada
     */
    public static function recupera_usuario($usuario) {
        self::getInstance();

        $consulta = 'SELECT * FROM usuarios WHERE `username` = :user';

        return self::$idDB->fetchAssoc($consulta, array('user' => $usuario));
    }

    /**
     * Busca si el favorito se encuentra en la base de datos
     *
     * @param string $idFavorito id spotify del favorito
     * @param string $usuario Nombre del usuario
     * @return array() matriz asociativa recuperada
     */
    public static function buscar_favorito($idFavorito, $usuario) {
        self::getInstance();

        $consulta = 'SELECT * FROM favoritos WHERE `usuario` = :user and `id_spotify` = :id';

        return self::$idDB->fetchAssoc($consulta, array('user' => $usuario, 'id' => $idFavorito));
    }

    /**
     * Busca en la base de datos los id de spotify de los favoritos
     *
     * @param string $idUsuario id spotify del favorito
     * @param string $tipo tipo de favorito
     * @return array() matriz asociativa recuperada
     */
    public static function obtenerIdFavoritos($idUsuario, $tipo) {
        self::getInstance();
        $consulta = 'SELECT id_spotify FROM favoritos WHERE `usuario` = :user and `tipo` = :tipo';
        $resultado = self::$idDB->fetchAll($consulta, array('user' => $idUsuario, 'tipo' => $tipo));
        $lista = array();

        if (!empty($resultado)) {
            for ($i = 0; $i < count($resultado); $i++) {
                $lista[] = $resultado[$i]["id_spotify"];
            }
        }
        return $lista;
    }

    /**
     * Inserta un favorito de la base de datos
     * @param int $idUsuario identificador unico del usuario
     * @param string $idSpotify identificador de Spotify
     * @param int $tipo identificador único del tipo de favorito
     * @return integer N&uacute;mero de filas insertadas
     */
    public static function guardar_favorito($idUsuario, $idSpotify, $tipo) {
        self::getInstance();
        $datos = array(
            'id_spotify' => $idSpotify,
            'usuario' => $idUsuario,
            'tipo' => $tipo
        );


        return self::$idDB->insert('favoritos', $datos);
    }

    /**
     * Inserta un usuario en la tabla de usuarios
     * @param string $username Nombre del usuario
     * @param string $pclave Palabra Clave
     * @param boolean $esAdmin Indica si el usuario es administrador
     * @param string $email
     * @param int $hora Timestamp de la creación
     * @return integer N&uacute;mero de filas insertadas
     */
    public static function inserta_usuario($username, $pclave, $esAdmin = false, $email = null, $hora = null) {
        $resultado = 0;
        self::getInstance();
        $consulta = 'SELECT * FROM usuarios WHERE `username` = :user';
        if (!self::$idDB->fetchAssoc($consulta, array('user' => $username))) {
            $datos = array(
                'username' => $username,
                'password' => password_hash($pclave, PASSWORD_DEFAULT),
                'esAdmin' => ($esAdmin) ? 1 : 0,
                'email' => $email,
                'create_time' => is_null($hora) ? date('Y-m-d H:i:s') : $hora,
            );
            $resultado = self::$idDB->insert('usuarios', $datos);
        }

        return $resultado;
    }

    /**
     * Recupera todos los usuarios
     *
     * @return array() tabla de usuarios
     */
    public static function recupera_todos_usuarios() {
        self::getInstance();

        $resultado = self::$idDB->query('SELECT * FROM usuarios');

        return $resultado->fetchAll();
    }

    /**
     * Elimina un usuario de la tabla
     *
     * @param integer $username Nombre del usuario a eliminar
     * @return integer N&uacute;mero de filas afectadas
     */
    public static function borrar_usuario($username) {
        self::getInstance();

        return self::$idDB->delete('usuarios', array('username' => $username));
    }

    /**
     * Elimina un favorito de la tabla favoritos
     *
     * @param integer $username Nombre del usuario a eliminar
     * @return integer N&uacute;mero de filas afectadas
     */
    public static function borrar_favorito($idUsuario, $idFavorito) {
        self::getInstance();

        return self::$idDB->delete('favoritos', array('usuario' => $idUsuario, 'id_spotify' => $idFavorito));
    }

    /**
     * Actualiza un usuario en la tabla
     *
     * @param array() $usuario Usuario a actualizar
     * @return integer N&uacute;mero de filas afectadas
     */
    public static function actualiza_usuario($usuario) {
        self::getInstance();

        return self::$idDB->update('usuarios', $usuario, array('username' => $usuario['username']));
    }

    /**
     * is not allowed to call from outside: private!
     *
     */
    private function __construct() {
        
    }

    /**
     * prevent the instance from being cloned
     *
     * @return void
     */
    private function __clone() {
        
    }

    /**
     * prevent from being unserialized
     *
     * @return void
     */
    private function __wakeup() {
        
    }

}
