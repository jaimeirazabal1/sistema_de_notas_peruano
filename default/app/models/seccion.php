<?php 
class Seccion extends ActiveRecord{
	public function seccionRepetida($semestre, $seccion){
		$registro = $this->find("conditions: semestre_id = '$semestre' and seccion = '$seccion' ");
		if ($registro) {
			return true;
		}
		return false;
	}
	public function getSecciones(){
		$query = "SELECT 
					seccion.id, semestre.numero, seccion.seccion
				  FROM 
				  seccion inner join semestre on seccion.semestre_id = semestre.id";
				  
		return $this->find_all_by_sql($query);
	}
	public function getSeccionesBySemestreId($semestre_id){
		$r = $this->find("conditions: semestre_id = '$semestre_id'");
		foreach ($r as $key => $value) {
			$r_[$value->id] = $value->seccion;
		}
		return $r_;
	}
	public function getAsignaturasBySemestreIdYSeccionId($semestre_id,$seccion_id){
		$r = $this->find("conditions: semestre_id = '$semestre_id'");
		foreach ($r as $key => $value) {
			$r_[$value->id] = $value->seccion;
		}
		return $r_;
	}
}

 ?>