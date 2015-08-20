<?php 
Load::models("alumnoasignatura","semestre","seccion","incripcionalumnoasignatura","profesorasignatura");
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
	}
}

 ?>