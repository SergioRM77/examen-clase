<?php
namespace ITEC\DAW\examen;

use ITEC\DAW\examen\fecha;
use ITEC\DAW\examen\hora;
use ITEC\DAW\examen\pregunta;
use ITEC\DAW\examen\listadopreguntas;
use ITEC\DAW\examen\asignatura;
use ITEC\DAW\examen\profesor;

class examen{
    private fecha $fecha;
    private hora $hora;
    private listadopreguntas $listapreguntas;
    private asignatura $asignatura;
    private profesor $profesor;


    public function __construct(
        fecha $fecha, hora $hora, listadopreguntas $listapreguntas,
        asignatura $asignatura, profesor $profesor
    )
    {
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->listapreguntas = $listapreguntas;
        $this->asignatura = $asignatura;
        $this->profesor = $profesor;
    }

    public static function create(fecha $fecha, hora $hora, listadopreguntas $listapreguntas,
    asignatura $asignatura, profesor $profesor){
        return new examen($fecha, $hora, $listapreguntas, $asignatura, $profesor);
    }

    public function PuntuacionMax(int $puntuacionPregunta){
        foreach ($this->listapreguntas as $clave => $pregunta) {
            $pregunta->addPuntuacion($puntuacionPregunta);
        }
    }

    public function getAsignatura(): asignatura{
        return $this->asignatura;
    }

    public function getFecha(): fecha{
        return $this->fecha;
    }

    public function getHora(): hora{
        return $this->hora;
    }

    public function getListaPregunta(): listadopreguntas{
        return $this->listapreguntas;
    }

    public function getProfesor(): profesor{
        return $this->profesor;
    }
}

?>