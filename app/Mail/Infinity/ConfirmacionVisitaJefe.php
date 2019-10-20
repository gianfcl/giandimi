<?php

namespace App\Mail\Infinity;
Use Log;

class ConfirmacionVisitaJefe extends \App\Mail\Mail {
    
    const SUBTITULO = 'Confirmación de Visita Jefe';
    
    protected $_cliente;
    protected $_cu;
    protected $_url;
    protected $_jefe;
    protected $_ejecutivo;
    protected $_to;
    protected $_destinatarios;
    
    public function __construct($registroEjecutivo,$cliente,$cu,$url) {

        $this->_cliente = $cliente;
        $this->_cu = $cu;
        $this->_url = $url;
       
        $this->_jefe = \App\Entity\Usuario::getJefe($registroEjecutivo);
        $this->_ejecutivo = \App\Entity\Usuario::getEjecutivo($registroEjecutivo);

        $this->_destinatarios = $this->_ejecutivo->EMAIL_EN;

    }

    public function build() {
        return $this
                ->to($this->_destinatarios)
                ->subject(parent::TITULO . self::SUBTITULO)
                ->view('emails.infinity.confirmacionVisitaJefe')
                ->with('cliente',$this->_cliente)
                ->with('cu',$this->_cu)
                ->with('url',$this->_url)
                ->with('jefe',$this->_jefe->NOMBRE_JEFATURA);
    }

}
