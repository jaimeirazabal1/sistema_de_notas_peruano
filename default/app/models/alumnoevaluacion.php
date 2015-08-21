<?php 
class Alumnoevaluacion extends ActiveRecord{
	public function validarRepetida(){
		$r = $this->find("conditions: incripcionalumnoasignatura_id='".$this->incripcionalumnoasignatura_id."' and profesorevaluacion_id='".$this->profesorevaluacion_id."'");
		if ($r) {
			$input = Input::post("alumnoevaluacion");
			$r[0]->ponderacion = $input['ponderacion'];
			return $r[0];
		}
		return $this;
	}

	public function getPonderacionByIncripcionalumnoasignaturaIdYprofesorevaluacionId($ins_id,$prof_id){
		$r = $this->find("conditions: incripcionalumnoasignatura_id = '$ins_id' and profesorevaluacion_id='$prof_id'");
		if ($r) {
			return $r[0]->ponderacion;
		}
		return null;
	}
}


 ?>