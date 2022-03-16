<?php

class Database extends PDO
{

    private $HOST = "localhost";
    private $USER = "root";
    private $PASSWORD = "";
    private $DB_NAME = "autho";

    public function __construct($dsn = null, $user = null, $pass = null, $opts = null)
    {
        parent::__construct(
            "mysql:host={$this->HOST};dbname={$this->DB_NAME}",
            $this->USER,
            $this->PASSWORD,
            $opts
        );
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
}



