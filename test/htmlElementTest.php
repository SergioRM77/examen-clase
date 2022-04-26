<?php
use PHPUnit\Framework\TestCase;
use ITEC\Presencial\DAW\HTMLElement;

final class htmlElementTest extends TestCase{
    function DPCrearHTMLelementTest(){
        $br = [
                "NombreTag" =>"br",
                "Atributos" => [],
                "contenido" => "",
                "vacio" => true
            ];
            $p = [
                "NombreTag" =>"p",
                "Atributos" => [
                    "id" => "parrafoIntroduccion",
                    "class" => "Normal"
                    ],
                "contenido" => "Prueba",
                "vacio" => false
            ];
            $hr = [
                "NombreTag" =>"hr",
                "Atributos" => [],
                "contenido" => "",
                "vacio" => true];
        return [
            "br" => [$br,
                    "br",
                    [],
                    "",
                    true
                    ],
            "p" => [$p,
                    "p",
                    [
                        "id" => "parrafoIntroduccion",
                        "class" => "Normal"
                    ],
                    "Prueba",
                    false
                    ],
            "hr" => [
                    $hr,
                    "hr",
                    [],
                    "fsghfgsfh",
                    true
                    ]
            ];
    }

    /**
     * @dataProvider DPCrearHTMLelementTest
     */
    public function testCrearHTMLelement(
        $esperado, 
        $nombreTag, 
        $atributos, 
        $contenido,
        $vacio){
            $htmlElement = ITEC\Presencial\DAW\HTMLElement\CrearHTMLelement(
                $nombreTag, 
                $atributos, 
                $contenido,
                $vacio);
            $this ->assertEquals($esperado, $htmlElement);
            
        return $htmlElement;
        
    }
    //depends manda lo que quieras a traves de return, en caso de que funcione la prueba anterior
    //con el data provider que hacemos a continuacion se hace como anteriormente, es el valor esperado
    //se coloca el DP primero(esperado) 
    //y los valores que se metena a la funcion es el depends (lo devuelto de la anterior funcion)

    //esto no puede funcionar porque no se puede llamar a una funcion con depends, si esta funcion 
    //depende de otro data provider porque no puede acceder a lo anterior
    public function DPtestToHTML(){
        //$entrada = DPCrearHTMLelementTest();
        return [
            "br" => ["<br>", [
                "NombreTag" =>"br",
                "Atributos" => [],
                "contenido" => "",
                "vacio" => true]
            ],
            "hr" => ['<hr id="pruebaEspacios">', [
                "NombreTag" =>"hr",
                "Atributos" => [
                    "id" => "pruebaEspacios"
                ],
                "contenido" => "",
                "vacio" => true]
            ],
            "p" => ['<p id="parrafoIntroduccion" class="Normal">Prueba</p>', [
                "NombreTag" =>"p",
                "Atributos" => [
                    "id" => "parrafoIntroduccion",
                    "class" => "Normal"
                    ],
                "contenido" => "Prueba",
                "vacio" => false
            ]]

        ];
    }

    /**
     * @ depends testCrearHTMLelement
     * @dataProvider DPtestToHTML
     */
    public function testToHTML($htmlCodeEsperado, $htmlElement){
        $this -> assertEquals($htmlCodeEsperado, \ITEC\Presencial\DAW\HTMLElement\toHTML($htmlElement));
    }
}
?>