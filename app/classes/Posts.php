<?php

  class Posts{

    private $posts_query;
    public $num_posts;

    public function __construct(DB $DB, array $fields_array = array("*"), array $conditions_array = array()){

      $fields = implode(", ", $fields_array);

      $conditions_array_adapted = array();
      if(!empty($conditions_array)){
        foreach($conditions_array as $key => $value){
          $conditions_array_adapted[] = $key."='".$value."'";
        }
      }else{
        $conditions_array_adapted = array("1");
      }
      $conditions = implode(" AND ", $conditions_array_adapted);

      $this->posts_query = $DB->query("SELECT ".$fields." FROM posts WHERE ".$conditions);
      $this->num_posts = $this->posts_query->num_rows;
    }

    public function getPosts(){
      return $this->posts_query->fetch_all(MYSQLI_ASSOC);
    }

  }

?>
