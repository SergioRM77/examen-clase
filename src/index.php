<?php
    use ITEC\DAW\examen\examen;
    use ITEC\DAW\examen\profesor;
    use ITEC\DAW\examen\asignatura;
    use ITEC\DAW\examen\listadopreguntas;
    use ITEC\DAW\examen\fecha;
    use ITEC\DAW\examen\hora;
    
    include_once "../vendor/autoload.php";
    $asignatura = asignatura::create("Programación");
    $fecha = fecha::createFecha(23,3, 2003);
    $profesor = profesor::create("Kike", $fecha);
    $listadoPreguntas = new listadopreguntas();
    $listadoPreguntas->addCreatePregunta("¿Cómo se incluye autoload?",10);
    $fechaexamen = fecha::createFecha(2,6,2022);
    $horaexamen = hora::createHora(10,0,0);
    $examen = new examen($asignatura, $profesor, $listadoPreguntas, $fechaexamen, $horaexamen);
    var_dump($examen->GetListaPreguntas());


