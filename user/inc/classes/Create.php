<?php

  include_once ("DB.php");
  include_once ("session.php");
  class Create {
    private $db;
    private $msgSession;
    function __construct(){
      $this->db = new DB();
      $this->msgSession = new Session();
    }

    // public function createCandidate($data){
    //   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCand'])) {
    //     $candName              = $data['candName'];
    //     $candEmail             = $data['candEmail'];
    //     $candQualification     = $data['candQuali'];
    //     $candAge               = $data['candAge'];
    //     $candNumber            = $data['candNumber'];
    //     $candAddress           = $data['candAddress'];

    //     $pdfname               = $_FILES['pdfMain']['name'];
    //     $pdf                   = $_FILES['pdf']['tmp_name'];
    //     $destination           = 'uploads/' .$pdfname;


    //     if (empty($candName) or empty($candEmail) or empty($candQualification) or empty($candAge) or empty($candNumber) or empty($candAddress) or empty($pdf)){
    //       $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Fields Must Not be Empty</div>';
    //       return $msg;
    //       exit();
    //     }

    //     if (filter_var($candEmail, FILTER_VALIDATE_EMAIL) === false) {
    //       $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Invalid Email</div>';
    //       return $msg;
    //       exit();
    //     }
        
    //     $sql = "insert into candidates(cand_name, cand_email, cand_phone, cand_age, cand_address, cand_qualification, pdf_file) values(?, ?, ?, ?, ?, ?, ?)";
    //     $arr = array($candName, $candEmail, $candNumber, $candAge, $candAddress, $candQualification, $pdfname);
    //     $results = $this->db->simplequery($sql, $arr);
  
    //     if ($results) {
    //       $msg = '<div class="alert alert-success"><b>Registration Success!</b> You have successfully added a new candidate.</div>';
    //       return $msg;
    //     } else {
    //       $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Sorry, Some Unexpected Error Ocur, Please try again</div>';
    //       return $msg;
    //     }

    //   }
    // }







    public function createCandidate($data){
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addCand'])) {
          // Validate and sanitize user input
          $candName = filter_var($data['candName'], FILTER_SANITIZE_STRING);
          $candEmail = filter_var($data['candEmail'], FILTER_SANITIZE_EMAIL);
          $candQualification = filter_var($data['candQuali'], FILTER_SANITIZE_STRING);
          $candAge = filter_var($data['candAge'], FILTER_SANITIZE_NUMBER_INT);
          $jobrole = filter_var($data['JBrole'], FILTER_SANITIZE_STRING);
          $candNumber = filter_var($data['candNumber'], FILTER_SANITIZE_NUMBER_INT);
          $candAddress = filter_var($data['candAddress'], FILTER_SANITIZE_STRING);
  
          // Validate the email address
          if (filter_var($candEmail, FILTER_VALIDATE_EMAIL) === false) {
              $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Invalid Email</div>';
              return $msg;
              exit();
          }
  
          // Handle file upload
          $pdfname = $_FILES['pdfMain']['name'];
          // $pdf = $_FILES['pdf']['tmp_name'];
          $pdf = $_FILES['pdfMain']['tmp_name'];

          $destination = 'uploads/' .$pdfname;
          
          // Check if file is empty
          if(empty($pdf)){
            $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> File Field Must Not be Empty</div>';
            return $msg;
            exit();
          }
          // Check if file is of pdf type
          if(pathinfo($pdfname, PATHINFO_EXTENSION) != 'pdf'){
            $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Only PDF files are allowed</div>';
            return $msg;
            exit();
          }
          // Check if file size is less than 4mb
          if(filesize($pdf) > 4000000){
            $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Maximum file size allowed is 4mb</div>';
            return $msg;
            exit();
          }
          // Check if uploads folder is writable
          if(!is_writable("uploads")){
            $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> The uploads folder is not writable</div>';
            return $msg;
            exit();
          }
          // Move the file to the uploads folder
          move_uploaded_file($pdf, $destination);
  
          // Check if all the fields are filled
          if (empty($candName) or empty($candEmail) or empty($candQualification) or empty($candAge) or empty($candNumber) or empty($candAddress) or empty($jobrole)){
            $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Fields Must Not be Empty</div>';
            return $msg;
            exit();
        }

        $sql = "INSERT INTO candidates (cand_name, cand_email, cand_phone, cand_age, cand_role, cand_address, cand_qualification, pdf_file) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $arr = array($candName, $candEmail, $candNumber, $candAge, $jobrole, $candAddress, $candQualification, $pdfname);
        $results = $this->db->simplequery($sql, $arr);

        // Check if the query was successful
        if ($results) {
            $msg = '<div class="alert alert-success"><b>Registration Success!</b> You have successfully added a new candidate.</div>';
            return $msg;
        } else {
            $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Sorry, Some Unexpected Error Occurred, Please try again</div>';
            return $msg;
        }
    }
}

  






    public function createQuestion($data){
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addQuestion'])) {
        $question = $data['question'];

        if (empty($question)){
          $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Fields Must Not be Empty</div>';
          return $msg;
          exit();
        }

        $sql = "insert into questions(question) values(?)";
        $arr = array($question);
        $results = $this->db->simplequery($sql, $arr);
        if ($results) {
          $msg = '<div class="alert alert-success"><b>Question add Success!</b> You have successfully added a new question.</div>';
          return $msg;
        } else {
          $msg = '<div class="alert alert-danger"><b>Question add Error!</b> Sorry, Some Unexpected Error Ocur, Please try again</div>';
          return $msg;
        }

      }
    }


    public function createExam($data){
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitReport'])) {

          $candId = $_GET['id'];
          $comment = $data['comment'];
          $count = count($data);
          for ($x=1; $x < $count; $x++) {
            if (!empty($data["questionId$x"])  and !empty($data["result$x"])) {
              $questionId = $data["questionId$x"];
              $result = $data["result$x"];

              $sql = "insert into reports(question_id, cand_id, result) values(?, ?, ?)";
              $arr = array($questionId, $candId, $result);
              $results = $this->db->simplequery($sql, $arr);

            }
          }

          $sql = "insert into comments(comment, cand_id) values(?, ?)";
          $arr = array($comment, $candId);
          $results = $this->db->simplequery($sql, $arr);

          echo '<div class="alert alert-success"><b>Report store Successfully!</b> You have successfully stored a candidate report.</div>';
      }
    }

    public function editQuestion($data){
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editQuestion'])) {
        $question = $data['question'];
        $questionId = $_GET['id'];

        if (empty($question)){
          $msg = '<div class="alert alert-danger"><b>Form Fillup Error!</b> Fields Must Not be Empty</div>';
          return $msg;
          exit();
        }

        $sql = "update questions set question = ? where question_id = $questionId";
        $arr = array($question);
        $results = $this->db->simplequery($sql, $arr);
        if ($results) {
          header('Location: viewQuestions.php');
        } else {
          $msg = '<div class="alert alert-danger"><b>Question add Error!</b> Sorry, Some Unexpected Error Ocur, Please try again</div>';
          return $msg;
        }

      }
    }


  }

?>
