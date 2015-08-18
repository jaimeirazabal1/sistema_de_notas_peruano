<?php 
Load::models("asignatura");
class Profesorasignatura extends ActiveRecord{
	public function getAsignaturasByProfesorId($profesor_id){

		$query = "SELECT asignatura.codigo, asignatura.asignatura, semestre.numero, profesor.id 
		 		  from profesorasignatura 
		 		  inner join asignatura 
		 		  	on profesorasignatura.asignatura_id = asignatura.id 
		 		  inner join semestre 
		 		  	on asignatura.semestre_id = semestre.id 
		 		  inner join profesor 
		 		  	on profesorasignatura.profesor_id = profesor.id 
		 		  WHERE profesorasignatura.profesor_id = '$profesor_id'";

		return $this->find_all_by_sql($query);
	}

	public function getParaAsignaturaParaAsignar($profesor_id){
		$query = "select id,asignatura,codigo from asignatura where id not in (select asignatura_id from profesorasignatura where profesor_id = '$profesor_id')";
		$registros = $this->find_all_by_sql($query);
		$r[] = "Seleccione un asignatura";
		foreach ($registros as $key => $value) {
			$r[$value->id] = $value->codigo." - ".$value->asignatura;
		}
		return $r;
	}
	public function eliminar($profesor_id, $codigo){
		$asig = new Asignatura();
		$asignatura = $asig->find("conditions: codigo='$codigo'");
		$registro = $this->find("conditions: asignatura_id = '{$asignatura[0]->id}' and profesor_id = '$profesor_id' ");
		if ($registro[0]->delete()) {
			return true;
		}
		return false;
	}
}

 ?>