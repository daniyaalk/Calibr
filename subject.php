<?php

  if(!isset($_GET['id'])) header("Location: index.php");

  require_once "app/DB.php";

  $db = new DB();
  $query = $db->query("SELECT s.id, s.name, s.grade, c.name, c.country, c.locale, c.id FROM subjects AS s, curriculums AS c WHERE s.id={$_GET['id']} AND c.id=s.curriculum");

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
    <li><?php echo $subjectInformation[3]; ?></li>
    <li><a href="<?php echo 'grade.php?curriculum='.$subjectInformation[6].'&grade='.$subjectInformation[2]; ?>">Grade <?php echo $subjectInformation[2]; ?></a></li>
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

      $chapterId = $chapter['id'];
      $chapterName = $chapter['name'];

      $getTopics = $db->query("SELECT * FROM topics WHERE chapter={$chapterId} ORDER BY number ASC");

      echo '

      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="heading'.$chapterId.'">
          <h4 class="panel-title">
            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$chapterId.'" aria-expanded="false" aria-controls="collapse'.$chapterId.'">
              '.$chapterId.'. '.$chapterName.'
            </a>
          </h4>
        </div>
        <div id="collapse'.$chapterId.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$chapterId.'">
          <div class="panel-body">
      ';

      if($getTopics->num_rows == 0){
        echo "No topics added for this chapter, yet";
      }else{
        while($topic = $getTopics->fetch_assoc()){
          echo "<a href='topic.php?id={$topic['id']}'>".$topic['number'].". ".$topic['name']."</a><br />";
        }
      }

      echo '
          </div>
        </div>
      </div>

      ';
    }

    ?>
  </div>
  <div class="panel panel-warning">
    <div class="panel-heading">
      Calibr is a crowd sorced community, become a contributor to upload your own study resources!
    </div>
    <div class="panel-footer">
      <a href="contribute.php">
        <button type="button" class="btn btn-primary btn-lg btn-block">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          Visit the Contribute Page<!-- Contrubotor features will be added later -->
        </button>
      </a>
    </div>
  </div>
</div>
