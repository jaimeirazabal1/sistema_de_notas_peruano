<?php 
class Incripcionalumnoasignatura extends ActiveRecord{
	public function getInscripcionesById($id){
		$query = "SELECT 
					profesorasignatura.id as profesorasignatura_id,
					seccion.seccion,
					semestre.numero,
					asignatura.id as asignatura_id,
					asignatura.codigo as asignatura_codigo,
					asignatura.asignatura,
					profesor.nombres,
					profesor.apellidos
				from incripcionalumnoasignatura 
				inner join profesorasignatura on profesorasignatura.id = incripcionalumnoasignatura.profesorasignatura_id
				inner join seccion on seccion.id  = profesorasignatura.seccion_id
				inner join semestre on semestre.id = profesorasignatura.semestre_id
				inner join asignatura on asignatura.id = profesorasignatura.asignatura_id
				inner join profesor on profesor.id = profesorasignatura.profesor_id
				where incripcionalumnoasignatura.id = '$id'";

		return $this->find_all_by_sql($query);
	}
	public function getInscripciones(){
		$query = "SELECT 
					incripcionalumnoasignatura.id as incripcionalumnoasignatura_id,
					incripcionalumnoasignatura.creado,
					profesorasignatura.id as profesorasignatura_id,
					seccion.seccion,
					semestre.numero,
					asignatura.id as asignatura_id,
					asignatura.codigo as asignatura_codigo,
					asignatura.asignatura,
					profesor.nombres,
					profesor.apellidos,
					alumno.nombres as nombres_alumno,
					alumno.apellidos as apellidos_alumnos
				from incripcionalumnoasignatura 
				inner join profesorasignatura on profesorasignatura.id = incripcionalumnoasignatura.profesorasignatura_id
				inner join seccion on seccion.id  = profesorasignatura.seccion_id
				inner join semestre on semestre.id = profesorasignatura.semestre_id
				inner join asignatura on asignatura.id = profesorasignatura.asignatura_id
				inner join profesor on profesor.id = profesorasignatura.profesor_id
				inner join alumno on alumno.id = incripcionalumnoasignatura.alumno_id";
				
		return $this->find_all_by_sql($query);
	}
}

 ?>