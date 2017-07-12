<?php

  require_once "header.php";
  require_once "app/DB.php";
  require_once "app/userInfo.php";

  if(!isset($_SESSION['username'])){
    ?>
    <div class="container container-10-margin">
      <div class="alert alert-danger" role="alert">You must be logged in to view this page! <a href="#" class="alert-link" data-toggle="modal" data-target="#loginModal">Click here to log in.</a></div>
    </div>
    <?php
  }else{
    $DB = new DB();
    $UserInfo = new UserInfo($_SESSION['username'], $DB);

    $userId = $UserInfo->userId;

    //Check if profile exists, email is verified, and is signed up as a contributor
    if($UserInfo->checkProfileExists()){

      if($UserInfo->getProfile("email_verified")[0] == 2){
        ?>
        <div>

          <!-- Nav tabs -->
          <div class="container container-10-margin">
            <ul class="nav nav-pills nav-justified" role="tablist">
              <li role="presentation"><a href="#my-contributions" aria-controls="my-contributions" role="tab" data-toggle="tab">My Contributions</a></li>
              <li role="presentation" class="active"><a href="#new-contribution" aria-controls="new-contribution" role="tab" data-toggle="tab">New Contribution</a></li>
              <li role="presentation"><a href="#addition" aria-controls="addition" role="tab" data-toggle="tab">Suggest Addition</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade" id="my-contributions">

              </div>
              <div role="tabpanel" class="tab-pane fade in active" id="new-contribution">.
                <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=8a09i3xybfqx77x70s7ap7bi4n1a2330gqidx5dwk21heikz"></script>
                <script type="text/javascript">
                tinymce.init({
                  selector: 'textarea',
                  height: 500,
                  menubar: false,
                  plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc help'
                  ],
                  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample help',
                  image_advtab: true,
                  templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                  ],
                  content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                  ]
                });
                </script>
                <form class="" action="preview.php" method="post">
                  <p>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                  </p>
                  <p>
                    <textarea name="text"></textarea>
                  </p>
                  <p>
                    <div class="form-group">
                      <div class="container-fluid">
                        <div class="row">
                          <div class="col-md-6">
                            <input type="text" name="title" class="form-control" placeholder="Previous Entry(Optional)">
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="title" class="form-control" placeholder="Next Entry(Optional)">
                          </div>
                        </div>
                      </div>
                    </div>
                  </p>
                  <p>
                    <input type="submit" name="submit" value="Preview & Submit" class="btn btn-primary btn-lg btn-block">
                  </p>
                </form>
              </div>
              <div role="tabpanel" class="tab-pane fade" id="addition">...</div>
            </div>
          </div>

        </div>
        <?php
      }else{
        ?>
        <div class="container container-10-margin">
          <div class="alert alert-danger" role="alert">Looks like you haven't verified your email yet! <a href="#" class="alert-link">Click here to get started.</a></div>
        </div>
        <?php
      }

    }else{
      ?>

      <div class="container container-10-margin">
        <div class="alert alert-danger" role="alert">Looks like you haven't setup your profile yet! <a href="#" class="alert-link">Click here to get started.</a></div>
      </div>

      <?php
    }
  }



?>
