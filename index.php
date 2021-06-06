<?php

spl_autoload_register();

use classes\GameController;

$gameController = new GameController();
$gameController->initiateBattle();