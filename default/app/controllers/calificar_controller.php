<?php 
Load::models("incripcionalumnoasignatura","profesorevaluacion","alumnoevaluacion");
class CalificarController extends AppController{
	public function index(){
		
	}
	public function grupo($profesorevaluacion_id, $profesorasignatura_id){

		
		$this->profesorevaluacion_id = $profesorevaluacion_id;
		$this->alumnoevaluacion= new Alumnoevaluacion();
		$this->profesorasignatura_id = $profesorasignatura_id;
		$incripcionalumnoasignatura = new Incripcionalumnoasignatura();

		$this->alumnos = $incripcionalumnoasignatura->find("conditions: profesorasignatura_id = '$profesorasignatura_id'",
															"join: inner join alumno on incripcionalumnoasignatura.alumno_id = alumno.id",
															"columns: alumno.*,incripcionalumnoasignatura.id as incripcionalumnoasignatura_id");
		$profesorevaluacion = new Profesorevaluacion();

		if (Input::haspost("alumnoevaluacion")) {

			$alumnoevaluacion = new Alumnoevaluacion(Input::post("alumnoevaluacion"));

			$registro = $alumnoevaluacion->validarRepetida();

			if ($registro->ponderacion <= 20 and $registro->ponderacion >= 0) {
				# code...
				if ($registro->save()) {
						Flash::valid("Registro Guardado");
						Input::delete();
					
				}else{
					Flash::error("Error guardando registro");
				}

			}else{
				Flash::error("La ponderacion debe ser mayor o igual a cero o menor o igual a 20");
			}
		}

		$this->alumnos = $incripcionalumnoasignatura->find("conditions: profesorasignatura_id = '$profesorasignatura_id'",
															"join: inner join alumno on incripcionalumnoasignatura.alumno_id = alumno.id",
															"columns: alumno.*,incripcionalumnoasignatura.id as incripcionalumnoasignatura_id");
		

		foreach ($this->alumnos as $key => $value) {

			$respuesta = $this->alumnoevaluacion->getPonderacionByIncripcionalumnoasignaturaIdYprofesorevaluacionId($value->incripcionalumnoasignatura_id,$this->profesorevaluacion_id);
			if ($respuesta === null) {
				$alumnoevaluacion_para_poner_en_cero = new Alumnoevaluacion();
				$alumnoevaluacion_para_poner_en_cero->ponderacion = 0;
				$alumnoevaluacion_para_poner_en_cero->incripcionalumnoasignatura_id = $value->incripcionalumnoasignatura_id;
				$alumnoevaluacion_para_poner_en_cero->profesorevaluacion_id = $this->profesorevaluacion_id;
				$alumnoevaluacion_para_poner_en_cero->save();
			}
			
		}

		$this->evaluacion = $profesorevaluacion->find($profesorevaluacion_id);

		/*este mecanismo lo aplique cuando me di cuenta que cuando se inscriben los alumnos en las evaluaciones del profesor
		tengo que poner las notas de cada uno en cero. Como aqui es donde se hace, en esta accion, entonces redirijo obligatoriamente para aca
		para que se haga y luego vuelvo a la anterior validando que no se repita el proceso con una variable de sesion*/
		if (isset($_SESSION['KUMBIA_AUTH_IDENTITY'][Config::get('config.application.namespace_auth')]['se_actualizaran_notas_a_cero'])) {

			unset($_SESSION['KUMBIA_AUTH_IDENTITY'][Config::get('config.application.namespace_auth')]['se_actualizaran_notas_a_cero']);
			$_SESSION['KUMBIA_AUTH_IDENTITY'][Config::get('config.application.namespace_auth')]['notas_puestas_en_cero'] = 1;
		
			Router::redirect("perfil/programarevaluaciones/{$profesorasignatura_id}");
		}

	}
}


 ?>