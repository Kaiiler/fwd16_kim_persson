<?php

require_once 'airplane.php';
require_once 'interface.php';
require_once 'trait.php';
class interceptor extends airplane implements iTexaco {
    use tTexaco;
    protected $missiles;
    
    public function __construct($des, $spd, $rng, $pay, $msl) {
        $this->missiles = $msl;
        parent::__construct($des, $spd, $rng, $pay);
    }
}

class bomber extends airplane implements iTexaco {
    use tTexaco;
    protected $bombs;
    
    public function __construct($des, $spd, $rng, $pay, $bmb) {
        $this->bombs = $bmb;
        parent::__construct($des, $spd, $rng, $pay);
    }
}
