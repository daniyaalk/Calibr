<?php

  require_once "header.php";

  require_once "app/classes/DB.php";
  $DB = new DB();

  if(isset($_GET['id'])) $topic_id = $_GET['id'];
  else die();

  $get_meta_info = $DB->query("
    SELECT
      t.name AS t_name,
      c.name as c_name, c.subject AS c_subject,
      s.id AS s_id, s.name AS s_name, s.grade AS s_grade,
      curriculums.id AS curriculum_id, curriculums.name as c_name

    FROM
      topics AS t,
      chapters AS c,
      subjects AS s,
      curriculums

    WHERE
      t.id={$topic_id}
      AND c.id=t.chapter
      AND s.id=c.subject
      AND curriculums.id=s.curriculum
  ");
  $meta_info = $get_meta_info->fetch_row();

?>
<div class="container">
  <ol class="breadcrumb">
    <li>India</li>
    <li><a href="#"><?php echo $meta_info[7]; ?></a></li>
    <li><a href="<?php echo "grade.php?curriculum=".$meta_info[6]."&grade=".$meta_info[5];?>">Grade <?php echo $meta_info[5]; ?></a></li>
    <li><a href="subject.php?id=<?php echo $meta_info[3];?>"><?php echo $meta_info[4]; ?></a></li>
    <li><a href="#"><?php echo $meta_info[1]; ?></a></li>
    <li><a href="#"><?php echo $meta_info[0]; ?></a></li>
  </ol>
</div>
<div class="container">
  <div class="list-group">
    <?php

      $get_posts = $DB->query("SELECT id, title, link FROM posts WHERE topic={$topic_id}");

      while($post = $get_posts->fetch_assoc()){
        echo '<a href="post.php?p='.$post["link"].'" class="list-group-item">'.$post["title"].'</a>';
      }

    ?>
  </div>
</div>
