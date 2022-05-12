<?php
namespace ITEC\DAW\examen;

class asignatura{
    private string $titulo;
    private static int $IDasignatura;

    public function __construct(string $titulo)
    {
        $this->titulo = $titulo;
        $this->ID = self::$IDasignatura++;
    }

    public static function create(string $titulo){
        return new asignatura($titulo);
    }

    

}
?>