<?php
namespace interfaces;

use interfaces\AttackInterface;
use interfaces\DefendInterface;
use interfaces\LuckInterface;

interface FightingAbilitiesInterface extends AttackInterface, DefendInterface, LuckInterface {
	
}