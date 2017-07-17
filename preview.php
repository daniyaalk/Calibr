<?php


  if(!isset($_POST['topic-selector']) || !isset($_POST['title']) || !isset($_POST['text'])){
    die();
  }

  require_once "header.php";

  $post_title = $_POST['title'];
  $post_text = $_POST['text'];
  $post_topic_id = $_POST['topic-selector'];

  require_once "app/DB.php";
  $DB = new DB();

  $get_meta_info = $DB->query("
    SELECT c.name AS c_name, t.name AS t_name
    FROM topics AS t, chapters AS c
    WHERE t.id={$post_topic_id}
    AND c.id=(SELECT chapter FROM topics WHERE id={$post_topic_id})
  ");
  $meta_info = $get_meta_info->fetch_assoc();
?>
<div class="container">
  <div class="page-header">
    <h1><?php echo $_POST['title']." <small>{$meta_info['t_name']} | {$meta_info['c_name']}</small>"; ?></h1>
  </div>
  <div class="row">
    <div class="col-md-8">
      <?php echo $post_text; ?>
    </div>
    <div class="col-md-4">
      
    </div>
  </div>
</div>
