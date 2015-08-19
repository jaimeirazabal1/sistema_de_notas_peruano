<?php 
Load::models("seccion","asignatura","profesorasignatura");
class SeccionController extends AppController{
	public function index(){
		$seccion = new Seccion();
		$this->titulo = "Control de Secciones";
		$this->secciones = $seccion->getSecciones();
	}
	public function nueva(){
		if (Input::haspost("seccion")) {
			$seccion = new Seccion(Input::post("seccion"));
			if (!$seccion->seccionRepetida($seccion->semestre_id,$seccion->seccion)) {
				if ($seccion->save()) {
					Flash::valid("Sección Agregada");
				}else{
					Flash::error("No se Agrego la sección");
				}
			}else{
				Flash::error("No se Agrego la sección, porque ya hay una sección {$seccion->seccion} con ese nombre en el semestre {$seccion->semestre_id}");
			}
		}
		Router::redirect("seccion/");
	}
	public function obtener_secciones_por_semestre(){
		View::select(null,"json");
		$seccion = new Seccion();
		$semestre_id = Input::get("id");
		$registros = $seccion->find("conditions: semestre_id = '$semestre_id'");
		$this->data = $registros;
	}
	public function obtener_asignaturas_por_semestre(){
		View::select(null,"json");
		$profesorasignatura = new Profesorasignatura();
		$semestre_id = Input::get("id");
		$profesor_id = Input::get("profesor_id");
		$registros = $profesorasignatura->getParaAsignaturaParaAsignarYSemestre($profesor_id,$semestre_id);
		$this->data = $registros;
	}
	public function obtener_asignaturas_por_semestre_alumno(){
		View::select(null,"json");
		$profesorasignatura = new Profesorasignatura();
		$semestre_id = Input::get("id");
		$registros = $profesorasignatura->getParaAsignaturaParaAsignarYSemestreParaAlumno($semestre_id);
		$this->data = $registros;
	}
	public function obtener_profesor_de_asignatura(){
		View::select(null,"json");
		$profesorasignatura = new Profesorasignatura();
		$asignatura_id = Input::get("id");
		$semestre_id = Input::get("semestre_id");
		$seccion_id = Input::get("seccion_id");
		$registros = $profesorasignatura->getProfesorByAsignaturaId($asignatura_id,$semestre_id,$seccion_id);
		$this->data = $registros;
	}
}

 ?>