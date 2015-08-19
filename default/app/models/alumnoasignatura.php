<?php 
Load::models("asignatura","profesor","alumno");
class Alumnoasignatura extends ActiveRecord{
	public function getAsignatura($id){
		$asig = new Asignatura();
		return $asig->find($id);
	}
	public function getAlumno($id){
		$alum = new Alumno();
		return $alum->find($id);
	}
	public function getProfesor($id){
		$prof = new Profesor();
		return $prof->find($id);
	}
	public function getDatosByAlumnoId($id_alumno){
		$query = "select alumnoasignatura.*,asignatura.asignatura,semestre.numero,seccion.seccion,profesor.nombres,profesor.apellidos 
					from alumnoasignatura 
					inner join asignatura on alumnoasignatura.asignatura_id = asignatura.id 
					inner join semestre on alumnoasignatura.semestre_id = semestre.id
					inner join seccion on alumnoasignatura.seccion_id = seccion.id
					inner join profesor on alumnoasignatura.profesor_id = profesor.id
					where alumnoasignatura.alumno_id = '$id_alumno'";
		return $this->find_all_by_sql($query);
	}
}

 ?>