<?php 
Load::models("alumnoasignatura","semestre","seccion","incripcionalumnoasignatura","profesorasignatura","alumnoevaluacion");
class EvaluacionController extends AppController{
	public function index(){
		Router::redirect("evaluacion/inscripcion");
		$evaluaciones = new Alumnoasignatura();
		$this->titulo = "Control de Evaluaciones";
		$this->evaluaciones = $evaluaciones->find();
	}
	public function nueva(){
		if (Input::haspost("alumnoasignatura")) {
			$evaluaciones = new Alumnoasignatura(Input::post("alumnoasignatura"));
			if ($evaluaciones->save()) {
				Flash::valid("Evaluación registrada");
			}else{
				Flash::error("No se registro la evaluación");
			}
		}
		Router::redirect("evaluacion/");
	}
	public function editar($id){
		$evaluaciones = new Alumnoasignatura();
		$secciones = new Seccion();
		if (Input::haspost("alumnoasignatura")) {
			$evaluacion_edit = new Alumnoasignatura(Input::post("alumnoasignatura"));
			if ($evaluacion_edit->update()) {
				Flash::valid("Evaluacion Editada");
			}else{
				Flash::error("No se puedo editar la evaluación");
			}
			Router::redirect("evaluacion/");
		}
		$this->alumnoasignatura = $evaluaciones->find($id);
		$this->secciones = $secciones->getSeccionesBySemestreId($this->alumnoasignatura->semestre_id);
	}
	public function inscripcion(){
		$this->titulo = "Control de Inscripción";
		$incripcionalumnoasignatura = new Incripcionalumnoasignatura();
		$profesorasignatura = new Profesorasignatura();
		$this->profesorasignatura = $profesorasignatura->getProfesorAsignatura();
		if (Input::haspost("incripcionalumnoasignatura")) {
			$inscripcion = new Incripcionalumnoasignatura(Input::post("incripcionalumnoasignatura"));
			if ($inscripcion->save()) {
				Flash::valid("Inscripción realizada");
			}else{
				Flash::error("No se realizó la inscripción");
			}
		}
		$this->incripcionalumnoasignatura = $incripcionalumnoasignatura->getInscripciones();
	}
	public function eliminar_inscripcion($incripcionalumnoasignatura_id){
		$incripcionalumnoasignatura = new Incripcionalumnoasignatura();
		$alumnoevaluacion = new Alumnoevaluacion();
		$inscripcion_eliminar = $incripcionalumnoasignatura->find($incripcionalumnoasignatura_id);
		if ($inscripcion_eliminar->delete()) {
			if($alumnoevaluacion->delete("incripcionalumnoasignatura_id='$incripcionalumnoasignatura_id'")){
				Flash::valid("Inscripcion Eliminada con las evaluaciones de esa inscripción");
			}else{
				Flash::error("La inscripción se eliminó pero no se pudieron eliminar las evaluaciones de la inscripción");
			}
		}else{
			Flash::error("No se pudo eliminar la inscripción");
		}
		Router::redirect("evaluacion/inscripcion");
	}
}

 ?>