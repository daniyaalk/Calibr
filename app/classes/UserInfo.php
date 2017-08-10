<?php


  class UserInfo {

    private $username;
    private $fields;

    private $db;
    public $userId;

    public function __construct($username, DB $db){
      $this->username = $username;
      $this->db = $db;
      $this->userId = $this->db->query("SELECT id FROM users WHERE username='{$this->username}'")->fetch_row()[0];
    }

    public function checkProfileExists(){
        $query = $this->db->query("SELECT id FROM profiles WHERE userid={$this->userId}");

        if($query->num_rows == 0){
          return false;
        }else{
          return true;
        }
    }
    public function getProfile($fields){
      $this->fields = explode('|', $fields);
      $query = $this->db->query("SELECT ".implode($this->fields, ", ")." FROM profiles WHERE userid={$this->userId}");

      if($query->num_rows==0){
        return false;
      }else{
        return $query->fetch_row();
      }
    }
  }

?>
