<?php
namespace nikipuh;

use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\utils\{TextFormat};
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\Listener;
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
use pocketmine\entity\{Entity, Effect};
use pocketmine\event\player\{PlayerMoveEvent, PlayerJoinEvent, PlayerQuitEvent, PlayerExhaustEvent, PlayerInteractEvent, PlayerDropItemEvent};
use jojoe77777\FormAPI;
use onebone\economyapi\EconomyAPI;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        $player = $sender->getPlayer();
        switch ($cmd->getName()){
            case "menü":
                $this->mainFrom($player);
                break;
        }
        return true;
    }
    public function mainFrom($player){
        $plugin = $this->getServer()->getPluginManager();
        $formapi = $plugin->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function (Player $event, array $args){
            $result = $args[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0:
                    return;
                case 1:
                    $this->shopForm($player);
                    return;
                    }
        });
        $form->setTitle(TextFormat::WHITE . "Hauptmenü");
        $name = $player->getName();
        $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $money = $eco->myMoney($name);
        $form->setContent("Willkommen im Menu, $name! \nDein Geld: §c" . $money);
        $form->addButton("§cVerlasse das Menü");
        $form->addButton("§0ItemShop");
        $form->sendToPlayer($player);
    }
    public function shopForm($player){
        $plugin = $this->getServer()->getPluginManager();
        $formapi = $plugin->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function (Player $event, array $args){
            $result = $args[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0:
                $this->Menu($player);
                    return;
                case 1:
                    $this->weaponsForm($player);
                    return;
                case 2:
                    $this->toolsForm($player);
                    return;
                case 3:
                    $this->armorsForm($player);
                    return;
                case 4:
                    $this->specialitemsForm($player);
                    return;     
            }
        });
        $form->setTitle(TextFormat::WHITE . "ItemShop");
        $name = $player->getName();
        $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $money = $eco->myMoney($name);
        $form->setContent("Dein Geld: " . $money);
        $form->addButton(TextFormat::GREEN."§cZurück");
        $form->addButton(TextFormat::WHITE."§0Waffen");
        $form->addButton(TextFormat::WHITE."§0Werkzeuge");
        $form->addButton(TextFormat::WHITE."§0Rüstungsteile");
        $form->addButton(TextFormat::WHITE."§0Spezielle Items");
        $form->sendToPlayer($player);
    }
    public function weaponsForm($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $event, array $data){
            $result = $data[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0:
                    $this->ShopForm($player);
                    break;
                case 1:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 2500) {
                        $this->itemId = 268;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 2500);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 2:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 5000) {
                        $this->itemId = 272;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 5000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 3:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 10000) {
                        $this->itemId = 267;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 10000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 4:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 15000) {
                        $this->itemId = 283;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 15000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 5:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 25000) {
                        $this->itemId = 276;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 25000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 6:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 2000) {
                        $this->itemId = 261;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 2000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 7:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 3000) {
                        $this->itemId = 262;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 64));
                        EconomyAPI::getInstance()->reduceMoney($player, 3000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
            }
        });
        $form->setTitle("Waffen");
        $name = $player->getName();
        $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $money = $eco->myMoney($name);
        $form->setContent("Dein Geld: " . $money);
        $form->addButton("Zurück zum ShopMenü");
        $form->addButton("§0Holzschwert: $2500", 0, "textures/items/wood_sword");
        $form->addButton("§0Steinschwert: $5000", 0, "textures/items/stone_sword");
        $form->addButton("§0Goldschwert: $10000", 0, "textures/items/gold_sword");
        $form->addButton("§0Eisenschwert: $15000", 0, "textures/items/iron_sword");
        $form->addButton("§0Diamantenschwert: $25000", 0, "textures/items/diamond_sword");
        $form->addButton("§0Bogen: $2000", 0, "textures/items/bow_standby");
        $form->addButton("§0Pfeile(64x): $3000", 0, "textures/items/arrow");
        $form->sendToPlayer($player);
    }
    public function toolsForm($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $event, array $data){
            $result = $data[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0:
                    $this->mainFrom($player);
                    break;
                case 1:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 25000) {
                        $this->itemId = 278;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 25000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 2:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 15000) {
                        $this->itemId = 285;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 15000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 3:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 20000) {
                        $this->itemId = 257;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 20000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 4:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 5000) {
                        $this->itemId = 274;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 5000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 5:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 2500) {
                        $this->itemId = 270;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 2500);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
            }
        });
        $form->setTitle("Werkzeuge");
        $name = $player->getName();
        $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $money = $eco->myMoney($name);
        $form->setContent("Dein Geld: " . $money);
        $form->addButton("§cZurück");
        $form->addButton("§0Diamantenspitzhacke : $25000", 0, "textures/items/diamond_pickaxe");
        $form->addButton("§0Goldspitzhacke: $15000", 0, "textures/items/gold_pickaxe");
        $form->addButton("§0Eisenspitzhacke: $10000", 0, "textures/items/iron_pickaxe");
        $form->addButton("§0Steinspitzhacke: $5000", 0, "textures/items/stone_pickaxe");
        $form->addButton("§0Holzspitzhacke: $2500", 0, "textures/items/wood_pickaxe");
        $form->sendToPlayer($player);
    }
    public function armorsForm($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $event, array $data){
            $result = $data[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0:
                    $this->mainFrom($player);
                    break;
                case 1:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 25000) {
                        $this->itemId = 310;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 25000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 2:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 25000) {
                        $this->itemId = 311;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 25000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 3:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 25000) {
                        $this->itemId = 312;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 25000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 4:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 25000) {
                        $this->itemId = 313;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 25000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 5:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 15000) {
                        $this->itemId = 302;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 15000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 6:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 15000) {
                        $this->itemId = 303;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 15000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 7:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 15000) {
                        $this->itemId = 304;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 15000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 8:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 15000) {
                        $this->itemId = 305;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 15000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 9:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 17000) {
                        $this->itemId = 306;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 17000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 10:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 17000) {
                        $this->itemId = 307;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 17000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 11:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 17000) {
                        $this->itemId = 308;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 17000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 12:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 17000) {
                        $this->itemId = 309;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 17000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 13:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 12000) {
                        $this->itemId = 314;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 12000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 14:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 12000) {
                        $this->itemId = 315;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 12000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 15:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 12000) {
                        $this->itemId = 317;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 12000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 16:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 12000) {
                        $this->itemId = 317;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 12000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                       $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 17:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 10000) {
                        $this->itemId = 298;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 10000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 18:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 10000) {
                        $this->itemId = 299;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 10000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 19:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 10000) {
                        $this->itemId = 300;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 10000);
                        $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 20:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 10000) {
                        $this->itemId = 201;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 10000);
                         $player->sendMessage("Du hast dir ein neues Rüstungsteil zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
            }
        });
        $form->setTitle("Rüstungsteile");
        $name = $player->getName();
        $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $money = $eco->myMoney($name);
        $form->setContent("Dein Geld: " . $money);
        $form->addButton("§cZurück");
        //DIAMOND
        $form->addButton("§0Diamantenhelm: $25000", 0, "textures/items/diamond_helmet");
        $form->addButton("§0Diamantenbrustplatte: $25000", 0, "textures/items/diamond_chestplate");
        $form->addButton("§0Diamantenbeinschutz: $25000", 0, "textures/items/diamond_leggings");
        $form->addButton("§0Diamantenschuhe: $25000", 0, "textures/items/diamond_boots");
        //chainmail
        $form->addButton("§0Kettenhut: $15000", 0, "textures/items/chainmail_helmet");
        $form->addButton("§0Kettenhemd: $15000", 0, "textures/items/chainmail_chestplate");
        $form->addButton("§0Kettenhose: $15000", 0, "textures/items/chainmail_leggings");
        $form->addButton("§0Kettenschuhe: $15000", 0, "textures/items/chainmail_boots");
        //IRON
        $form->addButton("§0Eisenhelm: $17000", 0, "textures/items/iron_helmet");
        $form->addButton("§0Eisenbrustplatte: $17000", 0, "textures/items/iron_chestplate");
        $form->addButton("§0Eisenbeinschutz: $17000", 0, "textures/items/iron_leggings");
        $form->addButton("§0Eisenschuhe: $17000", 0, "textures/items/iron_boots");
        //GOLD
        $form->addButton("§0Goldhelm: $12000", 0, "textures/items/gold_helmet");
        $form->addButton("§0Goldbrustpanzer: $12000", 0, "textures/items/gold_chestplate");
        $form->addButton("§0Goldbeinschutz: $12000", 0, "textures/items/gold_leggings");
        $form->addButton("§0Goldschuhe: $12000", 0, "textures/items/gold_boots");
        //LEATHER
        $form->addButton("§0Lederhut: $10000", 0, "textures/items/leather_helmet");
        $form->addButton("§0Ledershirt: $10000", 0, "textures/items/leather_chestplate");
        $form->addButton("§0Lederhose: $10000", 0, "textures/items/leather_leggings");
        $form->addButton("§0Ledersöckchen: $10000", 0, "textures/items/leather_boots");
        $form->sendToPlayer($player);
    }
    public function specialitemsForm($player){
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $event, array $data){
            $result = $data[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0:
                    $this->mainFrom($player);
                    break;
                case 1:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 20000) {
                        $this->itemId = 466;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 20000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 13:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 15000) {
                        $this->itemId = 322;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 15000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
                case 3:
                    $money = EconomyAPI::getInstance()->myMoney($player->getName());
                    if ($money >= 10000) {
                        $this->itemId = 396;
                        $player->getInventory()->addItem(Item::get($this->itemId, 0, 1));
                        EconomyAPI::getInstance()->reduceMoney($player, 10000);
                        $player->sendMessage("Du hast dir ein neues Item zugelegt.");
                    }else{
                        $player->sendMessage("Du hast nicht genug Geld.");
                    }
                    break;
            }
        });
        $form->setTitle("Spezielle Items");
        $name = $player->getName();
        $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $money = $eco->myMoney($name);
        $form->setContent("Dein Geld: " . $money);
        $form->addButton("§cZurück");
        $form->addButton("Verzauberter Goldapfel: $20000", 1, "https://www.digminecraft.com/food_recipes/images/golden_apple2.png");
        $form->addButton("Goldapfel: $150000", 1, "https://www.digminecraft.com/food_recipes/images/golden_apple.png");
        $form->addButton("Goldene Karotte: $10000", 1, "https://www.digminecraft.com/food_recipes/images/golden_carrot.png");
        $form->sendToPlayer($player);
    }
}
