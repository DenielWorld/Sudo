<?php

namespace WinterBuild7074\RCAP;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;

class Main extends PluginBase {

	public function onCommand(CommandSender $sender, Command $cmd, $label, array $args) {
		switch($cmd->getName()) {
			case "as":
			case "run-as":
			case "sudo":
				if($sender->hasPermission("rcap")) {
					if(isset($args[0])) {
						$player = $args[0];
						if($this->getServer()->getPlayer($player)) {
							if(isset($args[1])) {
								$command = array_splice($args, 1, 99999);
								$run_cmd = implode(" ", $command);
								$run_player = $this->getServer()->getPlayer($player);
								$this->getServer()->dispatchCommand($run_player, $run_cmd);
								$sender->sendMessage("§aRan command as §o" . $player . "§r§a.");
							} else {
								$sender->sendMessage("§cUsage: /" . $label . " <player> <command>");
							}
						} else {
							$sender->sendMessage("§cThat player is not online!");
						}
					} else {
						$sender->sendMessage("§cUsage: /" . $label . " <player> <command>");
					}
				}
				break;
		}
	}
}
