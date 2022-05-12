<?php
namespace ITEC\DAW\examen;

class pregunta{
    private string $descripcion;
    private string $respuesta;
    private int $puntuacionMax;
    static int $id;
    private int $puntuacion;

    public function __construct(string $descripcion,int $puntuacionMax, int $id){
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->puntuacionMax = $puntuacionMax;

    }
    public static function create(string $descripcion,int $puntuacionMax, int $id){
        return new pregunta($descripcion, $puntuacionMax, $id);
    }

    public function addRespuesta(string $respuesta){
        $this->respuesta = $respuesta;
    }

    public function addPuntuacion(int $puntuacion){
        $this->puntuacion = $puntuacion;
    }

    public function __toString(){
        return "Pregunta: " . $this->descripcion . "Respuesta: " . $this->respuesta .
            "Puntuacion: " . $this->puntuacion;
    }

    public function getPuntuacion():string{
        return $this;
    }

    public function isValidPuntuacion(int $puntuacion):bool{
        return $puntuacion <= $this->puntuacionMax && $puntuacion >= 0;
    }

    
    public function isThisID(int $id):bool{
        return $id === $this->id;
    }
}
?>