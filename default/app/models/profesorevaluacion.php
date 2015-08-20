<?php 
class Profesorevaluacion extends ActiveRecord{
	public function esvalidaporcentaje($profesorasignatura_id, $porcentaje_nuevo){
		$r = $this->find("conditions: profesorasignatura_id = '$profesorasignatura_id'");
		if ($r) {
			$suma_porcentaje = 0;
			/*suma por porcentajes guardados*/
			foreach ($r as $key => $value) {
				$porcentaje = $value->porcentaje;
				$porcentaje = str_replace("%","",$porcentaje);
				$suma_porcentaje += $porcentaje;
			}
			$porcentaje_nuevo = str_replace("%","",$porcentaje_nuevo);
			if (($suma_porcentaje + $porcentaje_nuevo) > 100) {
				Flash::error("La suma de los porcentaje no puede ser mayor a 100");
				return false;
			}

		}
		return true;
	}
}
?>