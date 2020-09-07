<?php

declare(strict_types=1);

namespace shelly7w7\TotemJoin;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase
{

    /** @var Config $config */
    protected $config;
    /** @var self $instance */
    protected static $instance;

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);

        $config = $this->getConfig();
        $config->reload();
    }

    public static function getInstance(): self
    {
        return self::$instance;
    }
}