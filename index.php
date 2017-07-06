<?php

  $_title = "Home";
  require_once "header.php";
  require_once "app/DB.php";

  $db = new DB();

  class featuredSubjects{

    private $featuredSubQuery;
    private $db;

    public function __construct($grade){
      $this->db = new DB();
      $this->featuredSubQuery = $this->db->query("SELECT * FROM subjects WHERE grade={$grade} AND featured=1");
    }
    public function featuredSubjects_count(){
      return $this->featuredSubQuery->num_rows;
    }
    public function echoAllSubjects(){
      while($subject = $this->featuredSubQuery->fetch_assoc()){
        echo "<a href='subject.php?id=".$subject['id']."'><div class='grade-subjects-entry'>".$subject['name']."</div></a>";
      }
    }
  }

 ?>
 <link rel="stylesheet" href="css/home.css" media="screen" title="no title" charset="utf-8">
 <!-- TODO: Work on this this later
 <div class="catch">
   <div class="content">
     <div class="catch-text">
       <div class="catch-header">
         Hi.
       </div>
       <div class="catch-sub">
       </div>
     </div>
   </div>
 </div>
 -->
 <div class="subject-listings">
   <div class="content">
     <div class="row">
       <div class="col-xs-12 col-lg-6">
         <div class="grade-subjects grade-subjects-left">
          <div class="grade-subjects-header">
            Class XI Featured Subjects
          </div>
          <div class="grade-subjects-content">
            <?php
              $featured11 = new featuredSubjects(11);
              if($featured11->featuredSubjects_count() == 0){
                echo "<a href='#'><div class='grade-subjects-entry no-featured'>No featured Subjects</div></a>";
              }else{
                $featured11->echoAllSubjects();
              }
            ?>
          </div>
         </div>
       </div>
       <div class="col-xs-12 col-lg-6">
         <div class="grade-subjects grade-subjects-right">
          <div class="grade-subjects-header">
            Class XII Featured Subjects
          </div>
          <div class="grade-subjects-content">
            <?php
              $featured12 = new featuredSubjects(12);
              if($featured12->featuredSubjects_count() == 0){
                echo "<a href='#'><div class='grade-subjects-entry no-featured'>No featured Subjects</div></a>";
              }else{
                $featured12->echoAllSubjects();
              }
            ?>
            </div>
          </div>
         </div>
       </div>
     </div>

   </div>
 </div>
<?php

  require_once "footer.php";

 ?>
