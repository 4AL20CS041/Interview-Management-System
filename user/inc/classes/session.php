<?php
  class Session{

    public function __construct(){
      if (version_compare(phpversion(), '5.4.0', '<')) {
        if (session_id() == '') {
          session_start();
        }
      } else {
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
      }
    }

    public function setSession($key, $val){
      $_SESSION[$key] = $val;
    }
    public function getSession($key){
      if (isset($_SESSION[$key])) {
        return $_SESSION[$key];
      } else {
        return false;
      }
    }

    public function destroy(){
      if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        session_destroy();
        session_unset();
        header('Location: login.php');
      }
    }
  }
?>
