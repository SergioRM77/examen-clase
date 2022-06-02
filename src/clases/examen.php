<?php
namespace ITEC\DAW\examen;
use ITEC\DAW\examen\asignatura;
use ITEC\DAW\examen\profesor;
use ITEC\DAW\examen\listadopreguntas;
use ITEC\DAW\examen\pregunta;
use ITEC\DAW\examen\fecha;
use ITEC\DAW\examen\hora;
/*
include_once "profesor.php";
include_once "asignatura.php";
include_once "listadopreguntas.php";
include_once "pregunta.php";
include_once "fecha.php";
include_once "hora.php";
*/
class examen{
    private asignatura $asignatura;
    private profesor $profesor;
    private listadopreguntas $listadoPreguntas;
    private pregunta $pregunta;
    private fecha $fecha;
    private hora $hora;

    public function __construct(
        asignatura $asignatura,
        profesor $profesor,
        listadopreguntas $listadoPreguntas,
        fecha $fecha,
        hora $hora
    ){
        $this->asignatura = $asignatura;
        $this->profesor = $profesor;
        $this->listadoPreguntas = $listadoPreguntas;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    public static function createExamen(
        asignatura $asignatura,
        profesor $profesor,
        listadopreguntas $listadoPreguntas,
        fecha $fecha,
        hora $hora
        ){
            return new examen($asignatura, $profesor, $listadoPreguntas, $fecha, $hora);
    }

    //datos del profesor
    public function NombreProfesor(){
        return $this->profesor->getNombre();
    }
    public function ProfesorFechaNacimiento(){
        return $this->profesor->getFechaNacimiento();
    }
    public function getIDProfesor(){
        return $this->profesor->getID();
    }

    //datos de asignatura
    public function NombreAsignatura(){
        return $this->asignatura->getNombreAsignatura();
    }
    public function IDAsignatura(){
        return $this->asignatura->getIDasignatura();
    }
    public function MuestraTodasAsignaturas(){
        asignatura::showAllAsignaturas();
    }

    //fecha
    public function fechaExamen(){
        return $this->fecha->getFechaStr();
    }

    public function diasHastaExamen(){
        return $this->fecha->getDateLeft();
    }

    //hora
    public function horaExamen(){
        return $this->hora->getHoraStr();
    }

    public function horasHastaExamen(){
        return $this->hora->getTimeLeft();
    }

    //listado de preguntas
    public function NumPreguntasExamen(){
        return $this->listadoPreguntas->getNumPreguntas();
    }
    public function GetPreguntaPorID(int $id){
        return $this->listadoPreguntas->getPregunta($id);
    }
    public function GetPreguntaPorClave(string $cadena){
        return $this->listadoPreguntas->getPreguntaPorClave($cadena);
    }
    public function GetListaPreguntas(){
        return $this->listadoPreguntas->getListadoPreguntas();
    }

    //ingresar respuesta
    public function AddRespuesta(int $idpregunta, int $respuesta){
        $preguntaExamen = $this->GetPreguntaPorID($idpregunta);
        return $preguntaExamen->AddRespuesta($respuesta);
    }
    //ingresar puntuacion
    public function setPuntuacion(int $idpregunta, int $puntuacion){
        $preguntaExamen = $this->GetPreguntaPorID($idpregunta);
        return $preguntaExamen->addPuntuacion($puntuacion);
    }

    public function puntuacionFinalExamen(){
        $preguntas = $this->GetListaPreguntas();
        foreach ($preguntas as $key => $pregunta) {
            $totalPuntos = $pregunta->getPuntuacion();
            $puntosMaximos = $pregunta->getPuntuacionMax();
        }
        return $totalPuntos . "/" . $puntosMaximos;
    }


}
/*
$fecha = new fecha(12,1,2000);
$profesor = profesor::create("alberto", $fecha);
var_dump($profesor);
$asignatura = asignatura::create("asignatura");
var_dump($asignatura);
$asignatura2 = asignatura::create("asignatura2");
var_dump(GetListaPreguntas());
*/
?>