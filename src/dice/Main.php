<?php

namespace dice; //このphpファイルがある場所の宣言

/*=====use文=====*/

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;

class Main extends PluginBase implements Listener
{ //クラス

    public function onEnable()
    { //このプラグインを読み込んだ時の動作

        $this->getServer()->getPluginManager()->registerEvents($this, $this); //イベント登録

        $this->getLogger()->info("§aDiceを読み込みました 製作chaca142");

    }

    public function onDisable()
    {

        $this->getLogger()->info("§aDiceの読み込みを停止しました");

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch (strtolower($command->getName())) {

            case "dice":

                if ($sender instanceof Player) {
                    $player = $sender->getPlayer();
                    $user = $player->getName();
                    $a = array("1", "2", "3", "4", "5", "6",);//0から9までの数字を格納

                    $acount = count($a);
                    $arandom = rand(0, $acount - 1);//千の位のrandom

                    $sender->sendTip("§eDice §a結果§f : §l§b" . $a[$arandom] . "§r");
                    $this->getServer()->broadcastMessage("§e[Dice]§c " . $user . " が" . $a[$arandom] . "を引きました！");

                } else {
                    $this->getLogger()->info("§e[Dice] §cコンソールからの実行は不可能です。");
                }
        }
     return false;
    }
}