<?php
namespace ITEC\DAW\examen;
use ITEC\DAW\examen\pregunta;

class listadopreguntas{
    private array $preguntas;
    private static int $lastid = 0;

    /**
     * estructura de preguntas
     * @param array $preguntas
     * [
     *      "id" => [
     *          "descripcion" => "",
     *          "puntuacionMax" => 0
     *       ]
     * ]
     */
    private function __construct(){
        $this->preguntas = [];
    }

    public function addCreatePregunta(string $descripcion, int $puntuacionMax){
        $this->preguntas[] = pregunta::create($descripcion, $puntuacionMax, self::$lastid++); 
    }

    public function addPregunta(pregunta $pregunta){
        $this->preguntas[] = $pregunta;
    }
   

    public function getNumPreguntas():int{
        return count($this->preguntas[]);
    }
    
    public function getPregunta(){
        
    }
        
    
}
?>