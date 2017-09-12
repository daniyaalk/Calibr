<?php

  require_once "header.php";
  if(!isset($_GET['p'])){
    die();
  }

  require_once "app/classes/DB.php";
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

  if(isset($_SESSION['username']))
    //if session exists, check if user has upvoted post
    $post_upvotes_query = "
    SELECT SUM(type),

    (
    SELECT type FROM upvotes WHERE postid={$post_data['0']} AND userid=(SELECT id FROM users WHERE username='{$_SESSION['username']}')
    )

    FROM upvotes WHERE postid={$post_data['0']}
    ";
  else
    $post_upvotes_query = "SELECT SUM(type) FROM upvotes WHERE postid={$post_data['0']}";
  $post_upvotes = $DB->query($post_upvotes_query)->fetch_row();

  if(!isset($post_upvotes[1]) || $post_upvotes[1] == NULL)
    $user_upvoted = 0;
  else
    $user_upvoted = $post_upvotes[1];

?>
<script type="text/javascript" src="scripts/vote.js"></script>
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
    <div class="col-md-4 col-xs-12">
      <div class="btn-group btn-group-md" role="group" aria-label="...">.
        <div class="btn btn-default <?php echo ($user_upvoted == 1)?"btn-info":""; ?>" id="vote-up" onClick="javascript: vote(1, <?php echo $post_data[0]?>)">
          <i class="glyphicon glyphicon-circle-arrow-up"></i>
        </div>
        <div class="btn btn-default active" id="vote-count">
          <?php echo ($post_upvotes[0] != NULL)?$post_upvotes[0]:0; ?>
        </div>
        <div class="btn btn-default <?php echo ($user_upvoted == -1)?"btn-danger":""; ?>" id="vote-down" onClick="javascript: vote(-1, <?php echo $post_data[0]?>)">
          <i class="glyphicon glyphicon-circle-arrow-down"></i>
        </div>
      </div>
    </div>
  </div>
</div>
