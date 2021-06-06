<?php
namespace classes;

use classes\Dynamo;
use classes\Beast;

class GameController
{
	protected $player;
	protected $enemy;
	const ROUNDS = 20;

	public function __construct() {
		$this->player = new Dynamo();
		$this->enemy = new Beast();
	}

	protected function checkWhoAttacksFirst()
	{
	    if ($this->player->speed > $this->enemy->speed) {
	        $attacker = $this->player;
	        $reason   = 'speed';
	    } else if ($this->player->speed == $this->enemy->speed) {
	    	while(true) {
		        $playerLuck = $this->player->getLucky();
		        $enemyLuck  = $this->enemy->getLucky();
		        if ($playerLuck) {
		            $attacker = $this->player;
		            break;
		        } else if ($enemyLuck) {
		            $attacker = $this->enemy;
		            break;
		        }
		    }
	        $reason = 'luck';
	    } else {
	        $attacker = $this->enemy;
	        $reason   = 'speed';
	    }

	    return ['attacker' => $attacker, 'reason' => $reason];
	}

	public function initiateBattle() {
		//Decide who attacks first
		$attackerArray     = $this->checkWhoAttacksFirst();
		$attacker          = $attackerArray['attacker'];
		$firstAttackReason = $attackerArray['reason'];
		$defender          = ($attacker instanceof Dynamo) ? $this->enemy : $this->player;

		//Battle Starts
		do {
		    echo "\n\nRound " . ++$turnCount . "\n\n";
		  
		    if ($firstAttackReason != null) {
		        $attacker->attack($firstAttackReason);
		        $firstAttackReason = null;
		    } else {
		        $attacker->attack();
		    }
		    
		    if ($defender instanceof Beast) {
		    	if ($defender->getLucky()) {
			        echo "\nBeast got lucky and received no damage\n";
			    } else {
		    		$defender->defend();
		    		$damageDone = $defender->calculateDamage($attacker->strength);
		    		echo "\nBeast receives a damage of " . $damageDone;
		    	}

		    	// check if RapidStrike attack
		    	if($attacker->getRapidStrike()) {
		    		if ($defender->getLucky()) {
				        echo "\nBeast got lucky and received no damage\n";
				    } else {
			    		$defender->defend();
			    		$damageDone = $defender->calculateDamage($attacker->strength);
			    		echo "\nBeast receives a damage of " . $damageDone;
			    	}
		    	}

		    	$defender = $this->player;
		        $attacker = $this->enemy;
		    } else if ($defender instanceof Dynamo) {
		        if ($defender->getLucky()) {
		            echo "\nDynamo got lucky and received no damage\n";
		        } else if(!$defender->getMagicShield()){ // if no magic shield used
		            $defender->defend();
		            $damageDone = $defender->calculateDamage($attacker->strength);
		            echo "\nDynamo receives a damage of " . $damageDone;
		        }

		        $defender = $this->enemy;
		        $attacker = $this->player;
		    }

		    echo "\n\nAfter Round " . $turnCount . ":\n";
		    echo "Dynamo is at health: " . $this->player->health . "\n";
		    echo "Beast is at health: " . $this->enemy->health . "\n";

		} while (($attacker->health > 0 && $defender->health > 0) && $turnCount < self::ROUNDS);

		if ($this->player->health > 0 && $this->enemy->health <= 0) {
		    echo "\n\nDynamo wins the battle!!\n";
		} else if ($this->enemy->health > 0 && $this->player->health <= 0) {
		    echo "\n\nBeast wins the battle!!\n";
		} else {
		    echo "\n\nThe battle resulted in a Draw!!\n";
		}

		return true;

	}


}