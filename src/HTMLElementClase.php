<?php
namespace ITEC\Presencial\DAW\HTMLElementClass;

use Exception;
use ITEC\Presencial\DAW\DatosArrayElementos\ArrayElementos;

use function PHPUnit\Framework\throwException;

class HTMLElement {
    private string $NombreTag;
    private array $Atributos;
    private array|null $contenido;
    private bool $vacio;
    
    
       
    public function __construct(
        string $NombreTag,
        array $Atributos = [],
        array | null $contenido =  [],
        bool $vacio = true
    )
    {
        
        try {
            if($this->isValidTag($NombreTag)){
                $this->NombreTag = $NombreTag;
                $this->Atributos = $Atributos;
                $this->contenido = $contenido;
                $this->vacio = $vacio;
            }else{
                throw new Exception("Tag incorrecto");
            }
        } catch (Exception $error) {
            return $error;
        }
        
        
    }
    
    /**
     * validar nombre de tag 
     * @param string $NombreTag
     * @return bool
     */
    private function isValidTag(string $tag){
        
        if(array_search($tag, ArrayElementos::$ATTRIBUTES)) return true;
        
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
        if($this->validateAttributes($atributo, $this->NombreTag)){
            $atributoFinal = $atributo .'="' . $atributoContent . '"';
            $this->Atributos[] = $atributoFinal;
        }
    }

    /**
     * comprueba si coinciden la etiqueta y el atributo
     * @param string $atributo
     * @param string $NombreTag
     * @return bool
     */
    private function validateAttributes(string $atributo, string $NombreTag){
        
        if( array_key_exists($atributo, ArrayElementos::$ATTRIBUTES)) 
            return ArrayElementos::$ATTRIBUTES[$atributo] == "global" ||
            is_array(\in_array($NombreTag, ArrayElementos::$ATTRIBUTES[$atributo]));
                
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


}


?>