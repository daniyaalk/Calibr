<?php

  require_once "header.php";
  if(!isset($_GET['p'])){
    die();
  }

  require_once "app/DB.php";
  $DB = new DB();

  $link = $_GET['p'];
  $get_data = $DB->query("
    SELECT
      p.id AS p_id, p.title AS p_title, p.text AS p_text,
      t.id AS t_id, t.name AS t_name,
      c.id AS c_id, c.name AS c_name,
      s.id AS s_id, s.name AS s_name, s.grade AS s_grade,
      curriculums.id as curriculum_id, curriculums.name AS curriculum_name

    FROM
      posts AS p, topics AS t,
      chapters AS c,
      subjects AS s,
      curriculums

    WHERE
      link='{$link}'

    AND
      t.id=p.topic
      AND c.id=t.chapter
      AND s.id=c.subject
      AND curriculums.id=s.curriculum
  ");
  $post_data = $get_data->fetch_row();
?>
<div class="container">
  <ol class="breadcrumb">
    <li>India</li>
    <li><a href="#"><?php echo $post_data[11]; ?></a></li><!--Curriculum-->
    <li><a href="<?php echo "grade.php?curriculum=".$post_data[10]."&grade=".$post_data[9];?>">Grade <?php echo $post_data[9]; ?></a></li><!--Grade-->
    <li><a href="subject.php?id=<?php echo $post_data[7];?>"><?php echo $post_data[8]; ?></a></li><!--Subject-->
    <li><a href="subject.php?id=<?php echo $post_data[7];?>"><?php echo $post_data[6]; ?></a></li><!--Chapter-->
    <li><a href="topic.php?id=<?php echo $post_data[3]; ?>"><?php echo $post_data[4]; ?></a></li><!--Topic-->
  </ol>
</div>
<div class="page-header">
  <div class="container">
    <h1><?php echo $post_data[1];?></h1>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-xs-12">
      <?php echo $post_data[2]; ?>
    </div>
  </div>
</div>
