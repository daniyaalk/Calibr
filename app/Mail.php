<?php

  require_once "../vendor/autoload.php";
  use Mailgun\Mailgun;

  class Mail{

    private $verificationKey = ""; //Mailgun email verification key
    private $sendingKey = ""; //Mailgun email sending key
    private $domain = "calibracademy.com";

    public function verifyEmail($address){
      $mgClient = new Mailgun($this->verificationKey);
      $request = $mgClient->get("address/validate", array("address" => $address));

      return $request->http_response_body->is_valid;
    }

    public function sendMail($to, $from, $subject, $message){
      $mgClient = new Mailgun($this->sendingKey);
      $request = $mgClient->sendMessage($this->domain, array(
        "from" => $from,
        "to" => $to,
        "subject" => $subject,
        "text" => $message
      ));

      return $request;
    }

  }


?>
