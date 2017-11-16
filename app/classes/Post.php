<?php

  class Post{

    private $post_data;

    public function __construct(DB $DB, $post_id){
      $this->post_data = $DB->query("
        SELECT
          p.id AS p_id, p.title AS p_title, p.text AS p_text,
          t.id AS t_id, t.name AS t_name,
          c.id AS c_id, c.name AS c_name,
          s.id AS s_id, s.name AS s_name, s.grade AS s_grade,
          curriculums.id as curriculum_id, curriculums.name AS curriculum_name,
          u.username AS u_uname

        FROM
          posts AS p, topics AS t,
          chapters AS c,
          subjects AS s,
          curriculums,
          users as u

        WHERE
          p.id={$post_id}

        AND
          t.id=p.topic
          AND c.id=t.chapter
          AND s.id=c.subject
          AND curriculums.id=s.curriculum
          AND u.id=p.userid
      ");
    }

    public function getPostData(){
      return $this->post_data->fetch_row();
    }

  }

?>
