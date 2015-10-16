<?php

use App\Game\Cards\Heroes\HeroClass;
use App\Models\HearthCloneTest;

class DeckTest extends HearthCloneTest
{
    public function test_draw_card_removes_one_card_from_deck() {
        $deck_card_count = $this->game->getPlayer1()->getDeck()->getRemainingCount();
        $this->game->getPlayer1()->drawCard();
        $this->assertEquals(($deck_card_count - 1), $this->game->getPlayer1()->getDeck()->getRemainingCount());
    }

    public function test_deck_list_is_loaded_on_initialization() {
        $hunter_deck_json = json_decode(file_get_contents(base_path() . "/resources/deck_lists/basic_only_hunter.json"));
        $priest_deck_json = json_decode(file_get_contents(base_path() . "/resources/deck_lists/basic_only_priest.json"));
        $player1_deck = app('Deck', [app(HeroClass::$HUNTER, [$this->game->getPlayer1()]), array_get($hunter_deck_json, [])]);
        $player2_deck = app('Deck', [app(HeroClass::$PRIEST, [$this->game->getPlayer2()]), array_get($priest_deck_json, [])]);

        $this->game->init($player1_deck, $player2_deck);
        $this->assertEquals(30, $this->game->getPlayer1()->getDeck()->getRemainingCount());
    }
}