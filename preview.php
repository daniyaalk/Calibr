<?php


  if(!isset($_POST['topic-selector']) || !isset($_POST['title']) || !isset($_POST['text'])){
    die();
  }

  require_once "header.php";

  $post_title = $_POST['title'];
  $post_text = $_POST['text'];
  $post_topic_id = $_POST['topic-selector'];

  require_once "app/classes/DB.php";
  $DB = new DB();

  $get_meta_info = $DB->query("
    SELECT c.name AS c_name, t.name AS t_name
    FROM topics AS t, chapters AS c
    WHERE t.id={$post_topic_id}
    AND c.id=(SELECT chapter FROM topics WHERE id={$post_topic_id})
  ");
  $meta_info = $get_meta_info->fetch_assoc();
?>
<script type="text/javascript" src="scripts/submitpost.js"></script>
<div class="container">
  <div class="page-header">
    <h1><?php echo "<span id='post-title'>".$_POST['title']."</span> <small>{$meta_info['t_name']} | {$meta_info['c_name']}</small>"; ?></h1>
  </div>
  <div style="display: none;" id="topic-id"><?php echo $post_topic_id ?></div>
  <div class="row">
    <div class="col-md-8 col-xs-12">
      <div id="post-text">
        <?php echo $post_text; ?>
      </div>
      <button type="button" name="button" id="post-submit" onclick="javascript: submitPost();" class="btn btn-lg btn-block">Post</button>
    </div>
    <!--This feature will be added later.
    <div class="col-md-4">
      <div class="btn-group">
        <?php
          if(isset($_POST['next'])){
            echo "<button class='btn'>Next</btn>";
          }
        ?>
      </div>
    </div>
    -->
  </div>
</div>
