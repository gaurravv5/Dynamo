<?php
namespace classes;

abstract class VitalStats
{
    public $health;
    public $strength;
    public $defence;
    public $speed;
    public $luck;

    protected function getRandomValues($min, $max)
    {
        return rand($min, $max);
    }

    protected function getSkillChance($skillPercentValue)
    {
        if ($skillPercentValue < 100 && $skillPercentValue > 0) {
            $skillValueAttained = $this->getRandomValues(1, (100 / $skillPercentValue));
        } else if ($skillPercentValue != 0) {
            $skillValueAttained = 1;
        }

        return $skillValueAttained;
    }

    public function calculateDamage($strength)
    {
        $damageDone = ($strength - $this->defence);
        $this->health -= $damageDone;
        return $damageDone;
    }
}
