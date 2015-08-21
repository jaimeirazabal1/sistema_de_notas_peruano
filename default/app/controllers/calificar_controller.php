<?php 
Load::models("incripcionalumnoasignatura","profesorevaluacion","alumnoevaluacion");
class CalificarController extends AppController{
	public function index(){
		
	}
	public function grupo($profesorevaluacion_id, $profesorasignatura_id){
		$this->profesorevaluacion_id = $profesorevaluacion_id;
		$this->alumnoevaluacion= new Alumnoevaluacion();

		$incripcionalumnoasignatura = new Incripcionalumnoasignatura();

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

		$this->evaluacion = $profesorevaluacion->find($profesorevaluacion_id);
	}
}


 ?>