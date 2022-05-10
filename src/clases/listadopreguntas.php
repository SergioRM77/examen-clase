<?php
namespace ITEC\DAW\listadopreguntas;
use ITEC\DAW\pregunta;

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
        $this->preguntas[] = pregunta::create($descripcion, $puntuacionMax); 
    }

    public function addPregunta(pregunta $pregunta){
        $this->preguntas[] = $pregunta;
    }

    public function getNumPreguntas():bool{
        return count($this->preguntas[]);
    }
    
        
    
}
?>