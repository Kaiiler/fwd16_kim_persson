<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bank
 *
 * @author Kim
 */
class bank {
    //Klassens variabler
    public $accountFname;
    public $accountLname;
    public $accountName;
    protected $accountBalance;
    public $collector;
    
    // constructor som sköter instansiering med hjälp av data som hämtas ifrån DB
    public function __construct() {
        // Konvertera Float värdet till en Interger
        $this->accountBalance = round($this->accountBalance);
        // collector samlar ihop all nödvändig data ifrån DB och sätter in i en gemensam variabel
        $this->collector = "{$this->accountFname} {$this->accountLname} has: {$this->accountName} with {$this->accountBalance} balance";
    }
}
