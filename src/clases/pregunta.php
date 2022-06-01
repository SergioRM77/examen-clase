<?php
namespace ITEC\DAW\examen;
use ITEC\DAW\examen\listadopreguntas;
include_once "listadopreguntas.php";

class pregunta{
    private string $descripcion;
    private string $respuesta;
    private int $puntuacionMax;
    private int $id;
    private int $puntuacion = 0;

    private function __construct(string $descripcion,int $puntuacionMax, int $id){
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->puntuacionMax = $puntuacionMax;
        $this->puntuacion = 0;

    }
    protected static function create(string $descripcion,int $puntuacionMax, $id){
        return new pregunta($descripcion, $puntuacionMax, $id);
    }

    public function addRespuesta(string $respuesta){
        $this->respuesta = $respuesta;
    }

    public function addPuntuacion(int $puntuacion){
        $this->isValidPuntuacion($puntuacion) ? $this->puntuacion = $puntuacion : $this->puntuacion = 0;
    }

    public function __toString(){
        return "Pregunta: " . $this->descripcion . " Respuesta: " . $this->respuesta .
            " Puntuacion: " . $this->puntuacion . "/" . $this->puntuacionMax;
    }

    public function getPuntuacion():string{
        return $this->puntuacion;
    }

    public function getPuntuacionMax():string{
        return $this->puntuacionMax;
    }

    public function getDescripcion(){
        return $this->descripcion;
    }

    private function isValidPuntuacion(int $puntuacion):bool{
        return $puntuacion <= $this->puntuacionMax && $puntuacion >= 0;
    }

    
    public function isThisID(int $id):bool{
        return $id === $this->id;
    }
}
?>