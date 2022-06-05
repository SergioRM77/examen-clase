<?php
use PHPUnit\Framework\TestCase;
use ITEC\DAW\examen\asignatura;
use ITEC\DAW\examen\profesor;
use ITEC\DAW\examen\listadopreguntas;
use ITEC\DAW\examen\fecha;
use ITEC\DAW\examen\hora;
//hay que hacer los test por separado, si se hacen todos a la vez los ID cambian
final class partesExamenTest extends TestCase{
    public function testPartesExamenAsignatura(){
        $mates = asignatura::create("Mates");
        $fisica = asignatura::create("Física");
        $arrayAsignaturas[] =  $mates->getNombreAsignatura();
        $arrayAsignaturas[] =  $fisica->getNombreAsignatura();

        $this->assertEquals("Mates", $mates->getNombreAsignatura());
        $this->assertEquals(1, $fisica->getIDasignatura());
        $this->assertEquals($fisica,asignatura::getAsignatura("Física"));
        $this->assertTrue(asignatura::existAsignatura("Mates"));
        $this->assertFalse(asignatura::existAsignatura("Lengua"));
        $this->assertEquals($arrayAsignaturas, asignatura::showAllAsignaturas());

    }

    public function testPartesExamenProfesor(){
        $fecha = fecha::createFecha(12, 5, 2000);
        $profesor1 = profesor::create("Alberto", $fecha);
        $profesor2 = profesor::createProfesorYFecha("Sergio", 11, 4, 1999);
        $this->assertEquals("Sergio",$profesor2->getNombre());
        $this->assertEquals($fecha,$profesor1->getFechaNacimiento());
        $this->assertEquals("12/5/2000",$profesor1->getFechaNacimientoStr());
        $this->assertEquals(1,$profesor2->getID());
    }

    public function testPartesExamenFecha(){
        $fecha1 = fecha::createFecha(21,2,2000);
        $sabadoSiguiente = fecha::createFecha(11,6,2022);
        $this->assertEquals("21/2/2000", $fecha1->getFechaStr());
        $dif = $sabadoSiguiente->getDateLeft();
        //esto da error segun el dia que se mire al igual que la hora
        //$this->assertEquals(6, $sabadoSiguiente->getDateLeft());
        
    }

    public function testPartesExamenHora(){
        $hora = hora::createHora(10,15,0);
        $diferencia =$hora->getTimeLeft();
        $this->assertEquals("10:15:00", $hora->getHoraStr());
        $this->assertEquals($diferencia, $hora->getTimeLeft());
    }

    public function testPartesExamenListaPreguntas(){
        $listaPreguntas1 = new listadopreguntas();
        $listaPreguntas1->addCreatePregunta("¿Cuánto es 2 + 2?", 10);
        $listaPreguntas1->addCreatePregunta("¿Cuánto es 2 - 2?", 10);
        $listaPreguntas1->addCreatePregunta("¿Por qué esta silla es tan incómoda?", 10);
        
        $lista2 = new listadopreguntas();
        $lista2->addPregunta($listaPreguntas1->getPregunta(0));
        $lista2->addPregunta($listaPreguntas1->getPregunta(1));
        $lista2->addPregunta($listaPreguntas1->getPregunta(2));

        $this->assertEquals(3, $listaPreguntas1->getNumPreguntas());
        $this->assertEquals($listaPreguntas1->getPreguntaPorClave("silla es tan"), $listaPreguntas1->getPregunta(2));
        $this->assertEquals($lista2->getListadoPreguntas(),  $listaPreguntas1->getListadoPreguntas());
        $this->assertEquals(3, listadopreguntas::getLastID());
        
    }

}
?>