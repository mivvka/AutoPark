<?php

class Car { //Класс для авто, надо "вероятно" его сделать абстрактным
    public $km;  // пробег
    public $brand; // марка авто
    public $fuelUsage = 10; // расход топлива
    public $breakP = 0.5; // вероятность поломки

    function __construct(){
        $this->brand ="";
        $this->fuelUsage =10;
        $this->breakP = 0.5;
    }

    public function drive($kms){
        $this->km += $kms;

    }
}

class Hendai extends Car { //Класс для авто "Hendai" - эталонная марка можно было наследовать все от этого класса.
   function __construct(){
        $this->brand ="Hendai";
        $this->fuelUsage =10;
        $this->breakP = 0.5;
    }
}
class Homba extends Car { //Класс для авто "Homba"
    function __construct(){
        $this->brand ="Homba";
        $this->fuelUsage =7; // На 30% экономичнее
        $this->breakP = 0.5;
    }
}
class Luda extends Car { //Класс для авто "Luda"
    function __construct(){
        $this->brand ="Luda";
        $this->fuelUsage =10;
        $this->breakP = 1.5; // Luda ломаются в 3 раза чаще
    }
}
