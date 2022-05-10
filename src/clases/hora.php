<?php
namespace ITEC\DAW\examen;

class hora{
    private int $hora;
    private int $minutos;
    private int $segundos;
    private DateTime $datetimeObj;

    public function __construct(int $hora, int $minutos, int $segundos){
        $this->datetimeObj = new DateTime();
        $this->datetimeObj = setTime($hora,$minutos,$segundos);
        $this->hora = $hora;
        $this->minutos = $minutos;
        $this->segundos = $segundos;
        
    }

    public static function createHora(int $hora, int $minutos, int $segundos){
        return new hora($hora, $minutos, $segundos);
    }

    public function __toString(){
        return $this->datetimeObj->format("G:i:s");
    }
    /*
    al llamar a este método nos va a retornar ese objeto, pero él lo que devuelve le hemos dicho que es ':string'
    y externamente es como si le dijeramos echo $objeto, por tanto esto accede a __toString()
    */
    public function getHoraStr():string{
        return $this;
    }

    /**
     * tiempo restante hasta fecha del objeto
     * @return DateTime
     */
    public function getTimeLeft() {
        $now = new DateTime();
        return $now->diff($this->datetimeObj)->format("G");
    }

}
?>