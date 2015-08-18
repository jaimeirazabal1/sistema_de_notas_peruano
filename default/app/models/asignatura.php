<?php 
Load::models("semestre");
class Asignatura extends ActiveRecord{
	protected function initialize(){
		$this->validates_length_of("codigo", 8);
   		$this->validates_uniqueness_of("codigo","message: El codigo ya se usó, por favor use otro");
	}
	public function getSemestre($id){
		$s = new Semestre();
		return $s->getSemestre($id);
	}
}

 ?>