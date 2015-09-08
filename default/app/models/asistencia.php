<?php 
class Asistencia extends ActiveRecord{
	public function getAsistenciasByProfesorAsignaturaId($id){
		$query = "SELECT 
		alumno.id as alumno_id, 
		alumno.nombres, 
		alumno.apellidos, 
		alumnoasistencia.asistio, 
		asistencia.id as asistencia_id, 
		asistencia.descripcion,
		alumnoasistencia.incripcionalumnoasignatura_id
		FROM `alumnoasistencia` 
				inner join asistencia on asistencia.id = alumnoasistencia.asistencia_id
				inner join incripcionalumnoasignatura on alumnoasistencia.incripcionalumnoasignatura_id = incripcionalumnoasignatura.id
				inner join alumno on alumno.id = incripcionalumnoasignatura.alumno_id
				where incripcionalumnoasignatura.profesorasignatura_id = '$id' 
				GROUP BY alumno.id
				order by alumnoasistencia.id asc";
	
		return $this->find_all_by_sql($query);
	}
	public function getAsistenciaByAsistenciaIdYAlumnoId($asistencia_id, $alumno_id){
		$query = "SELECT * 
		FROM  `asistencia` 
		INNER JOIN alumnoasistencia ON alumnoasistencia.asistencia_id = asistencia.id
		INNER JOIN incripcionalumnoasignatura ON incripcionalumnoasignatura.id = alumnoasistencia.incripcionalumnoasignatura_id
		WHERE asistencia.id =  '{$asistencia_id}'
		AND incripcionalumnoasignatura.alumno_id =  '{$alumno_id}'";
		return $this->find_all_by_sql($query);
	}
}

 ?>