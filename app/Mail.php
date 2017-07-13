<?php

  require_once "../vendor/autoload.php";
  use Mailgun\Mailgun;

  class Mail{

    private $sendingKey = ""; //Mailgun email sending key
    private $domain = "calibracademy.com";

    public function sendMail($to, $from, $subject, $message, $tags = array()){
      $mgClient = new Mailgun($this->sendingKey);
      $request = $mgClient->sendMessage($this->domain, array(
        "from" => $from,
        "to" => $to,
        "subject" => $subject,
        "html" => $message,
        "o:tag" => $tags
      ));

      return $request;
    }

  }


?>
