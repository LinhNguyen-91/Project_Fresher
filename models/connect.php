<?php

class Connect

{
    public $username;
    public $password;
    public $host;
    public $dbname;

    public function __construct($host = 'localhost', $username = 'nhatlinh', $password = 'Nhatlinh91', $dbname = 'order_rice')
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
    public function connect(){
        return mysqli_connect($this->host,$this->username,$this->password,$this->dbname);

    }
}