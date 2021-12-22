<?php

namespace mm\tasks;

use pocketmine\scheduler\Task;
use mm\utils\IronSwordEntity;

class DespawnSwordEntity extends Task{

    public function __construct(IronSwordEntity $entity){
        $this->sword = $entity;
    }

    public function onRun(int $ct){
        if(!$this->sword->isClosed()){
            $this->sword->close();
        }
    }
}
