<?php
namespace ITEC\DAW\examen;
use ITEC\DAW\examen\fecha;

class profesor{
    private string $nombre;
    private fecha $fechaNacimiento;
    private int $id;

    public function __construct(string $nombre, fecha $fechaNacimiento, int $id){
        $this->nombre  = $nombre;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->id = $id;
    }

    public static function create(string $nombre, fecha $fechaNacimiento, int $id){
        return new profesor($nombre, $fechaNacimiento, $id);
    }
    public static function createProfesorFecha(string $nombre, int $dia, int $mes,int $annio, int $id){
        $fecha = fecha::createFecha($dia, $mes, $annio);
        return self::create($nombre, $fecha, $id);
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
?>