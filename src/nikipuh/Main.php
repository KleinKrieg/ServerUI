<?php
namespace nikipuh;

use pocketmine\{Server, Player};
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\entity\Effect;
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
use pocketmine\event\server\DataPacketReceiveEvent;
use jojoe77777\FormAPI;

class Main extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label,array $args): bool{
		$player = $sender->getPlayer();
		switch($cmd->getName()){
			case "admin":
			$this->mainFrom($player);
			break;		
		}
		return true;
	}
	
	public function mainFrom($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $event, array $data){
		$player = $event->getPlayer();
		$result = $data[0];
		if($result === null){
		}
		switch($result){							
			case 0:
			break;
			case 1:
			$this->banUI($player);
			break;
			case 2:
			$this->kickUI($player);
			break;
			}					
		});					
		$form->setTitle("Administrationsbereich");
		$form->setContent("");
		$form->addButton(TextFormat::BLACK . "Schließen");
		$form->addButton(TextFormat::BLACK . "Banne einen Spieler");
		$form->addButton(TextFormat::BLACK . "Kicke einen Spieler");
		$form->addButton(TextFormat::BLACK . "Banne eine IP");
		$form->addButton(TextFormat::BLACK . "Mute einen Spieler");
		$form->sendToPlayer($player);
	}
	
	public function banUI($player){ 
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI"); 
		$form = $api->createCustomForm(function (Player $event, array $data){
		$player = $event->getPlayer();
		$result = $data[0];
		if($result != null){
		$this->targetName = $result;
		$this->reason = $data[1];
		$this->getServer()->dispatchCommand(new ConsoleCommandSender, "ban " . $this->targetName . " " . $this->reason);
		}
		});
		$form->setTitle("Banne einen Spieler");
		$form->addInput("Name des Spielers");
		$form->addInput("Grund für den Ban");
		$form->sendToPlayer($player);
	}
}
