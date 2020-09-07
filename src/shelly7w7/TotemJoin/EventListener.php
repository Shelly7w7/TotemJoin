<?php

declare(strict_types=1);

namespace shelly7w7\TotemJoin;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\Item;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\LevelEventPacket;

class EventListener implements Listener
{

    /** @var Loader $plugin */
    private $plugin;

    public function __construct(Loader $plugin)
    {
        $this->plugin = $plugin;
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void
    {

        $player = $event->getPlayer();
        $item = $player->getInventory()->getItemInHand();
        $player->getInventory()->setItemInHand(Item::get(Item::TOTEM));
        $player->broadcastEntityEvent(ActorEventPacket::CONSUME_TOTEM);

        if (Loader::getInstance()->getConfig()->get("join-totem-sound") === true) {
            $player->getLevel()->broadcastLevelEvent($player->add(0, $player->getEyeHeight()), LevelEventPacket::EVENT_SOUND_TOTEM);
        }

        $player->getInventory()->setItemInHand($item);


    }

}