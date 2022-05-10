<?php
namespace ITEC\DAW\fecha;

class fecha{
    private int $dia;
    private int $mes;
    private int $annio;
    private \DateTime $validarFecha;

    public function __construct(int $dia, int $mes, int $annio){
        $this->validarFecha = new \DateTime();
        $this->validarFecha->setDate($annio, $mes, $dia);
        $this->dia = $dia;
        $this->mes = $mes;
        $this->annio = $annio;
    }

    public static function createFecha(int $dia, int $mes, int $annio){
        return new fecha($dia, $mes, $annio);
    }

    public function __toString(){
        return $this->validarFecha->format('j/n/Y');
    }
    public function getFechaStr():string{
        return $this;
    }

    public function getDateLeft() {
        $now = new \DateTime();
        return $now->diff($this->validarFecha)->format("j");
    }
}
?>