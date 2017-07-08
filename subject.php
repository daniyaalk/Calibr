<?php

  if(!isset($_GET['id'])) header("Location: index.php");

  require_once "app/DB.php";

  $db = new DB();
  $query = $db->query("SELECT s.id, s.name, s.grade, c.name, c.country, c.locale FROM subjects AS s, curriculums AS c WHERE s.id={$_GET['id']} AND c.id=s.curriculum");

  /*
  ~~DEBUGGING CODE~~
  echo "<pre>";
  var_dump($query->fetch_row());
  echo "</pre>";
  */

  $subjectInformation = $query->fetch_row();

  $_title =  $subjectInformation[1]." ". $subjectInformation[2] ." | ".$subjectInformation[3].", ".$subjectInformation[4];


  require_once "header.php";
 ?>

<div class="container container-10-margin">
  <ol class="breadcrumb">
    <li><?php echo $subjectInformation[4]; ?></li>
    <li><a href="#"><?php echo $subjectInformation[3]; ?></a></li>
    <li><a href="#">Grade <?php echo $subjectInformation[2]; ?></a></li>
    <li><a href="#"><?php echo $subjectInformation[1]; ?></a></li>
  </ol>
</div>
<div class="container">
  <div class="page-header">
    <h1><?php echo $subjectInformation[1]; ?> <small>Grade <?php echo $subjectInformation[2]; ?></small></h1>
  </div>
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php

    $getChapters = $db->query("SELECT * FROM chapters WHERE subject={$_GET['id']} ORDER BY number ASC");

    while($chapter = $getChapters->fetch_assoc()){
      echo '

      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading'.$chapter['id'].'">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$chapter['id'].'" aria-expanded="false" aria-controls="collapse'.$chapter['id'].'">
              '.$chapter['id'].'. '.$chapter['name'].'
            </a>
          </h4>
        </div>
        <div id="collapse'.$chapter['id'].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$chapter['id'].'">
          <div class="panel-body">
            <!-- TODO: Add listing of study resources-->
          </div>
        </div>
      </div>

      ';
    }

    ?>
  </div>
</div>
