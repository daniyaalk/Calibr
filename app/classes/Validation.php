<?php

  require_once "../vendor/alexgarrett/violin/src/Violin.php";
  use Violin\Violin;

  class Validation{

    public function __construct(){
      $this->v = new Violin();
    }

    public function verifyEmail($email){
      $this->v->validate(array('email' => [$email, 'required|email']));
      return $this->v->passes();
    }
  }


?>
