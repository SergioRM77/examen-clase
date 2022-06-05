<?php
use PHPUnit\Framework\TestCase;
use ITEC\DAW\examen\asignatura;
use ITEC\DAW\examen\examen;
use ITEC\DAW\examen\profesor;
use ITEC\DAW\examen\listadopreguntas;
use ITEC\DAW\examen\fecha;
use ITEC\DAW\examen\hora;
//hay que hacer los test por separado, si se hacen todos a la vez los ID cambian
final class examenTest extends TestCase{
    public function testexamen(){
     $asignatura = asignatura::create("Programación");
    $fecha = fecha::createFecha(23,3, 2003);
    $profesor = profesor::create("Kike", $fecha);
    $listadoPreguntas = new listadopreguntas();
    $listadoPreguntas->addCreatePregunta("¿Cómo se incluye autoload?",10);
    $listadoPreguntas->addCreatePregunta("¿cuánto es 2 + 2?",10);
    $listadoPreguntas->addCreatePregunta("¿Por qué el perro come tierra?",10);
    $fechaexamen = fecha::createFecha(6,6,2022);
    $horaexamen = hora::createHora(10,0,0);
    $examen = examen::createExamen($asignatura, $profesor, $listadoPreguntas, $fechaexamen, $horaexamen);
   
    $examen->AddRespuesta(0, "con include_one y el vendor/autoload.php");
    $examen->AddRespuesta(1, "4");
    $examen->AddRespuesta(2, "porque sabe a chocolate");
    $examen->setPuntuacion(0, 10);
    $examen->setPuntuacion(1, 10);
    $examen->setPuntuacion(2, 3);

    $diaExamen = fecha::createFecha(6,6,2022);
    $diffhoras = new DateTime();
    $horaexamen2 = new DateTime();
    $horaexamen2->setTime(10,0,0);

    $this->assertEquals("Kike", $examen->NombreProfesor());
    $this->assertEquals("Programación", $examen->NombreAsignatura());
    $this->assertEquals("23/3/2003", $examen->ProfesorFechaNacimiento());
    $this->assertEquals(0, $examen->getIDProfesor());
    $this->assertEquals(asignatura::showAllAsignaturas(), $examen->MuestraTodasAsignaturas());
    $this->assertEquals($fechaexamen, $examen->fechaExamen());
    $this->assertEquals($diaExamen->getDateLeft(), $examen->diasHastaExamen());
    $this->assertEquals($horaexamen, $examen->horaExamen());
    $this->assertEquals($diffhoras->diff($horaexamen2)->format("%H horas %i minutos"), 
                        $examen->horasHastaExamen());
    $this->assertEquals(3,$examen->NumPreguntasExamen());
    $this->assertEquals($listadoPreguntas->getPregunta(1),$examen->GetPreguntaPorID(1));
    $this->assertEquals($listadoPreguntas->getPreguntaPorClave("come tierra"),$examen->GetPreguntaPorClave("el perro"));
    $this->assertEquals($listadoPreguntas->getListadoPreguntas(),$examen->GetListaPreguntas());
    
    $this->assertEquals($listadoPreguntas->getPregunta(1)->getRespuesta(),$examen->GetPreguntaPorID(1)->getRespuesta());
    $this->assertEquals($listadoPreguntas->getPregunta(1)->getPuntuacion(),$examen->GetPreguntaPorID(1)->getPuntuacion());
    $this->assertEquals("23/30",$examen->puntuacionFinalExamen());
    }
    

}
?>