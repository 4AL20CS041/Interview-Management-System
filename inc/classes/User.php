<?php
include ("inc/classes/DB.php");
include_once ("inc/classes/session.php");
class User{
  private $db;
  public function __construct(){
    $this->db = new DB();
  }

  public function userRegistration($data){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register-submit'])) {
      $username              = $data['username'];
      $email                 = $data['email'];
      $password              = $data['password'];
      $confirm_password      = $data['confirm-password'];
      $md5password           = md5($data['password']);
      $md5confirm_password   = md5($data['confirm-password']);

      if (empty($username) or empty($email) or empty($password) or empty($confirm_password)){
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Fields Must Not be Empty</div>';
        return $msg;
        exit();
      }
      if (strlen($username) < 3) {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> User Name Fields Must be Greater Than 3 Character</div>';
        return $msg;
        exit();
      }
      if ($md5password != $md5confirm_password) {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Password Doesn\'t Match</div>';
        return $msg;
        exit();
      }
      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Invalid Email</div>';
        return $msg;
        exit();
      }
        $sql = "select email from user where email = ?";
        $arr = array($email);
        $results = $this->db->simplequery($sql, $arr);
        if ($results->rowCount() > 0) {
          $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Email Address is Already Exists</div>';
          return $msg;
          exit();
        }

      $sql = "insert into user(user_name, email, password) values(?, ?, ?)";
      $arr = array($username, $email, $md5password);
      $results = $this->db->simplequery($sql, $arr);
      if ($results) {
        $msg = '<div class="alert alert-success"><b>Registration Success!</b> You have successfully register.</div>';
        return $msg;
      } else {
        $msg = '<div class="alert alert-danger"><b>Registration Error!</b> Sorry, Some Unexpected Error Ocur, Please try again</div>';
        return $msg;
      }

    }
  }

  public function userLogin($data){
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login-submit'])) {
      $email                 = $data['email'];
      $password              = $data['password'];
      $md5password           = md5($data['password']);

      if (empty($email) or empty($password)){
        $msg = '<div class="alert alert-danger"><b>Login Error!</b> Fields Must Not be Empty</div>';
        return $msg;
        exit();
      }

      if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $msg = '<div class="alert alert-danger"><b>Login Error!</b> Invalid Email</div>';
        return $msg;
        exit();
      }

      $sql = "select * from user where email = ? AND password = ?";
      $arr = array($email, $md5password);
      $simplequery = $this->db->simplequery($sql, $arr);
      $results = $simplequery->fetch(PDO::FETCH_OBJ);
      if ($results) {
        $userSession = new Session();
        $userSession->setSession('login', true);
        $userSession->setSession('user_id', $results->user_id);
        $userSession->setSession('user_name', $results->user_name);
        $userSession->setSession('email', $results->email);
        $userSession->setSession('loginmsg', '<div class="alert alert-susscess"><b>Login Success</div>');
        header("Location: viewCandidate.php");
      } else {
        $msg = '<div class="alert alert-danger"><b>Login Error!</b> Your login attempt failed</div>';
        return $msg;
        exit();
      }
    }
  }
}
?>
