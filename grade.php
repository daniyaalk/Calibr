<?php

  require_once "header.php";

  require_once "app/classes/DB.php";
  $DB = new DB();

  if(isset($_GET['grade'])) $grade = $_GET['grade'];
  else die();

  if(isset($_GET['curriculum'])) $curriculum = $_GET['curriculum'];
  else die();

  $curriculum_info = $DB->query("SELECT country, name FROM curriculums WHERE id={$curriculum}")->fetch_row();
?>
<div class="container">
  <ol class="breadcrumb">
    <li><?php echo $curriculum_info[1]; ?></li>
    <li><?php echo $curriculum_info[0]; ?></li>
    <li><a href="#">Grade <?php echo $grade; ?></a></li>
  </ol>
</div>
<div class="container">
  <div class="list-group">
    <?php

      $get_subjects = $DB->query("SELECT id, name FROM subjects WHERE curriculum={$curriculum} AND grade={$grade}");

      while($subject = $get_subjects->fetch_assoc()){
        echo '<a href="subject.php?id='.$subject["id"].'" class="list-group-item">'.$subject["name"].'</a>';
      }

    ?>
  </div>
</div>
