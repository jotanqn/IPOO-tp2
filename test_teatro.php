<?php
include 'Teatro.php';
include 'Funcion.php';

/** carga nombre funcion del teatro
 * return strin $nombreFuncion
 */
function cargarNombreFuncion()
{
echo "\nIngrese el Nombre de la Funcion :";
$nombreFuncion =  trim(fgets(STDIN));
return $nombreFuncion;
}
/** carga precio funcion del teatro
* return int $precioFuncion
*/
function cargarPrecioFuncion()
{
echo "ingrese el Precio la Funcion :";
$precioFuncion =  trim(fgets(STDIN));
return $precioFuncion;
}
/** carga nombre funcion del teatro
 * return strin $nombreFuncion
 */
function cargarHoraDeInicio()
{
    do{
        echo "\nIngrese la hora (0 a 23): ";
        $hora = trim(fgets(STDIN));
            if(is_numeric($hora) && $hora>-1 && $hora <24){
            $opcionValida = true;
        }else{
            echo"\n";
            print("\e[1;37;41mDebe ingresar un hora valida entre 0 y 23\e[0m")."\n";
            
            $opcionValida = false;
        }
    }while(!$opcionValida);
  
    do{
        echo "\nIngrese los minutos (0 a 59): ";
        $minutos = trim(fgets(STDIN));
        if(is_numeric($minutos) && $minutos>-1 && $minutos <60){
            $opcionValida = true;
        }else{
            echo"\n";
            print("\e[1;37;41mDebe ingresar minutos validos entre 0 y 59  \e[0m")."\n";
            
        $opcionValida = false;
        }
    }while(!$opcionValida);
    // Convierto a minutos la hora de inicio + los minutos
    $horaDeInicio =  $hora*60 + $minutos;
    return $horaDeInicio;
}
/** carga nombre funcion del teatro
 * return strin $nombreFuncion
 */
function cargarDuracionFuncion()
{
    do{
        echo "\nIngrese los minutos de duracion de la funcion): ";
        $duracionFuncion = trim(fgets(STDIN));
        if(is_numeric($duracionFuncion) && $duracionFuncion > 0)
        {
            $opcionValida = true;
        }else{
            echo "\n";
            print("\e[1;37;41mError: Debe ingresar un duracion valida en minutos\e[0m")."\n";
        $opcionValida = false;
        }
    }while(!$opcionValida);
return $duracionFuncion;
}
/** carga nombre funcion del teatro
 * return strin $nombreFuncion
 */
function cambiarFuncion($coleccionFuncion,$cambiarFuncion)
{
    $nombre = "Funcion-".$cambiarFuncion;
    echo $coleccionFuncion[$nombre];
    $coleccionFuncion[$nombre]->setnombreFuncion(cargarNombreFuncion());
    $coleccionFuncion[$nombre]->setprecioFuncion(cargarPrecioFuncion());
    return $coleccionFuncion;
}


//** Programa Principal
/* Crea un objeto Teatro
/* string $nombreTeatro , $direccion 
/* array $coleccionFuncion */

// inicializo variable
$nombreTeatro = "Vorterix";
$direccion = "Buenos Aires 1400 Neuquen";

//creo 2 objetos funcion en un arreglo
for ($i=0; $i < 2 ; $i++) { 
    $nombre = "Funcion-".$i;
    $coleccionFuncion[$nombre] = new Funcion (cargarNombreFuncion(), cargarPrecioFuncion(), cargarHoraDeInicio(), cargarDuracionFuncion());    
}


// se crea un objeto Teatro
$teatro = new Teatro ($nombreTeatro, $direccion, $coleccionFuncion);


do {
    echo "--------------------------------------------------------------\n";
    echo $teatro;
    echo "--------------------------------------------------------------\n";
    echo "1) Cambiar el Nombre del Teatro. \n";
    echo "2) Cambiar la direccion del Teatro. \n";
    echo "3) Modificar la funcion. \n";
    echo "4) Agregar una funcion. \n";
    echo "0) Salir. \n";
    echo "--------------------------------------------------------------\n";
    
    // Ingreso y lectura de la opcion
    echo "Ingrese una opcion: ";
    $opcion = (int) trim(fgets(STDIN));
    switch ($opcion) {
        case 0:
            $teatro ->__destruct();
            echo "Gracias \n";
            break;
        case 1:
            echo "ingrese el nombre del treatro ";
            $nombreTeatro = trim(fgets(STDIN));
            $teatro->setnombreTeatro($nombreTeatro);
            break;
        case 2:
            echo "ingrese la direccion del treatro ";
            $direccion = trim(fgets(STDIN));
            $teatro->setdireccion($direccion);
            break;
        case 3:
            do{
                $cantFunciones= count($teatro->getcoleccionFuncion());
                echo "Que funcion desea cambiar? (1 a ".$cantFunciones.")";
                $cambiarFuncion = (trim(fgets(STDIN)));
                //Verificamos que ingrese numeros y que sea entre 1 y XXX
                if(is_numeric($cambiarFuncion) && $cambiarFuncion>0 && $cambiarFuncion < ($cantFunciones+1)){
                    $opcionValida = true;
                    $cambiarFuncion = $cambiarFuncion -1;
                    $coleccionFuncion = cambiarFuncion($coleccionFuncion,$cambiarFuncion);
                    $teatro->setcoleccionFuncion($coleccionFuncion);
                }else{
                    echo "Debe ingresar una opcion valida \n";
                    $opcionValida = false;
                }
            }while(!$opcionValida);         
            break;
            case 4:
                echo "Nueva Funcion:" ;
                $horaDeInicio = cargarHoraDeInicio();
                $duracionFuncion = cargarDuracionFuncion();
                $exiteFuncion =$teatro->verificaSolapamientoDeFunciones($horaDeInicio,$duracionFuncion);
                if ($exiteFuncion)
                {
                    echo"\n";
                    print("\e[1;37;41mNo se puede cargar en ese horario se solapan con otra funcion\e[0m")."\n";
                    
                }else {
                    $cantFunciones= count($teatro->getcoleccionFuncion());
                    echo "\nSe puede agragar funcion no se solapa\n Numero de funciones ". $cantFunciones."\n";
                    $coleccionFuncion["Funcion-".$cantFunciones] = new Funcion(cargarNombreFuncion(),cargarPrecioFuncion(),$horaDeInicio,$duracionFuncion);
                    $teatro->setcoleccionFuncion($coleccionFuncion);
                }
            break;    
    }
} while ($opcion != 0);

?>