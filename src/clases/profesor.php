<?php
namespace ITEC\DAW\examen;
use ITEC\DAW\examen\fecha;
include_once "fecha.php";


class profesor{
    private string $nombre;
    private fecha $fechaNacimiento;
    //nota importante una variable estatica no la pudeo usar como variable del objeto
    //si quiero un id tengo que hacerlo que no sea estatico, aunque despues use la estatica como incremento
    private static int $idIncremento = 0;
    private int $id;

    public function __construct(string $nombre, fecha $fechaNacimiento){
        $this->nombre  = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->id = self::$idIncremento++;
    }
    

    public static function create(string $nombre, fecha $fechaNacimiento){
        return new profesor($nombre, $fechaNacimiento);
    }
    public static function createProfesorYFecha(string $nombre, int $dia, int $mes,int $annio){
        $fecha = fecha::createFecha($dia, $mes, $annio);
        return self::create($nombre, $fecha);
    }
    
    public function getNombre(): string{
        return $this->nombre;
    }

    public function getFechaNacimiento(): string{
        return $this->fechaNacimiento;
    }
    
    public function getFechaNacimientoStr(): string{
        //la fecha ya es un objeto de la clase fecha a la cual directamente podemos llamar a la funcion interna
        return $this->fechaNacimiento->getFechaStr();
    }

    public function getID(){
        return $this->id;
    }
}
//$fecha = new fecha(12,1,2000);
//$profesor = profesor::create("alberto", $fecha);
?>