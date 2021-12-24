<?php

namespace mm\tasks;

use pocketmine\scheduler\Task;
use mm\game\Game;
use mm\utils\IronSwordEntity;

class CollideTask extends Task{

    public function __construct(Game $plugin, IronSwordEntity $sword){
        $this->plugin = $plugin;
        $this->sword = $sword;
    }

    public function onRun(int $ct){
        if(!$this->sword->isClosed()){
            foreach($this->plugin->players as $player){
                if($this->sword->asVector3()->distance($player) < 2){
                    if($this->plugin->getMurderer() !== $player){
                        $this->plugin->killPlayer($player, "§eMy man/murderer threw the sword at you");
                        $this->plugin->plugin->getScheduler()->scheduleDelayedTask(new DespawnSwordEntity($this->sword), 0);
                    }
                }
            }
        }
        if($this->sword->isCollided == true){
            $this->plugin->plugin->getScheduler()->scheduleDelayedTask(new DespawnSwordEntity($this->sword), 0);
        }
    }
}
