<?php 
Load::models("alumno");
class AlumnoController extends AppController{

	public function index(){
		$this->titulo="Control de Alumnos";
		$alumno = new Alumno();
		$this->alumnos = $alumno->find();
	}
	public function nuevo(){
		if (Input::haspost("alumno")) {
			$alumno = new Alumno(Input::post("alumno"));
			$alumno->asignarIp();
			if ($alumno->save()) {
				Flash::valid("Alumno Registrado");
			}else{
				Flash::error("No se registro el alumno");
			}
		}
		Router::redirect("alumno/");
	}
	public function editar($alumno_id){
		$alumno = new Alumno();
		
		if (Input::haspost("alumno")) {
			
			$alumno_editando = new alumno(Input::post("alumno"));
			$alumno_editando->asignarIp();
			if ($alumno_editando->update()) {
				Flash::valid("Registro editado");
			}else{
				Flash::error("El registro no pudo ser editado");
			}
			Router::redirect("alumno/");
		}

		$this->alumno = $alumno->find($alumno_id);
	}
 }

 ?>
