<?php
namespace classes;

use classes\VitalStats;
use interfaces\FightingAbilitiesInterface;
use interfaces\DynamoSpecialSkillsInterface;

class Dynamo extends VitalStats implements FightingAbilitiesInterface, DynamoSpecialSkillsInterface
{
	const HEALTH_RANGE = [70, 100];
	const STRENGTH_RANGE = [70, 80];
	const DEFENCE_RANGE = [45, 55];
	const SPEED_RANGE = [40, 50];
	const LUCK_RANGE = ['10%', '30%'];
	const RAPID_STRIKE_CHANCE = '10%';
	const MAGIC_SHIELD_CHANCE = '20%';
	const NAME = 'Dynamo';

	public $role;

	public $isRapidStrike;
	public $isMagicShield;

	public function __construct() {
		$this->health = $this->getRandomValues(self::HEALTH_RANGE[0], self::HEALTH_RANGE[1]);
		$this->strength = $this->getRandomValues(self::STRENGTH_RANGE[0], self::STRENGTH_RANGE[1]);
		$this->defence = $this->getRandomValues(self::DEFENCE_RANGE[0], self::DEFENCE_RANGE[1]);
		$this->speed = $this->getRandomValues(self::SPEED_RANGE[0], self::SPEED_RANGE[1]);
		$this->luck = $this->getRandomValues((int) rtrim(self::LUCK_RANGE[0], '%'), (int) rtrim(self::LUCK_RANGE[1], '%'));
	}

	public function getRapidStrike() {
		$this->isRapidStrike = $this->getSkillChance(rtrim(self::RAPID_STRIKE_CHANCE, '%'));
		if ($this->isRapidStrike == 1) {
			echo "\nDynamo uses Rapid Strike and attacks again..\n";
			$this->attack();
			return true;
		}

		return false;
	}

	public function getMagicShield() {
		$this->isMagicShield = $this->getSkillChance(rtrim(self::MAGIC_SHIELD_CHANCE, '%'));
		if ($this->isMagicShield == 1) {
			echo "\nDynamo uses Magic Shield and takes no damage..\n";
			return true;
		}

		return false;
	}

	public function getLucky() {
		$this->isLucky = $this->getSkillChance($this->luck);
		if ($this->isLucky == 1) {
			return true;
		}

		return false;
	}

	public function attack($reason = null) {
		if ($reason != null) {
			echo "Dynamo attacks first because of more ". $reason ." with strength " . $this->strength ." ...\n";
		} else {
			echo "Dynamo attacks with strength " . $this->strength ." ...\n";
		}

		return true;
	}

	public function defend() {
		echo "\nDynamo defends with defence " . $this->defence . "...\n";
		return true;
	}
} 