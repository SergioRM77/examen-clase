<?php
namespace ITEC\Presencial\DAW\HTMLElementClass;

use PhpParser\Node\Stmt\TryCatch;

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
        
        $this->NombreTag = $NombreTag;
        $this->Atributos = $Atributos;
        $this->contenido = $contenido;
        $this->vacio = $vacio;
    }
    
        
        
    /** 
     * añadir contenido a $etiqueta 
     * @param string $content
     */
    public function addContent(string $content){
        $this->contenido[] = $content;
        $this->vacio = false;
        
    }

    /**
     * ingresamos atributos y contenido al apartado "Atributos" de array 
     * @param string $atributo
     * @param string $atributoContent
     */
    public function addAttribute( string $atributo, string $atributoContent){
        $atributoFinal = $atributo .'="' . $atributoContent . '" ';
        $this->Atributos[] = $atributoFinal;
    }

    /**
     * quitar un atributo a partir del nombre
     * @param string $atributo
     * 
     */
    public function removeAttribute( string $atributo){
        if(isset($this->Atributos[$atributo]))
        unset($this->Atributos[$atributo]);
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
     * @param array $etiqueta
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
        $resultado = " ";
        
         foreach ($this->Atributos as $key => $value) {
            $resultado .= $value;
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