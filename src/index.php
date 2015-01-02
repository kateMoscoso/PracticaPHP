<?php

// index.php

namespace MiW\PracticaPHP;

// Iniciamos la sesión
session_start();

require 'config.php';
require 'controllers.php';

$peticion = explode('/', filter_input(INPUT_SERVER, 'PATH_INFO'));

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET') {
    switch ($peticion[1]) {
        case '': # /
            principalAction();
            break;

        case 'mas_info': # Información general sobre la aplicación
            sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            break;

        case 'artistas': # /artistas
            buscaArtistasAction();
            break;

        case 'artista': # /artista/{id}/{limite}
            if (!empty($peticion[2])):
                // El segundo parámetro (id) es el Id del artista
                // y el tercero (limite) el número de álbums recuperados
                (isset($peticion[3])) ?
                                mostrarArtistaAction($peticion[2], $peticion[3]) :
                                mostrarArtistaAction($peticion[2]);
            else:
                principalAction();
            endif;
            break;

        case 'album': # /album/{id}
            if (!empty($peticion[2])):
                // El segundo parámetro (id) es el Id del álbum
                mostrarAlbumAction($peticion[2]);
            else:
                buscarAlbumAction();
            // sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            endif;
            break;
        case 'temas': # /temas/{id}
            if (!empty($peticion[2])):
                // El segundo parámetro (id) es el Id del álbum
                mostrarTemasAction($peticion[2]);
            else:
                buscarTemaAction();
            // sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            endif;
            break;
        case 'favoritos':
            if (isset($_SESSION['usuario'])):
                switch ($peticion[2]) {
                    case 'artistas': # /favoritos/artistas
                        mostrarFavoritosAction(1);
                        //sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                    case 'albumes': # /favoritos/albumes
                        mostrarFavoritosAction(2);
                        // sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                    case 'temas': # /favoritos/temas
                        mostrarFavoritosAction(3);
                        // sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                    case 'borrar': # /favoritos/eliminar/idSpotify
                        borrarFavoritosAction($peticion[4], $peticion[3]);
                        // sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                    default :

                        sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                }
            else:
                errorAccesoAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            endif;
            break;
        case 'favorito':# guardar favoritos - artista - album - tema
            if (isset($_SESSION['usuario'])) {  # /favorito/tipo/nuevo/id
                if (!buscarFavoritoAction($peticion[4])) {
                    guardarFavoritoAction($peticion[4], $peticion[2]);
                }
            } else {
                errorAccesoAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            }
            break;

        case 'logout': # /logout
            logoutAction();
            principalAction();
            break;
        case 'login': # /logout
            // logoutAction();
            principalAction();
            break;
        case 'usuario':
            if ($_SESSION['esAdmin']):
                switch ($peticion[2]) {
                    case 'listado': # /usuario/listado
                        listadoUsuariosAction();
                        break;
                    case 'nuevo': # /usuario/nuevo
                        muestraNuevoUsuarioAction();
                        break;
                    case 'eliminar': #usuario/eliminar/usuario
                        borrarUsuarioAction($peticion[3]);
                        break;
                    case 'mostrar': #usuario/mostrar/usuario
                        mostrarPerfilUsuarioAction($peticion[3]);
                        break;
                    default :
                        sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                }
            else:
                errorAccesoAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            endif;
            break;
        case 'perfil': #perfil
            if (isset($_SESSION['usuario'])){
                if (empty($peticion[2])){
                mostrarPerfilAction();
                }
                else{
                    switch ($peticion[2]){
                        case'cambiarPass':
                            //mostrarCambiarPassAction();
                            sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                            break;
                        case'cambiarNombreUsuario':
                            //mostrarCambiarPassAction();
                            sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                            break;
                        case'cambiarPermisos':
                            //mostrarCambiarPassAction();
                            sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                            break;
                        default :
                            break;
                    }
                }
            }
            break;

        default :
            sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            break;
    }
} elseif (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') { // procesar formulario
    switch ($peticion[1]) {
        case 'buscaArtista': # /buscaArtista artista={string}
            if (filter_has_var(INPUT_POST, 'artista')):
                buscaArtistaAction(filter_input(INPUT_POST, 'artista'));
            else:
                principalAction();
            endif;
            break;
        case 'buscaAlbum': # /buscaAlbum album={string}
            if (filter_has_var(INPUT_POST, 'album')):
                buscaAlbumAction(filter_input(INPUT_POST, 'album'));
            else:
                principalAction();
            endif;
            break;
        case 'buscaTema': # /buscaTema tema={string}
            if (filter_has_var(INPUT_POST, 'tema')):
                buscaTemaAction(filter_input(INPUT_POST, 'tema'));
            else:
                principalAction();
            endif;
            break;
        case 'login': # /login usuario={string} pclave={string}
            if (filter_has_var(INPUT_POST, 'usuario') && filter_has_var(INPUT_POST, 'pclave')):
                if (loginAction(filter_input(INPUT_POST, 'usuario'), filter_input(INPUT_POST, 'pclave'))) {
                    //echo ' index php has var';
                    principalAction();
                } else {
                    errorAccesoAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                }
            else:
                principalAction();
            endif;
            break;

        case 'usuario':
            if ($_SESSION['esAdmin']) {
                switch ($peticion[2]) {
                    case 'nuevo': # /usuario/nuevo usuario={array}
                        insertarNuevoUsuarioAction($_POST['usuario']);
                        break;
                    default :
                        sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                }
            } else {
                errorAccesoAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            }

            break;
        case 'perfil':
            if (isset($_SESSION['usuario'])) {
                switch ($peticion[2]) {
                    case 'cambiarPass':
                        mostrarCambiarPassAction();
                        break;
                    default :
                        sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
                        break;
                }
            }
            break;

        default :
            sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
            break;
    }
} else {
    // Petición incorrecta
    sinImplementarAction(filter_input(INPUT_SERVER, 'PATH_INFO'));
}
