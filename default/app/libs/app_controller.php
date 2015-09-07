<?php
/**
 * @see Controller nuevo controller
 */
require_once CORE_PATH . 'kumbia/controller.php';

/**
 * Controlador principal que heredan los controladores
 *
 * Todas las controladores heredan de esta clase en un nivel superior
 * por lo tanto los metodos aqui definidos estan disponibles para
 * cualquier controlador.
 *
 * @category Kumbia
 * @package Controller
 */
class AppController extends Controller
{
	public $titulo = "Sistema de Notas";

    final protected function initialize()
    {
    	$controller = Router::get("controller");
    	
    	$action = Router::get("action");
    	
    	$ruta = $controller."/".$action;
    	
    	$tipousuario = Auth::get("tipousuario");

    	if (Auth::is_valid()) {
    		if ($tipousuario == "alumno") {
    			if ($ruta != "perfil/index" and $ruta != "perfil/logout") {
    				Flash::warning("Acceso Denegado");
    				Router::redirect("perfil/");
    			}
    		}
    		if ($tipousuario == "docente") {
    			$permisos = array("perfil/actualizar",
    								"perfil/cambiarpass",
    								"perfil/index",
    								"perfil/programarevaluaciones",
    								"calificar/grupo",
    								"perfil/logout",
                                    "asistencia/index",
                                    "asistencia/agregar_asistencia");

    			if (!in_array($ruta, $permisos)) {
    				Flash::warning("Acceso Denegado");
    				Router::redirect("perfil/");
    			}
    		}
    	}else{
    		if ($ruta != 'index/index' and $ruta != 'perfil/logout' ) {
    			Flash::warning("Acceso Denegado");
    			Router::redirect("index/index");
    		}
    	}
    }

    final protected function finalize()
    {
        
    }

}
