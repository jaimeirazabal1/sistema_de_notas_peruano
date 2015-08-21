<?php 
Load::models("alumnoasignatura","profesor","profesorasignatura","profesorevaluacion","alumnoevaluacion");
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
            		Router::redirect("perfil/");
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
            $profesorasignatura = new Profesorasignatura();
            $alumnoasignatura = new Alumnoasignatura();
            $id_alumno = Auth::get("id");
          
            $this->informacion_alumno = $profesorasignatura->getNotasDeAlumnoByAlumnoId($id_alumno);
        }
        if ($tipo == "docente") {
            $profesorasignatura = new Profesorasignatura();
            /*aqui siempre viene un profesor... uno de la tabla profesor*/
            $this->titulo = "Mis Salones";
            $this->docente = 1;
            $this->asignaturas = $profesorasignatura->getAsignaturasByProfesorId(Auth::get("id"));
        }
	}

    public function actualizar($id_profesor){
        $this->titulo = "Actualizar información";
        $prof = new Profesor();
        if (Input::haspost("profesor")) {
            $prof_edit = new Profesor(Input::post("profesor"));
            $prof_edit->password = $prof->getPasswordById($id_profesor);
            $prof_edit->asignarIp();
            if ($prof_edit->update()) {
                Flash::valid("Datos procesados con éxito");
            }else{
                Flash::error("Error procesando los datos");
            }
        }

        $this->profesor = $prof->find($id_profesor);
    }

    public function cambiarpass($id_profesor){
        $this->titulo = "Cambiar contraseña";
        $this->profesor = new Profesor();
        $this->profesor->id = $id_profesor;
        if (Input::post("profesor") and Input::post("pass1")) {
            $inputs = Input::post("profesor");
            if ($inputs['password'] != $inputs['password2']) {
                Input::delete();
                Flash::info("Las nuevas contraseñas no coinciden");
                Router::redirect("perfil/cambiarpass/$id_profesor");
                die;
            }
            $prof = new Profesor();
            $prof_pass = $prof->find($id_profesor);
            if ($prof->encriptar(Input::post("pass1")) != $prof_pass->password) {
                Input::delete();
                Flash::info("La contraseña anterior no coincide");
                Router::redirect("perfil/cambiarpass/$id_profesor");
                die;
            }
            $prof_pass->password = $prof->encriptar($inputs['password']);
            if ($prof_pass->update()) {
                Flash::valid("La contraseña ha sido cambiada con éxito");
            }else{
                Flash::error("No se pudo cambiar la contraseña");
            }
            Input::delete();
        }
    }
    public function programarevaluaciones($profesorasignatura_id){

        $this->titulo = "Programar asignatura";

        $profesorasignatura = new Profesorasignatura();

        $profesorevaluacion_lista = new Profesorevaluacion();
        
        $this->alumnoevaluacion = new Alumnoevaluacion();

        $this->profesorasignatura_id = $profesorasignatura_id;

        $this->asignatura = $profesorasignatura->getById($profesorasignatura_id);

        $this->notasalumnos = $profesorasignatura->getNotasAsignaturaConAlumnosByProfesorAsignaturaId($profesorasignatura_id);

        if (Input::haspost("profesorevaluacion")) {
            $inputs = Input::post("profesorevaluacion");
            if ($profesorevaluacion_lista->esvalidaporcentaje($profesorasignatura_id, $inputs['porcentaje'])) {
                $profesorevaluacion = new Profesorevaluacion(Input::post("profesorevaluacion"));
                if ($profesorevaluacion->save()) {
                    Flash::valid("Evaluacion programada");
                }else{
                    Flash::error("Evaluacion no guardada");
                }
            }
        }

        $this->evaluaciones = $profesorevaluacion_lista->find("conditions: profesorasignatura_id = '$profesorasignatura_id'");

        if (!$this->evaluaciones and !isset($_SEESION['notas_puestas_en_cero'])) {
            $_SESSION['se_actualizaran_notas_a_cero'] = 1;
            Router::redirect("calificar/grupo/{$this->evaluaciones[0]->id}/{$this->evaluaciones[0]->profesorasignatura_id}");
        }

    }
}

 ?>