<?php 
Load::models("profesorasignatura","profesorevaluacion");
class EvaluacionesController extends AppController{
	public function index(){

	}
	public function getmaterias($id_prof){
		$profesorasignatura = new Profesorasignatura();
		View::select(null,'json');
		$data = $profesorasignatura->getAsignaturasByProfesorId($id_prof);
		$data_[] = 'Seleccione';
		$select = "<select name='materias_id' id='materias_id' class='form-control' required><option value=''>Seleccione</option>";
		foreach ($data as $key => $value) {
			$select .= "<option value='".$value->profesorasignatura_id."'>".$value->asignatura."</option>";
		}
		$select.='</select>';
		$this->data = $select;
	}
	public function getevaluaciones($profesorasignatura_id){
		View::template(null);
		$profesorevaluacion = new Profesorevaluacion();
		$this->data = $profesorevaluacion->find("conditions: profesorasignatura_id='$profesorasignatura_id'");

	}
	public function habilitar($id_profesorevaluacion){
		View::select(null,'json');
		$profesorevaluacion = new Profesorevaluacion();
		$data = $profesorevaluacion->find($id_profesorevaluacion);
		$data->habilitado = 1;
		if ($data->save()) {
			$this->data = true;
		}else{
			$this->data = false;
		}
	}
		public function deshabilitar($id_profesorevaluacion){
		View::select(null,'json');
		$profesorevaluacion = new Profesorevaluacion();
		$data = $profesorevaluacion->find($id_profesorevaluacion);
		$data->habilitado = 0;
		if ($data->save()) {
			$this->data = true;
		}else{
			$this->data = false;
		}
	}
}

 ?>