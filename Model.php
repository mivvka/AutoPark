<?php
require_once "Car.php";
require_once "Driver.php";
require_once "AutoPark.php";

$AutoPark = new AutoPark();
$AutoPark->setUP();
$mod = new Model($AutoPark);
$mod->runAction(30);


class Model{
    public AutoPark $AutoPark;

    public function __construct($AutoPark)
    {
        $this->AutoPark = $AutoPark;
    }

    /**
     * @param int $days
     */
    public function runAction(int $days){
        $day = 1;

        while ($day <= $days) {
            echo " # ".$day." START\n";
            foreach ($this->AutoPark->drivers as $drv){
                $drvCount =0;
                for($drvCount = 1; $drvCount <= $drv->countDrive; $drvCount++) {
                    $km = 7;  // Дистанция поездки в среднем =7км
                    $drv->taxing($km);
                    //echo "(".$drvCount.")";
                }
                echo $day." - ".$drv->type." - ".($drvCount-1)." - ".$drv->car->brand." - ".$drv->car->km."\n";

            }
            echo " # ".$day." END \n";
            $day++;
        }
    }

    public function report(){

    }
}


