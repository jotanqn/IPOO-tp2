<?php
class Funcion
{
    // para los objetos teatro
    
    private $nombreFuncion ;
    private $precioFuncion ;
	private $horaDeInicio;
	private $duracionFuncion;
       
	
	// Metodo constructor de la clase Punto
    public function __construct($nombreFuncion, $precioFuncion, $horaDeInicio,$duracionFuncion)
    {
        $this->nombreFuncion = $nombreFuncion;
        $this->precioFuncion = $precioFuncion;
		$this->horaDeInicio = $horaDeInicio;
		$this->duracionFuncion = $duracionFuncion;
    }
    // metodo de lectura atributos
    public function getnombreFuncion()
    {
        return $this->nombreFuncion;
    }
	public function getprecioFuncion()
	{
		return $this->precioFuncion;
	}
        public function gethoraDeInicio()
    {
        return $this->horaDeInicio;
    }
	public function getduracionFuncion()
    {
        return $this->duracionFuncion;
    }
// metodo de escritura atributos
	public function setnombreFuncion($nombreFuncion)
	{
		$this->nombreFuncion = $nombreFuncion;
	}
	public function setprecioFuncion($precioFuncion)
	{
		$this->precioFuncion = $precioFuncion;
	}
	public function setduracionFuncion($duracionFuncion)
	{
		$this->duracionFuncion= $duracionFuncion;
	}
	public function sethoraDeInicio($horaDeInicio)
	{
		$this->horaDeInicio = $horaDeInicio;
	}

// metodo conviertir a strin instancia
	public function __toString()
	{
		$horas = floor($this->gethoraDeInicio()/ 60);
		$minutos = floor(($this->gethoraDeInicio() - ($horas * 60)));
		$horasStr = date("H:i",strtotime ($horas.":".$minutos));
		return "\n Nombre  :".$this->getnombreFuncion()."\n Precio : ".$this->getprecioFuncion().
		"\n Hora de Inicio: ".$horasStr." - Duracion de la obra: ".$this->getduracionFuncion()." minutos\n";
	}
	public function __destruct(){
		echo $this . " instancia destruida, no hay referencias a este objeto \n";
	}
}

?>