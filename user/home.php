<?php
  include_once ("inc/classes/session.php");
  include ("inc/classes/Create.php");

  $userSession = new Session();
  if ($userSession->getSession('clientlogin') != true) {
    header('Location: login.php');
  }
  $userSession->destroy();
  $create = new Create();
  $addCandidate = $create->createCandidate($_POST);
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add a Candidate</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  
    <title>Interview Application</title>
    <style>
      /* Set background color for the entire page */
      body {
        background-color: #f2f2f2;
      }
      /* Center and style the heading */
      h1 {
        text-align: center;
        font-size: 4em;
        color: #006699;
        margin-top: 150px;
      }
      h2 {
        text-align: center;
        font-size: 3em;
        color: white;
        margin-top: 50px;
      }
      body{
        background-color: black;
      }
      /* Style the form container */
      /* .form-container {
        width: 50%;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-top: 50px;
      } */
      /* Style the form input fields */
      /* input[type=text], input[type=email] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: 2px solid #ccc;
border-radius: 4px;
font-size: 16px;
} */
/* Style the submit button */
/* input[type=submit] {
width: 100%;
background-color: #006699;
color: white;
padding: 14px 20px;
margin: 8px 0;
border: none;
border-radius: 4px;
cursor: pointer;
font-size: 16px;
} */
/* Style the file input */
/* input[type=file] {
padding: 12px 20px;
margin: 8px 0;
border: 2px solid #ccc;
border-radius: 4px;
font-size: 16px;
} */
/* Add hover effect to the submit button */
/* input[type=submit]:hover {
background-color: #003366;
} */
</style>

  </head>
  <body>
      <?php include ('nav.php') ?>
    <h1>Welcome to The Interview Process </h1>
    <h2>Please Navigate and Apply Your Seat. We Will Update You About The Further Process</h1>
</div>
</body>
<p style="margin-top:100px" class="text-center top_spac"><a href="?action=logout">Logout</a> </p>
</html>
