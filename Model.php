<?php
require_once "Car.php";
require_once "Driver.php";
require_once "AutoPark.php";

$mod = new Model();
$mod->setUP();
$mod->runAction(30);


class Model{
    public $cars=[];
    public $drivers=[];

    public function setUP($file = "in.json"){ //устанавливаем первоначальные параметры
        $ourData = file_get_contents($file); // var_dump($ourData); echo "\n\n";
        $objectJSON = json_decode($ourData); //var_dump($objectJSON); echo $objectJSON->park->places."\n";
        $this->setCars($objectJSON->cars);
        $this->setDrivers($objectJSON->drivers);

        //var_dump($this->cars);
        //echo "\n####-----####\n";
        $this->setCarDriver();
        //ar_dump($this->drivers);
    }

    private function setCarDriver(){
        $i=0;
        $cnt=0;

        if(count($this->cars)>count($this->drivers)){
            $cnt=count($this->drivers);
        }else{
            $cnt=count($this->cars);
        }

        echo "$cnt\n";

        foreach ($this->drivers as $drv){
            $drv->setCar($this->cars[$i]);
            $i++;
            if ($i>$cnt) break;
        }

        echo "$i\n";

    }
    /**
     * @param array $cars
     */
    private function setCars($cars)
    {
        $i=0;
        foreach($cars as $car){
            echo $car->brand." - ".$car->km."\n";
            switch ($car->brand) {
                case "Homba":
                    $this->cars[$i] = new Homba();
                    break;
                case "Luda":
                    $this->cars[$i] = new Luda();
                    break;
                case "Hendai":
                    $this->cars[$i] = new Hendai();
                    break;
            }
            $this->cars[$i]->km = $car->km;
            $i++;
        }
    }

    /**
     * @param array $drivers
     */
    private function setDrivers($drivers)
    {
        $i = 0;
        foreach($drivers as $drv){
            echo $drv->type."\n";
            switch ($drv->type) {
                case "advanced":
                    $this->drivers[$i] = new AdvanceDriver();
                    break;
                case "default":
                    $this->drivers[$i] = new Driver();
                    break;
            }
            $i++;
        }
    }
    /**
     * @param int $days
     */
    public function runAction($days){
        $day = 1;

        while ($day <= $days) {
            echo " # ".$day." START\n";
            foreach ($this->drivers as $drv){
                $drvCount =0;
                for($drvCount = 1; $drvCount <= $drv->countDrive; $drvCount++) {
                    $km = 7;
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


