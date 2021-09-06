<?php

class Driver{ // обычный водитель
    public $type = "default";
    public $mod_fuelUse = 1;
    public $countDrive =10;
    public $car;

    function __construct(){
        //
    }

    /**
     * @param Car
     */
    public function setCar($car)
    {
        $this->car=$car;
    }

    /**
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }
    /**
     * @param int
     */
    public function taxing($distance)
    {
        $this->car->drive($distance);
    }
}

class AdvanceDriver extends Driver{ // "бывалый" водитель
    function __construct(){
        $this->type = "advanced";
        $this->mod_fuelUse = 0.8; // $this->mod_fuelUse*0.8;  //на 20% меньше расход
        $this->countDrive = 13;  // $this->countDrive*1.3;    //на 30% больше заказов
    }
}