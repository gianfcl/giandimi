<?php

namespace App\Entity\Base;
use Jenssegers\Date\Date as Carbon;

class Entity {

    protected $_message;
    protected $_periodo;

    CONST RETRASO_RCC_MESES = 2;

    public static function periodoToDia($periodo){
        return Carbon::createFromFormat('Ymd', $periodo.'01');
    }

    public static function sgetPeriodo(){
        return config('app.periodo');
    }

    public function getPeriodo(){
        return config('app.periodo');
    }

    public function getPeriodoBE(){
        return config('app.periodobe');
    }

    public static function sgetPeriodoBE(){
        return config('app.periodobe');
    }
    
    public static function sgetPeriodoInfinity(){
        return config('app.periodoInfinity');
    }

    public static function sgetPeriodoInfinityAnt(){
        $periodoActual=self::sgetPeriodoInfinity();
        $mes=substr($periodoActual, 4,2);
        $anho=substr($periodoActual, 0,4);

        if($mes==1){
            return (string)($anho-1)."12";
        }
        else{
            $mes_1=$mes-1;
            if($mes_1<10) $mes_1='0'.(string)($mes_1);
            return $anho.$mes_1;
        }
    }
    

    function getValue($propertie) {
        if (property_exists($this, $propertie)) {
            return $this->{$propertie};
        } else {
            return false;
        }
    }

    function getMessage() {
        return $this->_message;
    }
	
    function filterValue($value, $valueDefault = '') {
        return ($value === '' ? ($valueDefault === '' ? NULL : $valueDefault) : $value);
    }

    function setMessage($message) {
        $this->_message = $message;
    }

    function setValue($properti, $value) {
        $propsFormat = $this->setFormatValue();
        if (in_array($properti, $propsFormat)) {
            $this->$properti = $value;
        } else {
            trigger_error('El Key <b>"' . $properti . '"</b> no coinciden con las propiedades de la clase ', E_USER_ERROR);
            exit;
        }
    }

    function getValues() {
        $cl = new \ReflectionClass($this);
        $props = $cl->getProperties(\ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $propsFormat[$prop->getName()] = $this->{$prop->getName()};
        }
        return $propsFormat;
    }

    function setValues($data) {
        if ($data != NULL && is_array($data)) {
            $propsFormat = $this->setFormatValue();
            foreach ($data as $index => $value) {
                if (in_array($index, $propsFormat)) {
                    $this->$index = $value;
                } else {
                    trigger_error('El Key <b>"' . $index . '"</b> no coinciden con las propiedades de la clase ', E_USER_ERROR);
                    exit;
                }
            }
        }
    }

    function setFormatValue() {
        $cl = new \ReflectionClass($this);
        $props = $cl->getProperties(\ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $propsFormat[] = $prop->getName();
        }
        return $propsFormat;
    }

    protected function cleanArray($data) {
        foreach ($data as $index => $value) {
            if ($value === 0)
                continue;
            if ($value === '' || $value == '') {
                unset($data[$index]);
            } else {
                if ($value === 'NULL') {
                    $data[$index] = null;
                }
            }
        }
        return $data;
    }

    static function getPeriodosPrevios($periodo,$antiguedad = 1){
        $fecha = Carbon::createFromFormat('Ymd', $periodo.'01');
        $lista = [$periodo];
        for ($i=0; $i < $antiguedad; $i++) { 
            $lista[] = $fecha->addMonth(-1)->format('Ym');
        }
        return $lista;
    }

    static function getMesesPrevios($periodo,$antiguedad = 1){
        $fecha = Carbon::createFromFormat('Ymd', $periodo.'01');

        $lista[] = ['PERIODO'=>$fecha->format('Ym'),
                        'MES'=>ucwords ($fecha->format('F Y'))
            ];
        for ($i=0; $i < $antiguedad; $i++) { 
            $fecha=$fecha->addMonth(-1);

            $elemento=['PERIODO'=>$fecha->format('Ym'),
                        'MES'=>ucwords ($fecha->format('F Y'))
            ];

            $lista[] = $elemento;
        }
        return $lista;
    }

}
