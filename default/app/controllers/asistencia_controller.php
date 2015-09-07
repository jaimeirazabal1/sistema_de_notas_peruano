<?php 
Load::models("asistencia","alumnoasistencia");
class AsistenciaController extends AppController{
	public function index($profesor_id, $profesorasignatura_id){
		$this->profesor_id = $profesor_id;
		$this->profesorasignatura_id = $profesorasignatura_id;
		if (Auth::is_valid() and $profesor_id == Auth::get("id")) {
				$this->asistencia = array();
				$this->asistenciaalumnos = array();
		}else if(Auth::get("tipousuario")=="administrador"){

		}else{
			Flash::warning("Permiso Denegado!");
			Router::redirec("/");
		}
	}

	public function agregar_asistencia(){
		if (Input::haspost("asistencia")) {
			$post = Input::post("asistencia");
			$asistencia = new Asistencia(Input::post("asistencia"));
			if ($asistencia->save()) {
				$asistencia_id = $asistencia->getUltimoId();
				$alumnoasistencia = new Alumnoasistencia();
				$alumnoasistencia->guardar($data);
				Flash::valid("Registro Guardado");
			}else{
				Flash::error("No se pudo Guardar el registro");
			}
			Router::toAction("index/".$post['profesor_id']);
		}
	}
}

 ?>