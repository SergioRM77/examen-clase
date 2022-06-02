<?php
namespace ITEC\DAW\examen;
use ITEC\DAW\examen\pregunta;
//include_once "pregunta.php";


class listadopreguntas extends pregunta{
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
    public function __construct(){
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
    


    public function getPregunta(int $id){
        foreach ($this->preguntas as $pregunta) {
            if($pregunta->isThisID($id)) return $pregunta;
        }
        return null;
    }
        
    /**
     * buscar pregunta por palabra clave
     * 
     */
    public function getPreguntaPorClave(string $cadena){
        foreach ($this->preguntas as $pregunta) {
            if(str_contains($pregunta->getDescripcion(), $cadena)) return $pregunta;
        }
        return null;
    }

    public static function getLastID(){
        return self::$lastid;
    }

    public function getListadoPreguntas(){
        return $this->preguntas;
    }
    
}
?>