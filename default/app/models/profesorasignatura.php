<?php 
Load::models("asignatura");
class Profesorasignatura extends ActiveRecord{
	public function getAsignaturasByProfesorId($profesor_id){

		$query = "SELECT profesorasignatura.id as profesorasignatura_id, asignatura.codigo, asignatura.asignatura, semestre.numero, profesor.id, seccion.seccion
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

	public function getById($id){
		return $this->find_all_by_sql("SELECT 
										profesorasignatura.id as profesorasignatura_id,
										asignatura.id as asignatura_id, 
										asignatura.codigo, 
										asignatura.asignatura 
										from profesorasignatura
									 	inner join asignatura on profesorasignatura.asignatura_id = asignatura.id 
									 	where profesorasignatura.id ='$id'");

	}

	public function getProfesorAsignaturaByid($id){
		$query = "SELECT 
					profesorasignatura.id as profesorasignatura_id,
					seccion.seccion,
					semestre.numero,
					asignatura.id as asignatura_id,
					asignatura.codigo as asignatura_codigo,
					asignatura.asignatura,
					profesor.nombres,
					profesor.apellidos
				from profesorasignatura
				inner join seccion on seccion.id  = profesorasignatura.seccion_id
				inner join semestre on semestre.id = profesorasignatura.semestre_id
				inner join asignatura on asignatura.id = profesorasignatura.asignatura_id
				inner join profesor on profesor.id = profesorasignatura.profesor_id
				where profesorasignatura.id = '$id'";

		$r = $this->find_all_by_sql($query);
		return $r;
	}

		public function getProfesorAsignatura(){
		$query = "SELECT 
					profesorasignatura.id as profesorasignatura_id,
					seccion.seccion,
					semestre.numero,
					asignatura.id as asignatura_id,
					asignatura.codigo as asignatura_codigo,
					asignatura.asignatura,
					profesor.nombres,
					profesor.apellidos
				from profesorasignatura
				inner join seccion on seccion.id  = profesorasignatura.seccion_id
				inner join semestre on semestre.id = profesorasignatura.semestre_id
				inner join asignatura on asignatura.id = profesorasignatura.asignatura_id
				inner join profesor on profesor.id = profesorasignatura.profesor_id";

		$r = $this->find_all_by_sql($query);
		return $r;
	}

	public function getNotasAsignaturaConAlumnosByProfesorAsignaturaId($id,$order = " order by unidad",$group=' group by alumno.dni'){

		$query = "SELECT 
					alumno.id as alumno_id,
					alumno.*,
					alumnoevaluacion.ponderacion,
					profesorevaluacion.porcentaje,
					profesorevaluacion.unidad,
					profesorevaluacion.tipoevaluacion,
					profesorevaluacion.fecha

				from alumnoevaluacion 

				inner join profesorevaluacion
					on alumnoevaluacion.profesorevaluacion_id = profesorevaluacion.id

				inner join incripcionalumnoasignatura 
					on incripcionalumnoasignatura.id = alumnoevaluacion.incripcionalumnoasignatura_id

				inner join alumno 
					on alumno.id = incripcionalumnoasignatura.alumno_id

				inner join profesorasignatura
					on profesorasignatura.id = incripcionalumnoasignatura.profesorasignatura_id

				where incripcionalumnoasignatura.profesorasignatura_id = '$id'";

		$query.=$group;
		$query.=$order;


		return $this->find_all_by_sql($query);
	}

		public function getNotasAsignaturaConAlumnosByProfesorAsignaturaIdAndAlumnoId($id,$order = " order by unidad", $alumno_id){

		$query = "SELECT 
					alumno.id as alumno_id,
					alumno.*,
					alumnoevaluacion.ponderacion,
					profesorevaluacion.unidad,
					profesorevaluacion.porcentaje,
					profesorevaluacion.tipoevaluacion,
					profesorevaluacion.fecha

				from alumnoevaluacion 

				inner join profesorevaluacion
					on alumnoevaluacion.profesorevaluacion_id = profesorevaluacion.id

				inner join incripcionalumnoasignatura 
					on incripcionalumnoasignatura.id = alumnoevaluacion.incripcionalumnoasignatura_id

				inner join alumno 
					on alumno.id = incripcionalumnoasignatura.alumno_id

				inner join profesorasignatura
					on profesorasignatura.id = incripcionalumnoasignatura.profesorasignatura_id

				where incripcionalumnoasignatura.profesorasignatura_id = '$id' and alumno.id='$alumno_id'";

		$query.=$order;

		return $this->find_all_by_sql($query);
	}

	public function getNotasDeAlumnoByAlumnoId($id){
		$query = "SELECT 
					alumno.id as alumno_id,
					alumno.*,
					profesor.nombres as profesor_nombres,
					profesor.apellidos as profesor_apellidos,
					alumnoevaluacion.ponderacion,
					profesorevaluacion.unidad,
					profesorevaluacion.porcentaje,
					profesorevaluacion.tipoevaluacion,
					profesorevaluacion.fecha

				from alumnoevaluacion 

				inner join profesorevaluacion
					on alumnoevaluacion.profesorevaluacion_id = profesorevaluacion.id

				inner join incripcionalumnoasignatura 
					on incripcionalumnoasignatura.id = alumnoevaluacion.incripcionalumnoasignatura_id

				inner join alumno 
					on alumno.id = incripcionalumnoasignatura.alumno_id

				inner join profesorasignatura
					on profesorasignatura.id = incripcionalumnoasignatura.profesorasignatura_id
				inner join profesor
					on profesor.id = profesorasignatura.profesor_id

				where  alumno.id='$id'";

		return $this->find_all_by_sql($query);

	}
}

 ?>