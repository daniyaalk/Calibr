<?php
  session_start();
  header("Content-type: text/json");

  require_once "DB.php";
  $DB = new DB();

  require_once "userInfo.php";
  $UserInfo = new UserInfo($_SESSION['username'], $DB);

  $DB->query("INSERT INTO posts VALUES(NULL, '{$_POST['title']}', '{$_POST['text']}', '', '', {$UserInfo->userId}, {$_POST['topic']}, 2017, 0, '".md5($_POST['text'])."')");

  die('{"success": true, "link": "'.md5($_POST['text']).'"}');

?>
