<?php

namespace mm\tasks;

use pocketmine\scheduler\Task;
use pocketmine\level\Position;

use mm\game\Game;
use mm\utils\Vector;

class SpawnGoldTask extends Task{

    public function __construct(Game $plugin){
        $this->plugin = $plugin;
    }

    public function onRun(int $ct){
        switch($this->plugin->phase){
            case Game::PHASE_GAME:
                $spawns = (int) $this->plugin->plugin->getConfig()->get("GoldSpawns");
                $spawn = mt_rand(1, $spawns);
                $this->plugin->dropItem($this->plugin->map, 266, Position::fromObject(Vector::fromString($this->plugin->data["gold"]["gold-$spawn"])));
            break;
        }
    }
}