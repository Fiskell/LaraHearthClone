<?php namespace App\Game\Cards\Heroes;
use App\Game\Cards\Heroes\AbstractHero;
use App\Game\Cards\Minion;
use App\Game\Player;

/**
 * Created by PhpStorm.
 * User: Kegimaro
 * Date: 8/30/15
 * Time: 3:36 PM
 */
class Shaman extends AbstractHero
{
    protected $name = 'Thrall';

    private $totems = [
        'Healing Totem',
        'Searing Totem',
        'Stoneclaw Totem',
        'Wrath of Air Totem'
    ];


    public function __construct(Player $player) {
        parent::__construct($player, $this->name);
        $this->hero_class = HeroClass::$SHAMAN;
        $this->hero_power = HeroPower::$SHAMAN;
    }


    /**
     * Use the heroes ability
     *
     * @param array $targets
     */
    function useAbility(array $targets) {
        $active_player = $this->getOwner();
        /** @var Minion $card */
        $card = app('Minion', [$active_player, $this->getRandomTotemName()]);

        $active_player->play($card);
    }

    /**
     * @return array
     */
    public function getTotems() {
        return $this->totems;
    }

    /**
     * Return the name of one random shaman totem that the ability can summon.
     *
     * @return mixed
     */
    public function getRandomTotemName() {
        return $this->totems[rand(0, 3)];
    }
}