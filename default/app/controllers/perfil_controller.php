<?php 
Load::models("alumnoasignatura");
class PerfilController extends AppController{
	public function login(){
		if (Input::hasPost("usuario","password","tipo_usuario")){
            $pwd = Input::post("password");
            $usuario= Input::post("usuario");
 			$tipo_usuario = Input::post("tipo_usuario");
 			if ($tipo_usuario == "docente") {
 				$modelo = "profesor";
 				$campo1 = "dni";
 				$campo2 = "password";
 				$pwd = md5($pwd);
 				$auth = new Auth("model", "class: $modelo", "$campo1: $usuario", "$campo2: $pwd", "tipo_usuario: 1");
 			}
 			elseif ($tipo_usuario == "alumno") {
 				$modelo = "alumno";
 				$campo1 = "dni";
 				$campo2 = "dni";
 				$auth = new Auth("model", "class: $modelo", "$campo1: $usuario", "$campo2: $pwd");
 			}
 			else{
 				$modelo = "profesor";
 				$campo1 = "dni";
 				$campo2 = "password";
 				$pwd = md5($pwd);
 				$auth = new Auth("model", "class: $modelo", "$campo1: $usuario", "$campo2: $pwd", "tipo_usuario: 0");
 			}
 			
            if ($auth->authenticate()) {
            	/*agregar un parametro para saber que tipo de usuario es*/
            	$_SESSION['KUMBIA_AUTH_IDENTITY'][Config::get('config.application.namespace_auth')]['tipousuario'] = $tipo_usuario;
            	if ($tipo_usuario == "alumno") {
            		Flash::valid("Alumno");
            		Router::redirect("perfil/");
            	}
            	if ($tipo_usuario == "docente") {
            		Flash::valid("Docente");
            		Router::redirect("profesor/");
            	}
            	if ($tipo_usuario == "administrador") {
            		Flash::valid("Administrador");
            		Router::redirect("profesor/");
            	}

            } else {
                Flash::error("El Nombre de Usuario o contraseña son incorrectos");
                Router::redirect("/");
            }
        }
	}
	public function logout(){
		Auth::destroy_identity();
		Router::redirect("/");
	}

	public function index(){
		$tipo = Auth::get("tipousuario");
        if ($tipo == "alumno") {

            $alumnoasignatura = new Alumnoasignatura();
            $id_alumno = Auth::get("id");
            $this->informacion_alumno = $alumnoasignatura->getDatosByAlumnoId($id_alumno);
        }

	}
}

 ?>