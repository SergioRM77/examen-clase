<?php
use PHPUnit\Framework\TestCase;
use ITEC\Presencial\DAW\HTMLElementClass;
use ITEC\Presencial\DAW\DatosArrayElementos;

final class HTMLElementClassTest extends TestCase{
    function DPHTMLElementClassTest(){
        $etiqueta1 = "<hr>";
        $etiqueta2 = "<p>parrafo</p>";
        $etiqueta3 = '<div id="divid" class="divclass">contenido</div>';
        $etiqueta4 = "<h1></h1>";
        $etiqueta5 = '<div id="divid" class="divclass"><h1></h1><p>parrafo</p><hr></div>';
        $etiqueta6 = '<div id="divid" class="divclass"><h1></h1><p>parrafo</p><hr></div>';


        $classTag1 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("hr",[],[]);
        $resultado1 = $classTag1->getHtml();

        $classTag2 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("p",[],[],true);
        $classTag2->addContent("parrafo");
        $resultado2 = $classTag2->getHtml();
        
        $classTag3 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("div",[],[],false);
        $classTag3->addAttribute("id", "divid");
        $classTag3->addAttribute("class", "divclass");
        $classTag3->addContent("contenido");
        $resultado3 = $classTag3->getHtml();

        $classTag4 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("h1",[],[],false);
        $classTag4->addContent("");
        $resultado4 = $classTag4->getHtml();

        $classTag5 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("div",[],[$resultado4,$resultado2,$resultado1],false);
        $classTag5->addAttribute("id", "divid");
        $classTag5->addAttribute("class", "divclass");
        $resultado5 = $classTag5->getHtml();

        $classTag6 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("div",['id="divid"', 'class="divclass"'],[$resultado4,$resultado2,$resultado1],false);
        $resultado6 = $classTag6->getHtml();
        
        return [
            "prueba hr" => [$etiqueta1,$resultado1],
            "prueba p" => [$etiqueta2,$resultado2],
            "prueba div" => [$etiqueta3,$resultado3],
            "prueba h1" => [$etiqueta4,$resultado4],
            "prueba de todo junto" => [$etiqueta5, $resultado5],
            "prueba de todo junto 2" => [$etiqueta6, $resultado6]
        ];
    }

    /**
     * @dataProvider DPHTMLElementClassTest
     */
    public function testHTMLElement($esperado, $entregado){
        $this->assertEquals($esperado,$entregado);
    }

    public function testHTMLElement2(){
        $classTag1 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("hr",[],[]);
        $resultado1 = $classTag1->getHtml();

        $classTag2 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("p",[],[],true);
        $classTag2->addContent("parrafo");
        $resultado2 = $classTag2->getHtml();
        
        $classTag3 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("div",[],[],false);
        $classTag3->addAttribute("id", "divid");
        $classTag3->addAttribute("class", "divclass");
        $classTag3->addContent("contenido");
        $resultado3 = $classTag3->getHtml();

        $classTag4 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("h1",[],[],false);
        $classTag4->addContent("");
        $resultado4 = $classTag4->getHtml();

        $classTag5 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("div",[],[$resultado4,$resultado2,$resultado1],false);
        $classTag5->addAttribute("id", "divid");
        $classTag5->addAttribute("class", "divclass");
        $resultado5 = $classTag5->getHtml();

        $this->assertEquals("hr", $classTag1->getTagname());
        $this->assertEquals(' id="divid" class="divclass"', $classTag3->getAttributes());
        $this->assertEquals("<h1></h1><p>parrafo</p><hr>", $classTag5->getContent());
        $this->assertTrue( $classTag1->getEmpty());
        $this->assertFalse( $classTag4->getEmpty());
    }

    public function testHTMLElement3(){
        $classTag3 = new ITEC\Presencial\DAW\HTMLElementClass\HTMLElement("div",[],[],false);
        $classTag3->addAttribute("id", "divid");
        $classTag3->addAttribute("class", "divclass");
        $classTag3->addContent("contenido");
        $classTag3->removeAttribute('id="divid"');
        $resultado3 = $classTag3->getHtml();
        $this->assertEquals('<div class="divclass">contenido</div>',$resultado3);
    }
}
?>