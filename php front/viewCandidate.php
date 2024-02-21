<?php
  include_once ("inc/classes/session.php");
  include ("inc/classes/View.php");

  $userSession = new Session();
  if ($userSession->getSession('login') != true) {
    header('Location: login.php');
  }
  $userSession->destroy();

  $view = new View();
  $viewCandidates = $view->viewCandidate();
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View all Candidates</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  </head>
  <body>

    <?php include ('nav.php'); ?>
<div class="container" style="width: 1320px;">
    <div id="signupbox" style=" margin-top:10px" class="mainbox col-md-12  col-sm-8 ">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">View All Candidates</div>

            </div>
            <div class="panel-body" >
              <table class="table table-bordered" style="width: 100%; table-layout: auto;">
                <thead>
                  <tr>
                    <th style="width: 10%;">Cand Name</th>
                    <th style="width: 15%;">Candidate Email</th>
                    <th style="width: 5%;">Contact</th>
                    <th style="width: 15%;">Candidate Qualification</th>
                    <th style="width: 2%;">Age</th>
                    <th style="width: 10%;">Job Role</th>
                    <th style="width: 23%;">Candidate Address</th>
                    <th style="width: 10%;">Action</th>
                    <th style="width: 10%;">Resume</th>

                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($viewCandidates as $viewCandidate): ?>
                  <tr>
                    <td style="vertical-align: middle;"><?php echo $viewCandidate['cand_name']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $viewCandidate['cand_email']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $viewCandidate['cand_phone']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $viewCandidate['cand_qualification']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $viewCandidate['cand_age']; ?></td>
                    <td style="vertical-align: middle;"><?php echo $viewCandidate['cand_role']; ?></td>

                    <td style="vertical-align: middle;"><?php echo $viewCandidate['cand_address']; ?></td>
                    <td style="vertical-align: middle;">
                      <a href="takeExam.php?id=<?php echo $viewCandidate['cand_id']; ?>" style="width: 100%;" class="btn btn-primary">Add Response</a>
                      <a href="viewReport.php?id=<?php echo $viewCandidate['cand_id']; ?>" style="width: 100%; margin-top: 5px;" class="btn btn-success">Display Report</a>
                      <a href="delete.php?action=deletecand&id=<?php echo $viewCandidate['cand_id']; ?>" style="width: 100%; margin-top: 5px;" class="btn btn-danger">Delete</a>
                    </td>
                    <td style="vertical-align: middle;">
                      <a href="user/uploads/<?php echo $viewCandidate['pdf_file']; ?>" download><i class='fas fa-file'>&nbsp;Resume</i></a>
                    </td>

                  </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
            </div>
        </div>
    </div>
</div>
</div>
  </body>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</html>

<p class="text-center top_spac"> <a href="?action=logout">Logout</a> </p>
<?php include ('footer.php'); ?>
