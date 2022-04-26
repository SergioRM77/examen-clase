<?php
use PHPUnit\Framework\TestCase;
use ITEC\Presencial\DAW\HTMLElement;

final class htmlElementATTTest extends TestCase{
    function DPAtt2HTML(){
        $att1 = [];
        $esperado1 = "";
            $att2 =  [
                    "id" => "parrafoIntroduccion",
                    "class" => "Normal"
                    ];
            $esperado2 = 'id="parrafoIntroduccion" class="Normal"';
            $att3 = [
                    "id" => "container",
                    "class" => "centrado",
                    "style" => "position:absolute"
                ];
            $esperado3 = 'id="container" class="centrado" style="position:absolute"';
        return [
            "ATT vacio" => [$esperado1, $att1],
            "ATT id class" => [$esperado2, $att2],
            "ATT id class style" => [$esperado3, $att3]
        ];
    }

    /**
     * @dataProvider DPAtt2HTML
     */
    public function testAtt2HTML($esperado, $entregado){
            $this ->assertEquals($esperado, 
            ITEC\Presencial\DAW\HTMLElement\Att2HTML($entregado));
        
        
    }

    
}
?>