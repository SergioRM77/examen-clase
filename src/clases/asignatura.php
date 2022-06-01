<?php
namespace ITEC\DAW\examen;

class asignatura{
    private string $asignatura;
    //nota importante una variable estatica no la pudeo usar como variable del objeto
    //si quiero un id tengo que hacerlo que no sea estatico, aunque despues use la estatica como incremento
    private static int $idIncremento = 0;
    private int $id;
    private static array $listaAsignaturas = [];

    private function __construct(string $asignatura)
    {
        if(count(self::$listaAsignaturas) < 1 || !self::existAsignatura($asignatura)){
            $this->asignatura = $asignatura;
            $this->id = self::$idIncremento++;
            self::$listaAsignaturas[] = $this;
        }
    }

    public static function create(string $asignatura){
            return new asignatura($asignatura);
        
    }

    public function getIDasignatura(){
        return $this->id;
    }

    public function getNombreAsignatura(){
        return $this->asignatura;
    }

    public static function existAsignatura(string $nombreAsignatura): bool{
        foreach (self::$listaAsignaturas as $key => $Asignatura) {
            if($Asignatura->getNombreAsignatura() == $nombreAsignatura) return true;
        }
        return false;
    }

    public static function getAsignatura(string $nombreAsignatura): asignatura{
        foreach (self::$listaAsignaturas as $key => $Asignatura) {
            if($Asignatura->getNombreAsignatura() == $nombreAsignatura) return $Asignatura;
        }
    }

    public static function showAllAsignaturas(){
        foreach (self::$listaAsignaturas as $key => $Asignatura) {
            $arrayAsignaturas[] = $Asignatura->getNombreAsignatura();
        }
        return $arrayAsignaturas;
    }
}
?>