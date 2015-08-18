<?php 
Load::models("asignatura");
class AsignaturaController extends AppController{
	public function index(){
		$this->titulo = "Control Asignaturas";
		$asignatura = new Asignatura();
		$this->asignaturas = $asignatura->find();
	}
	public function nueva(){
		if (Input::haspost("asignatura")) {
			$asignatura = new Asignatura(Input::post("asignatura"));
			$asignatura->asignarIp();
			if ($asignatura->save()) {
				Flash::valid("Registro Guardado");
			}else{
				Flash::error("No se pudo guardar el registro");
			}
			Router::redirect("asignatura/");
		}

	}

	public function editar($asignatura_id){
		$asignatura = new Asignatura();
		if (Input::haspost("asignatura")) {
			$asignatura = new Asignatura(Input::post("asignatura"));
			$asignatura->asignarIp();
			if ($asignatura->save()) {
				Flash::valid("Registro Guardado");
			}else{
				Flash::error("No se pudo guardar el registro");
			}
			Router::redirect("asignatura/");
		}
		$this->asignatura = $asignatura->find($asignatura_id);

	}
}


 ?>