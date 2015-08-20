<?php 
class Profesor extends ActiveRecord{
	protected function initialize(){
		$this->validates_length_of("dni", 8,6);
		$this->validates_length_of("celular", 18);
		$this->validates_presence_of("dni","message: El DNI no puede ser nulo");
		$this->validates_presence_of("nombres","message: El Nombre no puede ser nulo");
		$this->validates_presence_of("apellidos","message: El Apellido no puede ser nulo");
		$this->validates_presence_of("direccion","message: La Dirección no puede ser nula");
		$this->validates_presence_of("celular","message: El Número Celular no puede ser nulo");
		$this->validates_presence_of("fnacimiento","message: La fecha de nacimiento no puede ser nulo");
		$this->validates_presence_of("especialidad","message: La especialidad no puede ser nula");
		$this->validates_email_in("correo","message: El correo no cumple con el formato válido para correos");
   		$this->validates_uniqueness_of("dni","message: El dni ya se uso, por favor use otro");
   		$this->validates_uniqueness_of("celular","message: El número celular ya se uso, por favor use otro");
   		$this->validates_uniqueness_of("correo","message: El correo ya se uso, por favor use otro");
   
	}
	private $tipo_usuario_ = array("1"=>"Docente","0"=>"Administrador");

	public function encriptarPassword(){
		$this->password = md5($this->password);
	}
	public function asignarPassword(){
		$this->password = $this->dni;
		$this->encriptarPassword();
	}

	public function getTipoUsuario($numero = 0){
		if (!$numero) {
			return $this->tipo_usuario_[0];
		}else{
			return $this->tipo_usuario_[$numero];
		}
	}

	public function getPasswordById($id){
		$prof = $this->find($id);
		return $prof->password;
	}
	public function getProfesores(){
		return $this->find_all_by_sql("select id, CONCAT(nombres,' ',apellidos) as prof from profesor");
	}

	public function encriptar($p){
		return md5($p);
	}
}

?>