<?php
declare(strict_types=1);

namespace mm\utils;

use mm\MurderMystery;
use mm\game\Game;
use pocketmine\entity\Entity;
use pocketmine\entity\Human;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\Player;

class DeadPlayerEntity extends Human{

	protected $playerName;

	protected function initEntity() : void{
		parent::initEntity();
		$this->setPlayerFlag(Entity::DATA_PLAYER_BED_POSITION, true);

		$this->setCanSaveWithChunk(false);

		$this->playerName = $this->namedtag->getString("playerName", "");
	}

	public function onUpdate(int $currentTick) : bool{
		if(!$this->getPlayerFlag(Entity::DATA_PLAYER_FLAG_SLEEP)){
			$this->setPlayerFlag(Entity::DATA_PLAYER_FLAG_SLEEP, true);
			$this->getDataPropertyManager()->setBlockPos(Entity::DATA_PLAYER_BED_POSITION, $this->floor()->add(0, -0.3, 1));
		}
		return parent::onUpdate($currentTick);
	}

	public function attack(EntityDamageEvent $source) : void{
		$source->setCancelled();
	}

	public function getPlayerName() : string{
		return $this->playerName;
	}
}
