<?php
  include_once ("inc/classes/session.php");
  include ("inc/classes/View.php");
  include ("inc/classes/Create.php");

  $userSession = new Session();
  if ($userSession->getSession('login') != true) {
    header('Location: login.php');
  }
  $userSession->destroy();

  $view = new View();
  $create = new Create();
  $viewQuestions = $view->viewEditQuestions();
  $create->editQuestion($_POST);

?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View all Questions</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>

<div class="container">
<?php include ('nav.php'); ?>
    <div id="signupbox" style=" margin-top:10px" class="mainbox col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">View All Questions</div>

            </div>
            <div class="panel-body" >
              <form class="" action="" method="post">
              <table class="table table-bordered" style="width: 100%; table-layout: auto;">
                <thead>
                  <tr>
                    <th style="width: 10%;">SL</th>
                    <th style="width: 80%;">Question</th>
                    <th style="width: 10%;">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 0; foreach ($viewQuestions as $viewQuestion): ?>
                  <tr>
                    <td><?php $i += 1; echo $i; ?></td>
                    <td><input style="width: 100%;" type="text" name="question" value="<?php echo $viewQuestion['question']; ?>"></td>
                    <td><input value="Submit" name="editQuestion" style="width: 100px;" type="submit" class="btn btn-primary"></td>
                  </tr>
                  <?php endforeach; ?>


                </tbody>
              </table>
              </form>
            </div>
        </div>
    </div>
</div>
</div>
  </body>
</html>

<p class="text-center top_spac"> <a href="?action=logout">Logout</a> </p>
<?php include ('footer.php'); ?>
