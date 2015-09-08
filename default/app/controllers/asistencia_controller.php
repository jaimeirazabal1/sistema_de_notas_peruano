<?php 
Load::models("asistencia","alumnoasistencia","profesorevaluacion","incripcionalumnoasignatura","alumno","asistencia");
class AsistenciaController extends AppController{
	public function index($profesor_id, $profesorasignatura_id){
		$asistencia_obj = new Asistencia();
		$asistencia = new Asistencia();
		
		$this->profesor_id = $profesor_id;
		$this->profesorasignatura_id = $profesorasignatura_id;
		if (Auth::is_valid() and $profesor_id == Auth::get("id")) {
				$this->asistencia = array();
				$this->asistenciaalumnos = array();
		}else if(Auth::get("tipousuario")=="administrador"){

		}else{
			Flash::warning("Permiso Denegado!");
			Router::redirec("/");
		}
		if (Input::haspost("asistencia")) {
			$asistencia = new Asistencia(Input::post("asistencia"));
			if ($asistencia->save()) {
				$id = $asistencia->getUltimoId();
				$incripcionalumnoasignatura = new Incripcionalumnoasignatura();
				$inscripciones = $incripcionalumnoasignatura->find("conditions: profesorasignatura_id = '$profesorasignatura_id'");
				foreach ($inscripciones as $key => $value) {
				
					$alumnoasistencia = new Alumnoasistencia();
					$alumnoasistencia->asistencia_id = $id;
					$alumnoasistencia->incripcionalumnoasignatura_id = $value->id;
					$alumnoasistencia->asistio = 0;
					if(!$alumnoasistencia->save()){
						$alumno = new Alumno();
						$alumno_ = $alumno->find($value->alumno_id);
						$nombre = ucfirst($alumno_->apellidos)." ".ucfirst($alumno_->nombres);
						Flash::error("Hubo un error asignado la asistencia por defecto al alumno: $nombre");
					}
				}
				Flash::valid("Registro Guardado");
			}else{
				Flash::error("No se pudo Guardar el registro");
			}
		}
		$this->asistencia = $asistencia_obj->find("profesorasignatura_id = '$profesorasignatura_id'");
		$this->asistencia_alumnos = $asistencia->getAsistenciasByProfesorAsignaturaId($profesorasignatura_id);

	}

	public function agregar_asistencia($profesor_id, $profesorasignatura_id, $asistencia_id){
		$incripcionalumnoasignatura = new Incripcionalumnoasignatura();
		$this->profesorasignatura_id= $profesorasignatura_id;
		$this->asistencia_id = $asistencia_id;
		$this->profesor_id = $profesor_id;
		$this->alumnoasistencia_obj = new Alumnoasistencia();
		if (Input::haspost("alumnoasistencia")) {
			$post = Input::post("alumnoasistencia");
		
			$counter = 0;
			foreach ($post['asistio'] as $key => $value) {
				$alumnoasistencia = new Alumnoasistencia();
				$alumnoasistencia = $alumnoasistencia->find($post['id'][$counter]);
				$alumnoasistencia->asistencia_id  = $asistencia_id;
				$alumnoasistencia->incripcionalumnoasignatura_id = $post['inscripcionasignatura_id'][$counter];
				$alumnoasistencia->asistio = $value;
					$alumno = new Alumno();
					$alumno_ = $alumno->find($key);
					$nombre = ucfirst($alumno_->apellidos)." ".ucfirst($alumno_->nombres);
				if (!$alumnoasistencia->save()) {
					Flash::error("No se pudo guardar la Asistencia para el alumno: $nombre");
				}else{
					Flash::valid("Se guardó la Asistencia para el alumno: $nombre");
				}
				$counter++;
			}
		}
		$this->alumnosinscritos = $incripcionalumnoasignatura->getAlumnosByProfesorasignatura_id($profesorasignatura_id);
	}
	public function alumno($alumno_id){
		$alumnoasistencia = new Alumnoasistencia();
		$incripcionalumnoasignatura = new Incripcionalumnoasignatura();

		$query = "SELECT incripcionalumnoasignatura.id as incripcionalumnoasignatura_id, semestre.numero, asignatura.asignatura from incripcionalumnoasignatura 
					INNER join profesorasignatura on profesorasignatura.id = incripcionalumnoasignatura.profesorasignatura_id
					INNER join profesor on profesor.id = profesorasignatura.profesor_id
					INNER join asignatura on asignatura.id = profesorasignatura.asignatura_id 
					INNER JOIN semestre on semestre.id = asignatura.semestre_id
					where alumno_id ='$alumno_id'";

		$this->cursosinscritos = $incripcionalumnoasignatura->find_all_by_sql($query);

		// $query = "select 
		// 		asistencia.descripcion,
		// 		alumnoasistencia.asistio,
		// 		profesor.nombres as profesor_nombres,
		// 		profesor.apellidos as profesor_apellidos
		// 		from alumnoasistencia 
		// 		inner join incripcionalumnoasignatura on alumnoasistencia.incripcionalumnoasignatura_id = incripcionalumnoasignatura.id 
		// 		inner join alumno on incripcionalumnoasignatura.alumno_id = alumno.id 
		// 		inner join asistencia on asistencia.id = alumnoasistencia.asistencia_id
		// 		inner join profesorasignatura on profesorasignatura.id = incripcionalumnoasignatura.profesorasignatura_id
		// 		inner join profesor on profesor.id = profesorasignatura.profesor_id
		// 		where alumno.id = '$alumno_id' and incripcionalumnoasignatura.id = '$incripcionalumnoasignatura_id'";

		// $this->r = $alumnoasistencia->find_all_by_sql($query);
		$this->alumno_id = $alumno_id;
	}
}

 ?>