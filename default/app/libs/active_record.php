<?php
/**
 * @see KumbiaActiveRecord
 */
Load::coreLib('kumbia_active_record');

/**
 * ActiveRecord
 *
 * Esta clase es la clase padre de todos los modelos
 * de la aplicacion
 *
 * @category Kumbia
 * @package Db
 * @subpackage ActiveRecord
 */
class ActiveRecord extends KumbiaActiveRecord
{
	private $estado = array("1"=>"Activo","0"=>"No Activo");
	public function asignarIp(){
		$this->ip = $_SERVER['SERVER_ADDR'];
	}
	public function getEstado($numero){
		return $this->estado[$numero];
	}
	public function getUltimoId(){
		$r = $this->find("limit: 1","order: id desc");
		return $r[0]->id;
	}
}
