<?php
namespace classes;

use classes\VitalStats;
use interfaces\FightingAbilitiesInterface;

class Beast extends VitalStats implements FightingAbilitiesInterface
{
	const HEALTH_RANGE = [60, 90];
	const STRENGTH_RANGE = [60, 90];
	const DEFENCE_RANGE = [40, 60];
	const SPEED_RANGE = [40, 60];
	const LUCK_RANGE = ['25%', '40%'];
	const NAME = 'Beast';

	public $role;

	public function __construct() {
		$this->health = $this->getRandomValues(self::HEALTH_RANGE[0], self::HEALTH_RANGE[1]);
		$this->strength = $this->getRandomValues(self::STRENGTH_RANGE[0], self::STRENGTH_RANGE[1]);
		$this->defence = $this->getRandomValues(self::DEFENCE_RANGE[0], self::DEFENCE_RANGE[1]);
		$this->speed = $this->getRandomValues(self::SPEED_RANGE[0], self::SPEED_RANGE[1]);
		$this->luck = $this->getRandomValues((int) rtrim(self::LUCK_RANGE[0], '%'), (int) rtrim(self::LUCK_RANGE[1], '%'));
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
			echo "Beast attacks first because of more ". $reason ." with strength " . $this->strength ." ...\n";
		} else {
			echo "Beast attacks with strength " . $this->strength ." ...\n";
		}

		return true;
	}

	public function defend() {
		echo "\nBeast defends with defence " . $this->defence . "...\n";
		return true;
	}

} 