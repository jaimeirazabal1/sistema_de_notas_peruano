<?php 
class Semestre extends ActiveRecord{
	public function getSemestre($id){
	
		$s = $this->find($id);

		return $s->numero;
	}
}


 ?>