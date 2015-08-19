<?php 
class Alumno extends ActiveRecord{
	protected function initialize(){
		$this->validates_length_of("dni", 8,6);
		$this->validates_length_of("celular", 18);
   		$this->validates_uniqueness_of("dni","message: El dni ya se uso, por favor use otro");
   		$this->validates_uniqueness_of("celular","message: El número celular ya se uso, por favor use otro");
   
	}
}

 ?>