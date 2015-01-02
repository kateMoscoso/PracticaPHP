<?php

// controllers.php

namespace MiW\PracticaPHP;

require 'model.php';

use \MiW\PracticaPHP\Model\datosExternos;
use \MiW\PracticaPHP\Model\datosLocales;

/**
 * Muestra la página principal (búsquedas)
 * @param type $param
 */
function principalAction() {
    require 'views/principal.php';
}

/**
 * Muestra el formulario para buscar un artista
 */
function buscaArtistasAction() {
    require 'views/buscaArtista.php';
}

/**
 * Procesa el formulario para buscar un artista concreto
 * Busca un artista en Spotify y muestra los resultados
 * @param string $artista
 */
function buscaArtistaAction($artista) {
    $artistas = datosExternos::buscarArtista($artista);

    require 'views/muestraListadoArtistas.php';
}

/**
 * Muestra la información de un artista identificado por $artistaId
 * @param string $artistaId Identificador del artista en Spotify
 */
function mostrarArtistaAction($artistaId, $limite = 5) {
    $infoArtista = datosExternos::obtenerArtista($artistaId);
    $albumes = datosExternos::getArtistaAlbumes($artistaId, $limite);
    $cabeceraActivada = FALSE;
    if (isset($_SESSION['idUsuario'])) {
        $listaArtistas = datosLocales::obtenerIdFavoritos($_SESSION['idUsuario'], 1);
        $listaAlbumes = datosLocales::obtenerIdFavoritos($_SESSION['idUsuario'], 2);
    }
    require 'views/muestraArtista.php';
}

/**
 * Muestra formulario para buscar un album
 */
function buscarAlbumAction() {
    require 'views/buscarAlbum.php';
}

/**
 * Procesa el formulario para buscar un album concreto
 * Busca un album en Spotify y muestra los resultados
 * @param string $album
 */
function buscaAlbumAction($album) {
    $albumes = datosExternos::buscaAlbum($album);
    $cabeceraAlbum = TRUE;
//echo json_encode($albumes, JSON_PRETTY_PRINT);
    require 'views/muestraListadoAlbumes.php';
}

/**
 * Muestra la información de un álbum
 * @param string $albumId Identificador del álbum en Spotify
 */
function mostrarAlbumAction($albumId) {
    $infoAlbum = datosExternos::obtenerAlbum($albumId);
    $temas = $infoAlbum['tracks']['items'];

    require 'views/muestraAlbum.php';
}

/**
 * Muestra la información de los favoritos
 * @param string $tipo Identificador del tipo de favoritos
 */
function mostrarFavoritosAction($tipo) {
    $infoFavorito = datosLocales::obtenerIdFavoritos($_SESSION['idUsuario'], $tipo);
        switch ($tipo) {
            case 1: #
                $artistas = datosExternos::obtenerListaFavoritos($infoFavorito, "artists");
                require 'views/muestraListadoArtistasFavoritos.php';
                break;
            case 2: # Información general sobre la aplicación
                $albumes = datosExternos::obtenerListaFavoritos($infoFavorito, "albums");
                require 'views/muestraListadoAlbumesFavoritos.php';
                break;
            case 3: # /artistas
                $temas = datosExternos::obtenerListaFavoritos($infoFavorito, "tracks");
                require 'views/muestraListadoTemasFavoritos.php';
                break;
            default :
                break;
        
    }
}

/**
 * Muestra formulario para buscar un tema
 */
function buscarTemaAction() {
    require 'views/buscarTema.php';
}

/**
 * Procesa el formulario para buscar un tema concreto
 * Busca un tema en Spotify y muestra los resultados
 * @param string $tema
 */
function buscaTemaAction($tema) {
    $cabeceraTemas = TRUE;
    $temas = datosExternos::buscaTemas($tema);
    require 'views/muestraListadoTemas.php';
}

/**
 * Comprueba si el usuario y la contraseña son correctos
 * @param string $usuario Usuario del sistema
 * @param string $pclave  Palabra clave del usuario
 * @return boolean Resultado de la comprobación
 */
function loginAction($usuario, $pclave) {

    $datos = datosLocales::recupera_usuario($usuario);
    if (!empty($datos) and password_verify($pclave, $datos['password'])) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['idUsuario'] = $datos['id'];
        $_SESSION['esAdmin'] = ($datos['esAdmin'] === '1');
        $resultado = TRUE;
    } else {
        $resultado = FALSE;
    }


    return $resultado;
}

/**
 * Termina la sesión actual
 */
function logoutAction() {
    $_SESSION = array();
    session_destroy();

    return TRUE;
}

/**
 * Genera un listado de los usuarios del sistema
 */
function listadoUsuariosAction() {
    $usuarios = datosLocales::recupera_todos_usuarios();

    require 'views/muestraListadoUsuarios.php';
}

/**
 * Muestra un formulario para dar de alta un nuevo usuario
 */
function muestraNuevoUsuarioAction() {
    require 'views/muestraNuevoUsuario.php';
}

/**
 * Muestra la informacion del perfil del usuario
 */
function mostrarPerfilAction() {
    $usuario = $_SESSION['usuario'];
    require 'views/mostrarDatosUsuario.php';
}
/**
 * Muestra la informacion del perfil del usuario
 */
function mostrarPerfilUsuarioAction($usuario) {
    $adm = $_SESSION['esAdmin'];
    require 'views/mostrarDatosUsuario.php';
}
/**
 * Muestra un formulario para cambiar de password
 */
function mostrarCambiarPassAction() {
    $usuario = $_SESSION['usuario'];
    require 'views/cambiarPassword.php';
}


/**
 * Inserta un nuevo usuario y muestra el listado de usuarios
 * @param type $usuario
 */
function insertarNuevoUsuarioAction($usuario) {
    @datosLocales::inserta_usuario($usuario['username'], $usuario['password'], $usuario['esAdmin'], $usuario['email']);
    listadoUsuariosAction();
}

/**
 * Elimina un  usuario y muestra el listado de usuarios
 * @param type $usuario
 */
function borrarUsuarioAction($usuario) {
    @datosLocales::borrar_usuario($usuario);
    listadoUsuariosAction();
}

/**
 * Busca si el favorito se encuentra en la base de Datos
 * @param type $idFavorito id del favorito
 * @return boolean encontrado o no en la base de datos
 */
function buscarFavoritoAction($idFavorito) {
    $datos = datosLocales::buscar_favorito($idFavorito, $_SESSION['idUsuario']);
    if (!empty($datos)) {
        $encontrado = TRUE;
    } else {
        $encontrado = FALSE;
    }
    return $encontrado;
}

/**
 * Inserta un nuevo favorito 
 * @param type $idFavorito
 * @param type $tipo
 */
function guardarFavoritoAction($idFavorito, $tipo) {
    switch ($tipo) {
        case "artista":
            @datosLocales::guardar_favorito($_SESSION['idUsuario'], $idFavorito, 1);
            mostrarFavoritosAction(1);
            break;
        case "album":
            @datosLocales::guardar_favorito($_SESSION['idUsuario'], $idFavorito, 2);
            mostrarFavoritosAction(2);
            break;
        case "tema":
            @datosLocales::guardar_favorito($_SESSION['idUsuario'], $idFavorito, 3);
            mostrarFavoritosAction(3);
            break;
    }
}

/**
 * Elimina un favorito 
 * @param type $idFavorito
 * @param type $tipo
 */
function borrarFavoritosAction($idFavorito, $tipo) {
    @datosLocales::borrar_favorito($_SESSION['idUsuario'], $idFavorito);
    switch ($tipo) {
        case "artista":
            mostrarFavoritosAction(1);
            break;
        case "album":
            mostrarFavoritosAction(2);
            break;
        case "tema":
            mostrarFavoritosAction(3);
            break;
        default :
            sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            break;
    }
}

/**
 * Error de acceso (permisos insuficientes)
 * @param string $path
 */
function errorAccesoAction($path) {
    require 'views/errorAcceso.php';
}

/**
 * Ruta sin implementar
 * @param string $path
 */
function sinImplementarAction($path) {
    require 'views/noImplementado.php';
}
