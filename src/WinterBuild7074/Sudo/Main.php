<?php

namespace WinterBuild7074\Sudo;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;

class Main extends PluginBase {

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool {
		switch($cmd->getName()) {
			case "as":
			case "run-as":
			case "sudo":
				if($sender->hasPermission("sudo")) {
					if(isset($args[0]) && isset($args[1])) {
						$player = $args[0];
						if($this->getServer()->getPlayer($player)) {
							$command = array_splice($args, 1, PHP_INT_MAX);
							$run_cmd = implode(" ", $command);
							$run_player = $this->getServer()->getPlayer($player);
							$this->getServer()->dispatchCommand($run_player, $run_cmd);
							$sender->sendMessage("§7§oRan command as §r§7" . $player->getDisplayName() . "§r§7§o.");
						} else {
							$sender->sendMessage("§cThat player is not online!");
						}
					} else {
						$sender->sendMessage("§cUsage: /" . $label . " <player> <command>");
					}
				}
				break;
		}
		return false;
	}
}
