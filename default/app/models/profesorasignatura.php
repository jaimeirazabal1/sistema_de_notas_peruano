<?php 
Load::models("asignatura");
class Profesorasignatura extends ActiveRecord{
	public function getAsignaturasByProfesorId($profesor_id){

		$query = "SELECT asignatura.codigo, asignatura.asignatura, semestre.numero, profesor.id, seccion.seccion
		 		  from profesorasignatura 
		 		  inner join asignatura 
		 		  	on profesorasignatura.asignatura_id = asignatura.id 
		 		  inner join semestre 
		 		  	on profesorasignatura.semestre_id = semestre.id 
		 		  inner join profesor 
		 		  	on profesorasignatura.profesor_id = profesor.id
		 		  inner join seccion
		 		  	on profesorasignatura.seccion_id = seccion.id
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
	public function getParaAsignaturaParaAsignarYSemestre($profesor_id, $semestre_id){
		$query = "select id,asignatura,codigo from asignatura where id not in (select asignatura_id from profesorasignatura where profesor_id = '$profesor_id') and semestre_id = '$semestre_id'";
		$registros = $this->find_all_by_sql($query);
		
		return $registros;
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
	public function getParaAsignaturaParaAsignarYSemestreParaAlumno($semestre_id){
		$query = "select id,asignatura,codigo from asignatura where semestre_id = '$semestre_id'";
		$registros = $this->find_all_by_sql($query);
		
		return $registros;
	}
	public function getProfesorByAsignaturaId($asignatura_id, $semestre_id, $seccion_id){
		$query = "Select * from profesor 
						inner join profesorasignatura on profesorasignatura.profesor_id = profesor.id 
						where profesorasignatura.asignatura_id = '$asignatura_id' and profesorasignatura.semestre_id = '$semestre_id' and profesorasignatura.seccion_id = '$seccion_id'";
		return $this->find_all_by_sql($query);
	}
}

 ?>