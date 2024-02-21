<?php
  include_once ("inc/classes/session.php");
  include ("inc/classes/View.php");
  include ("inc/classes/Create.php");

  $userSession = new Session();
  if ($userSession->getSession('login') != true) {
    header('Location: login.php');
  }
  $userSession->destroy();

  if (!isset($_GET['id'])) {
    header("Location: viewCandidate.php");
  }

  $view = new View();
  $create = new Create();
  $viewReports = $view->viewReport();
  $viewCandidates = $view->viewCandidate();
  $viewComments = $view->viewReportComment();




?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Report</title>
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
                <div class="panel-title">View Report</div>

            </div>

            <div class="panel-body" >
              <h2>Candidate Details Report</h2>

              <table class="table table-bordered" style="width: 100%; table-layout: auto;">
                <thead>
                  <tr>
                    <th style="width: 25%;">Candidate Name</th>
                    <th style="width: 20%;">Candidate Email: </th>
                    <th style="width: 20%;">Candidate Contact: </th>
                    <th style="width: 35%;">Candidate Qualification</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($viewCandidates as $viewCandidate): ?>
                  <?php if (isset($_GET['id']) && $_GET['id'] == $viewCandidate['cand_id']): ?>
                  <tr>
                    <td><?php echo $viewCandidate['cand_name']; ?></td>
                    <td><?php echo $viewCandidate['cand_email']; ?></td>
                    <td><?php echo $viewCandidate['cand_phone']; ?></td>
                    <td><?php echo $viewCandidate['cand_qualification']; ?></td>
                  </tr>

                  <?php endif; ?>

                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
            <div class="panel-body" >

                <table class="table table-bordered" style="width: 100%; table-layout: auto;">
                  <thead>
                    <tr>
                      <th style="width: 10%;">S.No</th>
                      <th style="width: 80%;">Question</th>
                      <th style="width: 10%;">Review</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 0; foreach ($viewReports as $viewReport): ?>
                    <tr>
                      <td><?php $i += 1; echo $i; ?></td>
                      <td><?php echo $viewReport['question']; ?></td>
                      <td><input value="<?php echo $viewReport['result']; ?>" style="font-weight: bold;" disabled="" type="text" name="result<?php echo $i; ?>"></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

                <div class="">
                  <h4><b>Remark:</b></h4>
                  <?php foreach ($viewComments as $viewComment): ?>
                  <p><?php echo $viewComment['comment']; ?></p>
                  <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
  </body>
</html>

<p class="text-center top_spac"><a href="?action=logout">Logout</a> </p>
<?php include ('footer.php'); ?>
