<?php namespace App\Game\Card\Heroes;
use App\Game\Cards\Heroes\AbstractHero;
use App\Game\Cards\Minion;
use App\Game\Player;

/**
 * Created by PhpStorm.
 * User: Kegimaro
 * Date: 8/30/15
 * Time: 3:36 PM
 */
class Warrior extends AbstractHero
{
    private $armor_gained = 2;

    protected $name = "Garrosh Hellscream";

    public function __construct(Player $player) {
        parent::__construct($player);
        $this->hero_class = HeroClass::$WARRIOR;
        $this->hero_power = HeroPower::$WARRIOR;
    }

    /**
     * Use the heroes ability
     *
     * @param Player $active_player
     * @param Player $defending_player
     * @param Minion[] $targets
     */
    function useAbility(Player $active_player, Player $defending_player, array $targets) {
        $active_player->getHero()->gainArmor($this->armor_gained);
    }
}