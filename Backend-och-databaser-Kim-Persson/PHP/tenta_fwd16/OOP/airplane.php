<?php

abstract class airplane {
    protected $designation;
    protected $speed;
    protected $range;
    protected $payload;
    const refuelstring = "Refueling Charter";
    static $warningstring = "WARNING!!! Boogie 9 oclock, Angels 5";
    
    public function __construct($des,$spd, $rng, $pay) {
        $this->designation = $des;
        $this->speed = $spd;
        $this->range = $rng;
        $this->payload = $pay; 
    }
}
