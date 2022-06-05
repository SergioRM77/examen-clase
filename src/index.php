<?php
    use ITEC\DAW\examen\examen;
    use ITEC\DAW\examen\profesor;
    use ITEC\DAW\examen\asignatura;
    use ITEC\DAW\examen\listadopreguntas;
    use ITEC\DAW\examen\pregunta;
    use ITEC\DAW\examen\fecha;
    use ITEC\DAW\examen\hora;
    
    include_once "../vendor/autoload.php";
    $asignatura = asignatura::create("Programación");
    $fecha = fecha::createFecha(23,3, 2003);
    $profesor = profesor::create("Kike", $fecha);
    $listadoPreguntas = new listadopreguntas();
    $listadoPreguntas->addCreatePregunta("¿Cómo se incluye autoload?",10);
    $listadoPreguntas->addCreatePregunta("¿Qué es mejor PHP o Java?",10);
    $listadoPreguntas->addCreatePregunta("¿Cómo se compra en yahoo?",10);
    $listadoPreguntas->addCreatePregunta("¿La tortilla con cebolla o sin cebolla?",10);
    $listadoPreguntas->addCreatePregunta("¿Cuánto es 10 * 1/2?",10);
    $fechaexamen = fecha::createFecha(2,6,2022);
    $horaexamen = hora::createHora(10,0,0);
    $examen = new examen($asignatura, $profesor, $listadoPreguntas, $fechaexamen, $horaexamen);

   $examen->AddRespuesta(0, "con include_once y vendor/autoload.php");
   $examen->AddRespuesta(1, "depende de pará qué, los dos tienen sus cosas buenas y malas");
   $examen->AddRespuesta(2, "no compres seguro que es estafa");
   $examen->AddRespuesta(3, "sin cebolla");
   $examen->AddRespuesta(4, "3,14");

   $examen->setPuntuacion(0,10);
   $examen->setPuntuacion(1,9);
   $examen->setPuntuacion(2,7);
   $examen->setPuntuacion(3,4);
   $examen->setPuntuacion(4,-11210);

   $examen->showAllExamen();


