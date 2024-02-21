<?php
  include_once ("inc/classes/session.php");
  include ("inc/classes/View.php");

  $userSession = new Session();
  if ($userSession->getSession('clientlogin') != true) {
    header('Location: login.php');
  }
  $userSession->destroy();

  $view = new View();
//   $viewQuestions = $view->viewQuestions();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>About The Project</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <style>
    div.about-header {
      text-align: center;
      font-size: 24px;
    }

    div.about-paragraph {
      text-align: justify;
      padding: 0 12% 0 12%;
    }

    /* nav.navbar.navbar-inverse {
      padding: 0 12% 0 12%;
      text-align: center;
      width: 75% !important;
    }

    div.container-fluid {
      margin: 0 15% 0 15%;
      width: 250%;
    }

    .navbar>.container-fluid .navbar-brand {
      margin-left: -215px
    } */
  </style>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri&family=Rowdies&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <?php include ('nav.php'); ?>
  

  <div class="about-header">

    <h3 style="font-family: Rowdies, 'Hind Siliguri';font-size:36px">About the Project</h3>
  </div>
  <div class="about-paragraph">


    <p style="font-family: 'Hind Siliguri', sans-serif;font-size:26px;margin-top:10%;padding:0 16% 0 16%">A panel interview management system is a software or platform that facilitates the coordination and organization
      of panel interviews, which involve multiple interviewers conducting an interview with a single candidate. The
      system may include features such as candidate tracking and can track the response of each candidate. It can also allow
      interviewers to collaborate and provide feedback on candidates in real-time. This can streamline the
      interview process and make it more efficient and effective.</p>
  </div>
  <p class="text-center top_spac"><a href="?action=logout">Logout</a> </p>
  <?php include ('footer.php'); ?>
</body>

</html>