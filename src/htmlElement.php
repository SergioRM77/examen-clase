<?php
namespace ITEC\Presencial\DAW\HTMLElement;
function CrearHTMLelement($nombreTag, $atributos, $contenido, $vacio)
{
    $contenido = Validarcontenido($contenido, $vacio);
    return [
        "NombreTag" => $nombreTag,
        "Atributos" => $atributos,
        "contenido" => $contenido,
        "vacio" => $vacio
    ];
}
/*
function ValidarAtributos($atributo){
   return !is_string($atributo) ? NULL : $atributo ;

}
*/
function Validarcontenido($contenido, $vacio)
{
    return $vacio == true ? "" : $contenido;   
}

function Att2HTML($atributos)
{
    //trim(quita espacio al principio y final)/ ltrim(quita el espacio del principio)/ rtrim(quita espacio del fianl)
    $resultado = "";
    foreach ($atributos as $clave => $valor){
        $resultado .= $clave . '="' . $valor . '" ';
    }
    return rtrim($resultado);
}

function toHTML($htmlElement){
    $atributos = Att2HTML($htmlElement["Atributos"]);
    if($htmlElement["vacio"]) {
        if($htmlElement["Atributos"] == null) return "<" . $htmlElement["NombreTag"] . ">";
        return "<" . $htmlElement["NombreTag"] . " " . $atributos . ">";
    }
    $code = "<" . $htmlElement["NombreTag"] . " " . $atributos . ">" . $htmlElement["contenido"] .
    "</" . $htmlElement["NombreTag"] . ">";
    return $code;
}
?>