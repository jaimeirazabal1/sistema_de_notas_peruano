<?php 
class Alumno extends ActiveRecord{
	protected function initialize(){
		$this->validates_length_of("dni", 8,6);
		$this->validates_length_of("celular", 18);
   		$this->validates_uniqueness_of("dni","message: El dni ya se uso, por favor use otro");
   		$this->validates_uniqueness_of("celular","message: El número celular ya se uso, por favor use otro");
   
	}
	public function getAlumnos(){
		return $this->find_all_by_sql("select id, CONCAT(nombres,' ',apellidos) as alum from alumno");
	}
}

 ?>