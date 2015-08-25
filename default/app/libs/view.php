<?php
/**
 * @see KumbiaView
 */
require_once CORE_PATH . 'kumbia/kumbia_view.php';

/**
 * Esta clase permite extender o modificar la clase ViewBase de Kumbiaphp.
 *
 * @category KumbiaPHP
 * @package View
 */
class View extends KumbiaView
{
	public static function calcularDiferenciaEntreFechas($f1, $f2){
		$datetime1 = new DateTime($f1);
		$datetime2 = new DateTime($f2);
		$interval = $datetime1->diff($datetime2);
		return $interval->format('%R%a');
		//printf('%d años, %d meses, %d días, %d horas, %d minutos', $fecha->y, $fecha->m, $fecha->d, $fecha->h, $fecha->i);
	}
	public static function interval_date($init,$finish)
	{
	    //formateamos las fechas a segundos tipo 1374998435
	    $diferencia = strtotime($finish) - strtotime($init);
	 
	    //comprobamos el tiempo que ha pasado en segundos entre las dos fechas
	    //floor devuelve el número entero anterior, si es 5.7 devuelve 5
	    if($diferencia < 60){
	        $tiempo = "Hace " . floor($diferencia) . " segundos";
	    }else if($diferencia > 60 && $diferencia < 3600){
	        $tiempo = "Hace " . floor($diferencia/60) . " minutos'";
	    }else if($diferencia > 3600 && $diferencia < 86400){
	        $tiempo = "Hace " . floor($diferencia/3600) . " horas";
	    }else if($diferencia > 86400 && $diferencia < 2592000){
	        $tiempo = "Hace " . floor($diferencia/86400) . " días";
	    }else if($diferencia > 2592000 && $diferencia < 31104000){
	        $tiempo = "Hace " . floor($diferencia/2592000) . " meses";
	    }else if($diferencia > 31104000){
	        $tiempo = "Hace " . floor($diferencia/31104000) . " años";
	    }else{
	        $tiempo = "Error";
	    }
	    return $tiempo;
	}
}
