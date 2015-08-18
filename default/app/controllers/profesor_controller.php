<?php 
Load::models("profesor","profesorasignatura");
class ProfesorController extends AppController{

	public function index(){
		$this->titulo = "Control del Profesores";
		$profesor = new Profesor();
		$this->profesores = $profesor->find();
		
	}

	public function nuevo(){
		if (Input::haspost("profesor")) {
			$profesor = new Profesor(Input::post("profesor"));
			$profesor->asignarPassword();
			$profesor->asignarIp();
			if ($profesor->save()) {
				Flash::valid("Nuevo profesor guardado con éxito!");
			}else{
				Flash::error("No se guardó el nuevo profesor!");
			}
		}
		Router::redirect("profesor/");
	}

	public function editar($profesor_id){
		$profesor = new Profesor();
		
		if (Input::haspost("profesor")) {
			
			$profesor_editando = new Profesor(Input::post("profesor"));
			$profesor_editando->password = $profesor->getPasswordById($profesor_id);
			$profesor_editando->asignarIp();
			if ($profesor_editando->update()) {
				Flash::valid("Registro editado");
			}else{
				Flash::error("El registro no pudo ser editado");
			}
			Router::redirect("profesor/");
		}

		$this->profesor = $profesor->find($profesor_id);
	}

	public function asignatura($profesor_id){
		$profesor = new Profesor();
		$profesorasignatura = new Profesorasignatura();
		$this->profesor = $profesor->find($profesor_id);
		$this->asignaturas = $profesorasignatura->getAsignaturasByProfesorId($profesor_id);
		$this->select = $profesorasignatura->getParaAsignaturaParaAsignar($profesor_id);
	}
	public function asignar($profesor_id){
		if (Input::haspost("profesorasignatura")) {

			$profesorasignatura = new Profesorasignatura(Input::post("profesorasignatura"));

			if ($profesorasignatura->save()) {
				Flash::valid("Registro Asignado");
			}else{
				Flash::error("Registro no Asignado");
			}
		}
		Router::redirect("profesor/asignatura/{$profesor_id}");
	}
	public function eliminarasignatura($profesor_id, $codigo){
		$profesorasignatura = new Profesorasignatura();
		if ($profesorasignatura->eliminar($profesor_id, $codigo)) {
			Flash::valid("Asignatura Eliminada");
		}else{
			Flash::error("Asignatura no eliminada");
		}
		Router::redirect("profesor/asignatura/$profesor_id");
	}
}

 ?>