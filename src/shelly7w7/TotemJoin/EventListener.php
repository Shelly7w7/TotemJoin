<?php

declare(strict_types=1);

namespace shelly7w7\TotemJoin;

use pocketmine\entity\animation\TotemUseAnimation;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\VanillaItems;
use pocketmine\world\sound\TotemUseSound;

class EventListener implements Listener {

	public function onPlayerJoin(PlayerJoinEvent $event): void {

		$player = $event->getPlayer();
		$item = $player->getInventory()->getItemInHand();
		$player->getInventory()->setItemInHand(VanillaItems::TOTEM());
		$player->broadcastAnimation(new TotemUseAnimation($player));
		if(Loader::getInstance()->getConfig()->get("join-totem-sound") === true) {
			$player->getWorld()->addSound($player->getPosition(), new TotemUseSound());
		}
		$player->getInventory()->setItemInHand($item);

	}

}