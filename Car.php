<?php

class Car { //Класс для авто, надо "вероятно" его сделать абстрактным
    public $km;  // пробег
    public $brand; // марка авто
    public $fuelUsage = 10; // расход топлива
    public $breakP = 0.5; // вероятность поломки
    public $breakStatus = 0;//состояние поломки 0 - исправна, 1..3 - сломана/оставшиеся дни ремонта


    function __construct(){
        $this->brand ="";
        $this->fuelUsage =10;
        $this->breakP = 0.5;
    }

    /**
     * @param int $kms
     *
     */
    public function drive(int $kms): bool
    {
        if($this->crashCheck()!=0){
            return FALSE;
        }
        $this->km += $kms;
        return TRUE;
    }

    /**
     * @return int $breakStatus
     * тут надо осторожно - т.к. статистически если вызывать часто метод - то вероятность стутуса аварии увеличивается
     * Если считать по километражу каждый км то каждая проверка должна быть c вероятностью 1/1000 или 1/70 от текущей вероятности
     * надо подумать и реализовать правильнее
     * В данный момент количеством проверок - пренебрегаем
     */
    public function crashCheck(): int
    {//Проверка состояния авто на возможную поломку
        /*
         * Используем одну из функций для генерации случайных значений от 0 до 100
         * random_int(int $min, int $max): int
         * rand(int $min, int $max): int
         */
        $pRnd=rand(0,100);
        if($this->breakStatus!=0 && $pRnd<$this->getCrashRisk()){
            $this->breakStatus=3;
        }
        return $this->breakStatus;
    }

    /**
     * @return float car accident (crash) risk
     * в любой момент можно получить вероятность поломки в зависимости от текущего пробега
     */
    public function getCrashRisk(): float
    {
        return $this->breakP + intdiv($this->km,1000)*0.01;
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
    /**
     * @return float car accident (crash) risk
     * в любой момент можно получить вероятность поломки в зависимости от текущего пробега
     * Переопределен т.к. данная марка ломается в 3 раза чаще
     */
    public function getCrashRisk(): float
    {
        return $this->breakP + intdiv($this->km,1000)*0.03;//ломается в 3 раза чаще
    }
}
