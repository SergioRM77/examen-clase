<?php
namespace ITEC\Presencial\DAW\HTMLElementClass;
use ITEC\Presencial\DAW\DatosArrayElementos\ArrayElementos;


class HTMLElement {
    private false | string $NombreTag;
    private false | array $Atributos;
    private false | array|null $contenido;
    private bool $vacio;
    
    
       
    public function __construct(
        string $NombreTag,
        array $Atributos = [],
        array | null $contenido =  [],
        bool $vacio = true
    )
    {
        
            if($this->isValidTag($NombreTag) && $this->onlyString($NombreTag)){
                if($this->onlyString($NombreTag)) $this->NombreTag = $NombreTag;
                if($this->onlyString($Atributos)) $this->Atributos = $Atributos;
                if($this->onlyString($contenido)) $this->contenido = $contenido;
                 $this->vacio = $vacio;
            } else{
                throw new \Exception("Tag incorrecto " . $NombreTag);
            }
        /*
        try {
            if($this->isValidTag($NombreTag) && $this->onlyString($NombreTag)){
                if($this->onlyString($NombreTag)) $this->NombreTag = $NombreTag;
                if($this->onlyString($Atributos)) $this->Atributos = $Atributos;
                if($this->onlyString($contenido)) $this->contenido = $contenido;
                 $this->vacio = $vacio;
            }else{
                throw new Exception("Tag incorrecto");
            }
        } catch (Exception $error) {
            return $error;
        }
        */
        
        
    }

   
    private function onlyString(string | null | array $value){
        if(\is_array($value)){
            foreach ($value as $key => $val) {
                if($value[$key]==null) return true;
                if(!\is_string($val)) return false;
            }
            return true;
        }
        if($value == null) return true;
        return \is_string($value);

    }
    
    /**
     * validar nombre de tag 
     * @param string $NombreTag
     * @return bool
     */
    private function isValidTag(string $tag){
        
        foreach (ArrayElementos::$ATTRIBUTES as $key => $value) {
            if (is_array( ArrayElementos::$ATTRIBUTES[$key]) && 
                in_array($tag, ArrayElementos::$ATTRIBUTES[$key])) return true;
                
            
        }
        
    }
        
    /** 
     * añadir contenido a $etiqueta 
     * @param string $content
     */
    public function addContent(string $content){
        
            if(!$this->validateContentIsEmpty()){
                $this->contenido[] = $content;
                $this->vacio = false;
            }
        
    }

    private function validateContentIsEmpty(){
        return \in_array($this->NombreTag, ArrayElementos::$AttributesEmpty);
    }

    /**
     * ingresamos atributos y contenido al apartado "Atributos" de array 
     * @param string $atributo
     * @param string $atributoContent
     */
    public function addAttribute( string $atributo, string $atributoContent){
        
            if($this->validateAttributes($atributo, $atributoContent)){
                $atributoFinal = $atributo .'="' . $atributoContent . '"';
                $this->Atributos[] = $atributoFinal;
            }
        
    }

    /**
     * comprueba si coinciden la etiqueta y el atributo
     * @param string $atributo
     * @param string $atributoContent
     * @return bool
     */
    private function validateAttributes(string $atributo, string $atributoContent){
        if(array_key_exists($atributo, ArrayElementos::$ATTRIBUTE_VALUES)){
            return (
                \is_null(ArrayElementos::$ATTRIBUTE_VALUES[$atributo]) ||
                \is_array(\in_array($atributoContent, ArrayElementos::$ATTRIBUTE_VALUES[$atributo]))
            );
        }
        /*
        if( array_key_exists($atributo, ArrayElementos::$ATTRIBUTES)) 
            return ArrayElementos::$ATTRIBUTES[$atributo] == "global" ||
            is_array(\in_array($NombreTag, ArrayElementos::$ATTRIBUTES[$atributo]));
        */        
    }
    
    /**
     * quitar un atributo a partir del atributo completo
     * @param string $atributo
     * 
     */
    public function removeAttribute( string $atributo){
            
            $clave = array_search($atributo, $this->Atributos);
            if(is_numeric($clave)) unset($this->Atributos[$clave]);
            
    }

    /**
     * comprobar si el nombre del tag ingresado es igual a la etiqueta
     * @param HTMLElement $tags
     * @return bool
     */
    public function isSameTag(HTMLElement $tags): bool{
        return $this->NombreTag == $tags->getTagname();
    }

    /**
     * monta el contenido de la etiqueta en lenguaje html
     * @return string
     */
    public function getHtml(){
        if($this->vacio == true){
            $this->contenido = null;
            return "<" . $this->NombreTag .  $this->makeAttributeS() . ">";

        }else{

            return "<" . $this->NombreTag .  $this->makeAttributeS() . ">"
                    . $this->makeContent() . "</" . $this->NombreTag . ">";
        }
    }

    private function makeAttributeS(){
        $resultado = "";
        
         foreach ($this->Atributos as $key => $value) {
            $resultado .= " " . $value;
        }
        return rtrim($resultado);
    
    }

    private function makeContent(){
        $resultado = "";
        foreach ($this->contenido as $key => $value) {
            $resultado .= $value; 
        }
        return $resultado;
    }

    //
    public function getTagname(): string{
        return $this->NombreTag;
    }

    public function getAttributes(): string{
        return $this->makeAttributeS();
    }

    public function getContent(): string{
        return $this->makeContent();
    }

    public function getEmpty(): bool{
        return $this->vacio;
    }


    /**
     * 
     */
    public static function create(
        string $NombreTag,
        array $Atributos ,
        array | null $contenido ,
        bool $vacio
    ){
        return new HTMLElement($NombreTag,$Atributos ,$contenido ,$vacio);
    }

    /**
     * metodo estatico para devolver pagina con el elemento que se ingrerse
     * 
     * @return string
     */
    public static function createHtml5(){

        $entrada = self::create("!DOCTYPE", ["html"], null, true);
        $entrada = $entrada->getHtml();
        $languaje = self::create("html", ['lang="en"'], null, true);
        $languaje = $languaje->getHtml();
        $meta1 = self::create("meta", ['charset="UTF-8"'], null, true);
        $meta1 = $meta1->getHtml();
        $meta2 = self::create("meta", [
            'http-equiv="X-UA-Compatible"',
            'content="IE=edge"'
        ], null, true);
        $meta2 = $meta2->getHtml();
        $meta3 = self::create("meta", [
            'name="viewport"',
            'content="width=device-width, initial-scale=1.0"'
        ], null, true);
        $meta3 = $meta3->getHtml();
        $title = self::create("title", [], ["titulo"], false);
        $title = $title->getHtml();
        $head = self::create("head", [], [
            "\n", $meta1,"\n", $meta2,"\n", $meta3,"\n", $title,"\n"
        ], false);
        $head = $head->getHtml();
        
        $body = self::create("body", [],[
                
            ], false);
        $body = $body->getHtml();
        return $entrada . "\n" . $languaje . "\n" . $head . "\n" . $body;

        /* return 
            '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body>' .
                $setEtiqueta .
            '</body>
            </html>';
            */
    }
}


?>