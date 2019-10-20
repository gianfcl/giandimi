<?php

namespace App\Mail\Infinity;
Use Log;

class ActualizacionConoceme extends \App\Mail\Mail {
    
    const SUBTITULO = 'Actualización de ficha Conóceme';
    
    protected $_cliente;
    protected $_cu;
    protected $_url;
    protected $_ejecutivo;
    protected $_to;
    protected $_destinatarios;
    
    public function __construct(\App\Entity\Usuario $ejecutivo,$cliente,$cu,$url) {
        //$this->_titulo = parent::TITULO . self::SUBTITULO;
        $this->_cliente = $cliente;
        $this->_cu = $cu;
        $this->_url = $url;
        $this->_ejecutivo = $ejecutivo;
        $en = \App\Entity\Usuario::getEjecutivo($ejecutivo->getValue('_registro'));
        //$this->_to = ['dlopezp@intercorp.com.pe'];
        $this->_destinatarios = $en->EMAIL_EN;
        //$this->to = [$jefe->EMAIL_JEFATURA_ZONAL];
    }

    public function build() {
        return $this
                ->to($this->_destinatarios)
                ->subject(parent::TITULO . self::SUBTITULO)
                ->view('emails.infinity.actualizacionConoceme')
                ->with('cliente',$this->_cliente)
                ->with('cu',$this->_cu)
                ->with('url',$this->_url)
                ->with('ejecutivo',$this->_ejecutivo->getValue('_nombre'));
    }

}
