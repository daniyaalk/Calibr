<?php

class DB{

  private $DB = "";
  private $host = "";
  private $user = "";
  private $pass = "";

  private $connect;

  public function __construct(){

    $this->connect = new mysqli($this->host, $this->user, $this->pass, $this->DB);

  }

  public function query($sql){
    return $this->connect->query($sql);
  }


}
